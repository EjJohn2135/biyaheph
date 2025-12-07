<?php


namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $helpers = ['activity', 'mac'];

    public function login()
    {
        return view('auth/login');
    }

    public function loginPost()
    {
        $session = session();
        $model   = new UserModel();

        $username = trim((string)$this->request->getPost('username'));
        $password = (string)$this->request->getPost('password');

        if ($username === '' || $password === '') {
            activity_log('login_failed', ['username' => $username, 'reason' => 'missing_credentials']);
            return redirect()->back()->withInput()->with('error', 'Username and password are required');
        }

        $user = $model->where('name', $username)->first();

        if (!$user) {
            activity_log('login_failed', ['username' => $username, 'reason' => 'username_not_found']);
            return redirect()->back()->withInput()->with('error', 'Username not found');
        }

        if (!password_verify($password, $user['password'])) {
            activity_log('login_failed', ['user_id' => $user['id'], 'user_name' => $user['name'], 'username' => $username, 'reason' => 'incorrect_password']);
            return redirect()->back()->withInput()->with('error', 'Incorrect password');
        }

        // Check if admin needs approval
        if ($user['role'] === 'admin' && !$user['approved']) {
            activity_log('login_blocked_pending_approval', ['user_id' => $user['id'], 'user_name' => $user['name']]);
            return redirect()->back()->withInput()->with('error', 'Your admin account is pending approval');
        }

        $session->set([
            'id'        => $user['id'],
            'name'      => $user['name'],
            'role'      => $user['role'],
            'logged_in' => true,
        ]);

        activity_log('login_success', ['user_id' => $user['id'], 'user_name' => $user['name'], 'role' => $user['role']]);

        return redirect()->to(base_url('dashboard'));
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerPost()
    {
        $model = new UserModel();

        $username = trim((string)$this->request->getPost('username'));
        $password = (string)$this->request->getPost('password');
        $isRequestAdmin = $this->request->getPost('request_admin') ? true : false;

        if ($username === '' || $password === '') {
            activity_log('register_failed', ['username' => $username, 'reason' => 'missing_credentials']);
            return redirect()->back()->withInput()->with('error', 'Username and password are required');
        }

        if ($model->where('name', $username)->first()) {
            activity_log('register_failed', ['username' => $username, 'reason' => 'username_taken']);
            return redirect()->back()->withInput()->with('error', 'Username already taken');
        }

        $generatedEmail = $username . '.' . time() . '@noemail.local';

        $data = [
            'name'     => $username,
            'email'    => $generatedEmail,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => $isRequestAdmin ? 'admin' : 'tourist',
            'approved' => $isRequestAdmin ? 0 : 1,
        ];

        $id = $model->insert($data);
        if ($id === false) {
            $errors = $model->errors();
            activity_log('register_failed', ['username' => $username, 'errors' => $errors]);
            return redirect()->back()->withInput()->with('error', implode('; ', $errors ?? ['Insert failed']));
        }

        activity_log('register_success', ['user_id' => $id, 'user_name' => $username, 'role' => $data['role']]);

        $msg = $isRequestAdmin ? 'Admin request submitted. Wait for admin approval.' : 'Account created. You can now login.';
        return redirect()->to(base_url('auth/login'))->with('success', $msg);
    }

    public function approveAdmin($id)
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            activity_log('approve_admin_denied', ['target_id' => $id, 'reason' => 'unauthorized']);
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $model = new UserModel();
        $user = $model->find($id);
        
        if (!$user || $user['role'] !== 'admin') {
            activity_log('approve_admin_failed', ['target_id' => $id, 'reason' => 'not_admin_request']);
            return redirect()->back()->with('error', 'User not found or not an admin request');
        }

        $model->update($id, ['approved' => 1]);
        activity_log('admin_approved', ['target_id' => $id, 'user_name' => $user['name'], 'approved_by' => session()->get('id'), 'approved_by_name' => session()->get('name')]);

        return redirect()->back()->with('success', 'Admin account approved');
    }

    public function rejectAdmin($id)
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            activity_log('reject_admin_denied', ['target_id' => $id, 'reason' => 'unauthorized']);
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $model = new UserModel();
        $user = $model->find($id);
        
        if (!$user || $user['role'] !== 'admin') {
            activity_log('reject_admin_failed', ['target_id' => $id, 'reason' => 'not_admin_request']);
            return redirect()->back()->with('error', 'User not found');
        }

        $model->delete($id);
        activity_log('admin_rejected', ['target_id' => $id, 'user_name' => $user['name'], 'rejected_by' => session()->get('id'), 'rejected_by_name' => session()->get('name')]);

        return redirect()->back()->with('success', 'Admin request rejected');
    }

    public function logout()
    {
        $sess = session();
        activity_log('logout', ['user_id' => $sess->get('id'), 'user_name' => $sess->get('name')]);
        session()->destroy();
        return redirect()->to(base_url('auth/login'));
    }
}