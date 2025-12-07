<?php


use App\Models\ActivityLogModel;

if (!function_exists('activity_log')) {
    /**
     * activity_log — store a custom activity entry
     *
     * @param string $action
     * @param mixed  $details
     * @param int|null $userId
     * @return bool
     */
    function activity_log(string $action, $details = null, ?int $userId = null): bool
    {
        $model = new ActivityLogModel();
        $session = session();

        $userId = $userId ?? $session->get('id');
        $name = $session->get('name') ?? null;
        $role = $session->get('role') ?? null;

        $request = \Config\Services::request();
        // attempt to read mac from custom header if provided by proxy/client
        $mac = $request->getHeaderLine('X-Client-MAC') ?: $request->getHeaderLine('X-MAC-Address') ?: null;

        // get client IP (best-effort)
        $ip = $request->getHeaderLine('X-Forwarded-For') ?: $request->getServer('REMOTE_ADDR') ?: $request->getIPAddress();

        $ua = $request->getUserAgent()->getAgentString();

        $payload = [
            'user_id' => $userId,
            'name' => $name,
            'role' => $role,
            'action' => $action,
            'details' => is_scalar($details) ? (string)$details : json_encode($details, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE),
            'ip_address' => $ip,
            'mac_address' => $mac,
            'user_agent' => $ua,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        return (bool)$model->insert($payload);
    }
}