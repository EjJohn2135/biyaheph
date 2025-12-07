<?php


namespace App\Controllers;

use App\Models\ActivityLogModel;

class ActivityLogs extends BaseController
{
    protected $helpers = ['activity_format'];

    public function index()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $model = new ActivityLogModel();
        $search = $this->request->getGet('q');
        $page = $this->request->getGet('page') ?? 1;

        if ($search) {
            $model->groupStart()
                ->like('name', $search)
                ->orLike('action', $search)
                ->orLike('ip_address', $search)
                ->groupEnd();
        }

        $data['logs'] = $model
            ->orderBy('created_at', 'DESC')
            ->paginate(30, 'default', $page);

        $data['pager'] = $model->pager;
        $data['q'] = $search;

        return view('admin/activity-logs', $data);
    }

    public function details($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $model = new ActivityLogModel();
        $log = $model->find($id);

        if (!$log) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Log not found']);
        }

        return $this->response->setJSON($log);
    }
    
}