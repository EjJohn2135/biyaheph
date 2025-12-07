<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\SettingsModel;
use Config\Services;

class MaintenanceFilter implements FilterInterface
{
    protected function getClientIp(RequestInterface $request): string
    {
        // Check common proxy headers first (may contain comma-separated list)
        $headers = [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'X-Forwarded-For',
            'HTTP_X_REAL_IP',
            'X-Real-IP',
            'HTTP_X_FORWARDED',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
        ];

        foreach ($headers as $h) {
            $val = $request->getServer($h) ?: $request->getHeaderLine($h);
            if ($val) {
                // If header contains multiple IPs, take the first non-empty one
                $parts = preg_split('/\s*,\s*/', $val);
                foreach ($parts as $p) {
                    $p = trim($p);
                    if ($p !== '') {
                        return $p;
                    }
                }
            }
        }

        // Fallback to CodeIgniter method (REMOTE_ADDR)
        return $request->getIPAddress();
    }

    protected function normalizeIp(string $ip): string
    {
        $ip = trim($ip);

        // Remove port if present (e.g. 127.0.0.1:8080)
        if (strpos($ip, ':') !== false && substr_count($ip, ':') === 1) {
            // IPv4 with port
            $ip = explode(':', $ip)[0];
        }

        // IPv4-mapped IPv6 like ::ffff:127.0.0.1 -> 127.0.0.1
        if (stripos($ip, '::ffff:') === 0) {
            $ip = substr($ip, 7);
        }

        // Convert IPv6 loopback to IPv4 loopback for local dev convenience
        if ($ip === '::1') {
            $ip = '127.0.0.1';
        }

        return $ip;
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        $settingsModel = new SettingsModel();
        // ensure settings record exists (getOrCreate in model if implemented)
        $settings = method_exists($settingsModel, 'getOrCreate') ? $settingsModel->getOrCreate() : $settingsModel->first();

        // If maintenance is not enabled, do nothing
        if (!$settings || empty($settings['maintenance_mode'])) {
            return;
        }

        $clientIpRaw = $this->getClientIp($request);
        $clientIp = $this->normalizeIp($clientIpRaw);

        $adminIpsRaw = $settings['admin_ips'] ?? '';
        // Split by commas or newlines, normalize each
        $rawList = preg_split('/[\r\n,]+/', $adminIpsRaw);
        $allowedIps = [];
        foreach ($rawList as $r) {
            $r = trim($r);
            if ($r === '') {
                continue;
            }
            $allowedIps[] = $this->normalizeIp($r);
        }

        // Check session admin (logged-in admin always bypasses)
        $sess = session();
        $isLoggedInAdmin = $sess->get('logged_in') && $sess->get('role') === 'admin';

        // If logged-in admin -> allow
        if ($isLoggedInAdmin) {
            return;
        }

        // If admin IP list is empty -> no IP bypass (only logged-in admins bypass).
        // If list not empty and client IP is whitelisted -> allow
        if (!empty($allowedIps) && in_array($clientIp, $allowedIps, true)) {
            return;
        }

        // Not allowed -> show maintenance page (HTTP 503) and stop request processing
        $response = Services::response();
        $response->setStatusCode(503);
        $response->setBody(view('maintenance/maintenance-page', [
            'message' => $settings['maintenance_message'] ?? 'We are currently under maintenance. Please check back soon!'
        ]));
        return $response;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // no-op
    }
}