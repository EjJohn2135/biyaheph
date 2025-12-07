<?php

if (!function_exists('is_exec_available')) {
    function is_exec_available(): bool
    {
        if (!function_exists('shell_exec')) return false;
        $disabled = ini_get('disable_functions') ?: '';
        foreach (['exec','shell_exec','passthru','system'] as $fn) {
            if (stripos($disabled, $fn) !== false) return false;
        }
        return true;
    }
}

if (!function_exists('getIpAddress')) {
    function getIpAddress(): string
    {
        $request = \Config\Services::request();
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($ips[0]);
        } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
            return $_SERVER['REMOTE_ADDR'];
        }
        return $request->getIPAddress() ?? '127.0.0.1';
    }
}

if (!function_exists('normalize_mac')) {
    function normalize_mac(string $mac): string
    {
        $mac = trim($mac);
        $mac = str_replace('-', ':', $mac);
        $mac = preg_replace('/[^0-9A-Fa-f:]/', '', $mac);
        $mac = strtoupper($mac);
        return $mac;
    }
}

if (!function_exists('getMacFromArp')) {
    /**
     * Try to get a MAC address for $ip using ARP / ip neigh
     * Returns normalized MAC string or null
     */
    function getMacFromArp(string $ip): ?string
    {
        if (!is_exec_available()) {
            return null;
        }

        $os = strtoupper(substr(PHP_OS, 0, 3));
        $output = null;

        try {
            if ($os === 'WIN') {
                // Windows: arp -a then find line with IP
                $raw = @shell_exec('arp -a 2>&1');
                if ($raw) {
                    // lines like:  192.168.1.5          00-11-22-33-44-55     dynamic
                    if (preg_match_all('/' . preg_quote($ip, '/') . '\s+([0-9A-Fa-f\-]{17}|[0-9A-Fa-f\-]{14})/m', $raw, $m)) {
                        $mac = $m[1][0] ?? null;
                        return $mac ? normalize_mac(str_replace('-', ':', $mac)) : null;
                    }
                }
            } else {
                // Linux/macOS: try ip neigh, then arp -n
                $raw = @shell_exec("ip neigh show " . escapeshellarg($ip) . " 2>/dev/null");
                if ($raw && preg_match('/lladdr\s+([0-9a-f:]{17})/i', $raw, $m)) {
                    return normalize_mac($m[1]);
                }
                // fallback to arp
                $raw = @shell_exec("arp -n " . escapeshellarg($ip) . " 2>/dev/null");
                if ($raw && preg_match('/([0-9a-f]{2}:[0-9a-f]{2}:[0-9a-f]{2}:[0-9a-f]{2}:[0-9a-f]{2}:[0-9a-f]{2})/i', $raw, $m)) {
                    return normalize_mac($m[1]);
                }
                // lastly try ifconfig output
                $raw = @shell_exec('ifconfig 2>/dev/null');
                if ($raw && preg_match('/([0-9A-Fa-f]{2}:[0-9A-Fa-f]{2}:[0-9A-Fa-f]{2}:[0-9A-Fa-f]{2}:[0-9A-Fa-f]{2}:[0-9A-Fa-f]{2})/i', $raw, $m)) {
                    return normalize_mac($m[1]);
                }
            }
        } catch (\Throwable $e) {
            // ignore and return null
        }

        return null;
    }
}

if (!function_exists('getServerMac')) {
    /**
     * Attempts to read server NIC MAC (useful for local testing)
     */
    function getServerMac(): ?string
    {
        if (!is_exec_available()) return null;
        $os = strtoupper(substr(PHP_OS, 0, 3));
        try {
            if ($os === 'WIN') {
                $raw = @shell_exec('getmac /fo csv /nh 2>&1');
                if ($raw) {
                    // CSV: "00-11-22-33-44-55","\Device\Tcpip_{...}"
                    if (preg_match('/"([0-9A-Fa-f\-]{17})"/', $raw, $m)) {
                        return normalize_mac(str_replace('-', ':', $m[1]));
                    }
                }
                // fallback ipconfig
                $raw = @shell_exec('ipconfig /all 2>&1');
                if ($raw && preg_match('/Physical Address[^\:]*:\s*([0-9A-Fa-f\-]{17})/i', $raw, $m)) {
                    return normalize_mac(str_replace('-', ':', $m[1]));
                }
            } else {
                $raw = @shell_exec('ip link 2>/dev/null');
                if ($raw && preg_match('/link\/ether\s+([0-9a-f:]{17})/i', $raw, $m)) {
                    return normalize_mac($m[1]);
                }
                $raw = @shell_exec('ifconfig 2>/dev/null');
                if ($raw && preg_match('/ether\s+([0-9a-f:]{17})/i', $raw, $m)) {
                    return normalize_mac($m[1]);
                }
            }
        } catch (\Throwable $e) {}
        return null;
    }
}

if (!function_exists('getMacAddress')) {
    /**
     * Main public function:
     * - tries header X-Client-MAC (if provided by trusted proxy/client)
     * - then tries ARP lookup for the client IP (only works if server and client are on same network and exec allowed)
     * - then returns server NIC MAC (for local dev)
     * - otherwise returns null
     */
    function getMacAddress(): ?string
    {
        $req = \Config\Services::request();
        // 1) If a trusted header exists, use it (note: not secure from public clients)
        $hdr = $req->getHeaderLine('X-Client-MAC') ?: $req->getHeaderLine('X-MAC-Address');
        if ($hdr) {
            $mac = normalize_mac($hdr);
            if (preg_match('/^([0-9A-F]{2}:){5}[0-9A-F]{2}$/i', $mac)) return $mac;
        }

        // 2) Try ARP for client IP
        $clientIp = getIpAddress();
        // only attempt ARP for IPv4 addresses
        if (filter_var($clientIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $mac = getMacFromArp($clientIp);
            if ($mac) return $mac;
        }

        // 3) Try server NIC MAC (useful for local dev)
        $serverMac = getServerMac();
        if ($serverMac) return $serverMac;

        // 4) cannot obtain MAC
        return null;
    }
}