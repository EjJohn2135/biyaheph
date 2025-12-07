<?php


namespace App\Controllers;

use App\Models\SettingsModel;

class Settings extends BaseController
{
    public function maintenanceSettings()
    {
        // Check if user is admin
        if (!session()->get('logged_in')) {
            return redirect()->to(site_url('auth/login'))->with('error', 'Please login');
        }

        if (session()->get('role') !== 'admin') {
            return redirect()->to(site_url('dashboard'))->with('error', 'Access denied');
        }

        $settingsModel = new SettingsModel();
        $settings = $settingsModel->first();

        // If no settings exist, create default one
        if (!$settings) {
            $settingsModel->insert([
                'maintenance_mode' => 0,
                'maintenance_message' => 'We are currently under maintenance. Please check back soon!',
                'admin_ips' => '',
                'created_at' => date('Y-m-d H:i:s')
            ]);
            $settings = $settingsModel->first();
        }

        if ($this->request->getMethod() === 'post') {
            $maintenanceMode = $this->request->getPost('maintenance_mode') ? 1 : 0;
            $maintenanceMessage = $this->request->getPost('maintenance_message');
            $adminIps = $this->request->getPost('admin_ips');

            // Normalize admin IPs - convert newlines to commas
            $adminIps = preg_replace('/\r\n|\r|\n/', ',', $adminIps);
            $adminIps = implode(',', array_filter(array_map('trim', explode(',', $adminIps))));

            try {
                $settingsModel->update($settings['id'], [
                    'maintenance_mode' => $maintenanceMode,
                    'maintenance_message' => $maintenanceMessage,
                    'admin_ips' => $adminIps,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                return redirect()->back()->with('success', 'Maintenance settings updated successfully');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error updating settings: ' . $e->getMessage());
            }
        }

        return view('admin/maintenance-settings', [
            'settings' => $settings,
            'currentIp' => $this->request->getIPAddress()
        ]);
    }

    public function toggleMaintenance()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(site_url('auth/login'))->with('error', 'Please login');
        }

        if (session()->get('role') !== 'admin') {
            return redirect()->back()->with('error', 'Access denied');
        }

        $settingsModel = new SettingsModel();
        $settings = $settingsModel->first();

        try {
            if ($settings) {
                $newStatus = $settings['maintenance_mode'] ? 0 : 1;
                $settingsModel->update($settings['id'], [
                    'maintenance_mode' => $newStatus,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                $message = $newStatus ? 'Maintenance mode enabled' : 'Maintenance mode disabled';
                return redirect()->to(site_url('settings/maintenance'))->with('success', $message);
            } else {
                // Create default settings if none exist
                $settingsModel->insert([
                    'maintenance_mode' => 1,
                    'maintenance_message' => 'We are currently under maintenance. Please check back soon!',
                    'admin_ips' => '',
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                return redirect()->to(site_url('settings/maintenance'))->with('success', 'Maintenance mode enabled');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}