<?php


namespace App\Controllers;

use App\Models\SettingsModel;

class Maintenance extends BaseController
{
    protected $helpers = ['activity', 'mac'];

    public function toggle()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            activity_log('toggle_maintenance_denied', ['reason' => 'unauthorized']);
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $settingsModel = new SettingsModel();
        $settings = $settingsModel->getOrCreate();

        // Toggle status
        $currentStatus = (int)$settings['maintenance_mode'];
        $newStatus = $currentStatus === 1 ? 0 : 1;

        // Update
        $settingsModel->update(1, [
            'maintenance_mode' => $newStatus,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Log the action
        activity_log('toggle_maintenance_mode', [
            'user_id' => session()->get('id'),
            'user_name' => session()->get('name'),
            'previous_status' => $currentStatus === 1 ? 'on' : 'off',
            'new_status' => $newStatus === 1 ? 'on' : 'off',
            'action' => $newStatus === 1 ? 'enabled' : 'disabled',
            'timestamp' => date('Y-m-d H:i:s')
        ]);

        $message = $newStatus === 1 ? 'Maintenance mode enabled' : 'Maintenance mode disabled';
        return redirect()->back()->with('success', $message);
    }

    public function enable()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            activity_log('enable_maintenance_denied', ['reason' => 'unauthorized']);
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $settingsModel = new SettingsModel();
        $settings = $settingsModel->getOrCreate();

        // Only log if not already enabled
        if ((int)$settings['maintenance_mode'] !== 1) {
            $settingsModel->update(1, [
                'maintenance_mode' => 1,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            activity_log('enable_maintenance_mode', [
                'user_id' => session()->get('id'),
                'user_name' => session()->get('name'),
                'action' => 'enabled',
                'timestamp' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->back()->with('success', 'Maintenance mode enabled');
    }

    public function disable()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            activity_log('disable_maintenance_denied', ['reason' => 'unauthorized']);
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $settingsModel = new SettingsModel();
        $settings = $settingsModel->getOrCreate();

        // Only log if not already disabled
        if ((int)$settings['maintenance_mode'] !== 0) {
            $settingsModel->update(1, [
                'maintenance_mode' => 0,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            activity_log('disable_maintenance_mode', [
                'user_id' => session()->get('id'),
                'user_name' => session()->get('name'),
                'action' => 'disabled',
                'timestamp' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->back()->with('success', 'Maintenance mode disabled');
    }

    public function status()
    {
        $settingsModel = new SettingsModel();
        $settings = $settingsModel->getOrCreate();
        $status = (int)$settings['maintenance_mode'] === 1 ? 'on' : 'off';

        return $this->response->setJSON(['status' => $status]);
    }
}