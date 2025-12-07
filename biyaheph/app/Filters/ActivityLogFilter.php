<?php


namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ActivityLogModel;

class ActivityLogFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // do nothing before
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        try {
            $model = new ActivityLogModel();
            $session = session();

            $userId = $session->get('id') ?? null;
            $name = $session->get('name') ?? null;
            $role = $session->get('role') ?? null;

            // Get client IP
            $ip = getIpAddress();

            // Get server MAC address
            $mac = 'N/A';
            try {
                $mac = getMacAddress() ?? 'N/A';
            } catch (\Throwable $e) {
                log_message('warning', 'Failed to get MAC in filter: ' . $e->getMessage());
            }

            $ua = $request->getUserAgent()->getAgentString() ?? 'Unknown';

            // Build action from method + URI
            $action = $request->getMethod() . ' ' . $request->getUri()->getPath();

            // Capture request data but exclude sensitive fields
            $post = $request->getPost();
            if (is_array($post)) {
                unset($post['password'], $post['password_confirm'], $post['csrf_test_name']);
            }
            $query = $request->getGet();

            $details = [
                'method' => $request->getMethod(),
                'path' => $request->getUri()->getPath(),
                'status' => $response->getStatusCode(),
                'get' => $query,
                'post' => $post,
            ];

            $model->insert([
                'user_id' => $userId,
                'name' => $name,
                'role' => $role,
                'action' => $action,
                'details' => json_encode($details, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES),
                'ip_address' => $ip,
                'mac_address' => $mac,
                'user_agent' => $ua,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Throwable $e) {
            log_message('error', 'ActivityLogFilter error: ' . $e->getMessage());
        }
    }
}