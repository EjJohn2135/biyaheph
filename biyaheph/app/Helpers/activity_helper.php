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
        try {
            $model = new ActivityLogModel();
            $session = session();

            $userId = $userId ?? $session->get('id');
            $name = $session->get('name') ?? null;
            $role = $session->get('role') ?? null;

            $request = \Config\Services::request();

            // Get client IP
            $ip = getIpAddress();

            // Get server MAC address - with error handling
            $mac = 'N/A';
            try {
                $mac = getMacAddress() ?? 'N/A';
            } catch (\Throwable $e) {
                log_message('warning', 'Failed to get MAC: ' . $e->getMessage());
            }

            $ua = $request->getUserAgent()->getAgentString() ?? 'Unknown';

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
        } catch (\Throwable $e) {
            log_message('error', 'activity_log error: ' . $e->getMessage());
            return false;
        }
    }
}