<?php

namespace App\Controllers;

use App\Models\BugModel;
use App\Models\UserModel;

class Bugs extends BaseController
{
    protected $helpers = ['activity', 'mac'];

    private function ensureUploadsFolder()
    {
        $uploadsPath = WRITEPATH . 'uploads';
        if (!is_dir($uploadsPath)) {
            mkdir($uploadsPath, 0755, true);
        }
    }

    public function index()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $bugModel = new BugModel();
        $status = $this->request->getGet('status');
        $severity = $this->request->getGet('severity');
        $search = $this->request->getGet('search');
        $page = $this->request->getGet('page') ?? 1;

        $query = $bugModel->select('bugs.*, users.name as reporter_name, u2.name as assigned_to_name')
            ->join('users', 'users.id = bugs.reported_by', 'left')
            ->join('users as u2', 'u2.id = bugs.assigned_to', 'left');

        if (!empty($status)) {
            $query->where('bugs.status', $status);
        }

        if (!empty($severity)) {
            $query->where('bugs.severity', $severity);
        }

        if (!empty($search)) {
            $query->groupStart()
                ->like('bugs.bug_id', $search)
                ->orLike('bugs.title', $search)
                ->orLike('bugs.description', $search)
                ->orLike('bugs.module', $search)
                ->groupEnd();
        }

        $data['bugs'] = $query->orderBy('bugs.created_at', 'DESC')
            ->paginate(15, 'default', $page);

        $data['pager'] = $bugModel->pager;
        $data['stats'] = $bugModel->getStatistics();
        $data['currentStatus'] = $status;
        $data['currentSeverity'] = $severity;
        $data['search'] = $search;

        activity_log('view_bug_logs', [
            'user_id' => session()->get('id'),
            'user_name' => session()->get('name'),
            'status' => $status,
            'severity' => $severity
        ]);

        return view('admin/bugs/index', $data);
    }

    public function create()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $userModel = new UserModel();
        $data['admins'] = $userModel->where('role', 'admin')->findAll();

        return view('admin/bugs/create', $data);
    }

    public function store()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $this->ensureUploadsFolder();
        $bugModel = new BugModel();

        $rules = [
            'module' => 'required|min_length[3]|max_length[100]',
            'title' => 'required|min_length[5]|max_length[255]',
            'description' => 'required|min_length[10]',
            'steps_to_reproduce' => 'required|min_length[10]',
            'severity' => 'required|in_list[critical,high,medium,low]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validation failed: ' . implode(', ', $this->validator->getErrors()));
        }

        $bugId = $bugModel->generateBugId();
        $screenshot = null;

        // Handle screenshot upload
        $file = $this->request->getFile('screenshot');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $validated = $this->validate([
                'screenshot' => 'uploaded[screenshot]|max_size[screenshot,5120]|is_image[screenshot]|mime_in[screenshot,image/jpg,image/jpeg,image/gif,image/png]',
            ]);

            if ($validated) {
                $newName = $file->getRandomName();
                if ($file->move(WRITEPATH . 'uploads', $newName)) {
                    $screenshot = $newName;
                }
            }
        }

        $data = [
            'bug_id' => $bugId,
            'module' => $this->request->getPost('module'),
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'steps_to_reproduce' => $this->request->getPost('steps_to_reproduce'),
            'severity' => $this->request->getPost('severity'),
            'status' => 'open',
            'screenshot' => $screenshot,
            'reported_by' => session()->get('id'),
            'assigned_to' => $this->request->getPost('assigned_to') ?: null,
        ];

        $id = $bugModel->insert($data);

        if ($id) {
            activity_log('create_bug', [
                'bug_id' => $bugId,
                'title' => $data['title'],
                'module' => $data['module'],
                'severity' => $data['severity'],
                'user_id' => session()->get('id'),
                'user_name' => session()->get('name')
            ]);

            return redirect()->to(base_url('admin/bugs'))->with('success', 'Bug report created: ' . $bugId);
        }

        return redirect()->back()->withInput()->with('error', 'Failed to create bug report');
    }

    public function show($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $bugModel = new BugModel();
        $bug = $bugModel->getBugWithReporter($id);

        if (!$bug) {
            return redirect()->back()->with('error', 'Bug not found');
        }

        $userModel = new UserModel();
        $data['bug'] = $bug;
        $data['admins'] = $userModel->where('role', 'admin')->findAll();

        activity_log('view_bug_detail', [
            'bug_id' => $bug['bug_id'],
            'user_id' => session()->get('id'),
            'user_name' => session()->get('name')
        ]);

        return view('admin/bugs/show', $data);
    }

    public function edit($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $bugModel = new BugModel();
        $bug = $bugModel->find($id);

        if (!$bug) {
            return redirect()->back()->with('error', 'Bug not found');
        }

        $userModel = new UserModel();
        $data['bug'] = $bug;
        $data['admins'] = $userModel->where('role', 'admin')->findAll();

        return view('admin/bugs/edit', $data);
    }

    public function update($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $this->ensureUploadsFolder();
        $bugModel = new BugModel();
        $bug = $bugModel->find($id);

        if (!$bug) {
            return redirect()->back()->with('error', 'Bug not found');
        }

        $rules = [
            'module' => 'required|min_length[3]|max_length[100]',
            'title' => 'required|min_length[5]|max_length[255]',
            'description' => 'required|min_length[10]',
            'steps_to_reproduce' => 'required|min_length[10]',
            'severity' => 'required|in_list[critical,high,medium,low]',
            'status' => 'required|in_list[open,in_progress,resolved,closed]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validation failed');
        }

        $data = [
            'module' => $this->request->getPost('module'),
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'steps_to_reproduce' => $this->request->getPost('steps_to_reproduce'),
            'severity' => $this->request->getPost('severity'),
            'status' => $this->request->getPost('status'),
            'assigned_to' => $this->request->getPost('assigned_to') ?: null,
        ];

        // If status changed to resolved or closed, set resolved_at
        if (($this->request->getPost('status') === 'resolved' || $this->request->getPost('status') === 'closed') && $bug['status'] !== $this->request->getPost('status')) {
            $data['resolved_at'] = date('Y-m-d H:i:s');
        }

        // Handle screenshot update
        $file = $this->request->getFile('screenshot');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $validated = $this->validate([
                'screenshot' => 'uploaded[screenshot]|max_size[screenshot,5120]|is_image[screenshot]|mime_in[screenshot,image/jpg,image/jpeg,image/gif,image/png]',
            ]);

            if ($validated) {
                // Delete old screenshot
                if (!empty($bug['screenshot'])) {
                    $oldPath = WRITEPATH . 'uploads/' . $bug['screenshot'];
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }

                $newName = $file->getRandomName();
                if ($file->move(WRITEPATH . 'uploads', $newName)) {
                    $data['screenshot'] = $newName;
                }
            }
        }

        $bugModel->update($id, $data);

        activity_log('update_bug', [
            'bug_id' => $bug['bug_id'],
            'status' => $data['status'],
            'severity' => $data['severity'],
            'user_id' => session()->get('id'),
            'user_name' => session()->get('name')
        ]);

        return redirect()->to(base_url('admin/bugs'))->with('success', 'Bug report updated');
    }

    public function updateStatus($id)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid request']);
        }

        if (session()->get('role') !== 'admin') {
            return $this->response->setStatusCode(403)->setJSON(['error' => 'Access denied']);
        }

        $bugModel = new BugModel();
        $bug = $bugModel->find($id);

        if (!$bug) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Bug not found']);
        }

        $status = $this->request->getPost('status');
        if (!in_array($status, ['open', 'in_progress', 'resolved', 'closed'])) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid status']);
        }

        $updateData = ['status' => $status];

        if (($status === 'resolved' || $status === 'closed') && $bug['status'] !== $status) {
            $updateData['resolved_at'] = date('Y-m-d H:i:s');
        }

        $bugModel->update($id, $updateData);

        activity_log('update_bug_status', [
            'bug_id' => $bug['bug_id'],
            'old_status' => $bug['status'],
            'new_status' => $status,
            'user_id' => session()->get('id'),
            'user_name' => session()->get('name')
        ]);

        return $this->response->setJSON(['success' => true, 'message' => 'Bug status updated']);
    }

    public function delete($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $bugModel = new BugModel();
        $bug = $bugModel->find($id);

        if (!$bug) {
            return redirect()->back()->with('error', 'Bug not found');
        }

        // Delete screenshot if exists
        if (!empty($bug['screenshot'])) {
            $path = WRITEPATH . 'uploads/' . $bug['screenshot'];
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $bugModel->delete($id);

        activity_log('delete_bug', [
            'bug_id' => $bug['bug_id'],
            'user_id' => session()->get('id'),
            'user_name' => session()->get('name')
        ]);

        return redirect()->to(base_url('admin/bugs'))->with('success', 'Bug report deleted');
    }

    public function export()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to(base_url('dashboard'))->with('error', 'Access denied');
        }

        $bugModel = new BugModel();
        $bugs = $bugModel->getAllBugsWithDetails();

        $filename = 'bugs_' . date('Y-m-d_His') . '.csv';
        $fp = fopen('php://output', 'w');

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Write header
        fputcsv($fp, ['Bug ID', 'Module', 'Title', 'Severity', 'Status', 'Reported By', 'Assigned To', 'Created At', 'Resolved At']);

        // Write data
        foreach ($bugs as $bug) {
            fputcsv($fp, [
                $bug['bug_id'],
                $bug['module'],
                $bug['title'],
                strtoupper($bug['severity']),
                strtoupper($bug['status']),
                $bug['reporter_name'],
                $bug['assigned_to_name'] ?? 'Unassigned',
                $bug['created_at'],
                $bug['resolved_at'] ?? '-'
            ]);
        }

        fclose($fp);
        exit;
    }
}