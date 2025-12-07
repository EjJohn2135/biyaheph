<?php

namespace App\Controllers;

use App\Models\NotificationModel;

class Notifications extends BaseController
{
    protected $notifModel;

    public function __construct()
    {
        $this->notifModel = new NotificationModel();
    }

    // GET: notifications/fetch
    public function fetch()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized'])->setStatusCode(401);
        }

        $userId = session()->get('id');
        $items = $this->notifModel->where('user_id', $userId)->orderBy('created_at', 'DESC')->findAll();

        $unread = 0;
        $data = [];
        foreach ($items as $it) {
            if ((int)$it['is_read'] === 0) $unread++;
            $data[] = [
                'id' => $it['id'],
                'title' => $it['title'],
                'message' => $it['message'],
                'is_read' => (int)$it['is_read'],
                'created_at' => $it['created_at']
            ];
        }

        return $this->response->setJSON(['success' => true, 'notifications' => $data, 'unread' => $unread]);
    }

    // POST: notifications/mark-read
    public function markRead()
    {
        if (!session()->get('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized'])->setStatusCode(401);
        }

        $userId = session()->get('id');

        $input = $this->request->getJSON(true);
        if (!$input) {
            $input = $this->request->getPost(); // fallback form data
        }

        // mark single
        if (!empty($input['id'])) {
            $id = (int)$input['id'];
            $notif = $this->notifModel->find($id);
            if ($notif && $notif['user_id'] == $userId) {
                $this->notifModel->update($id, ['is_read' => 1]);
                return $this->response->setJSON(['success' => true]);
            }
            return $this->response->setJSON(['success' => false, 'message' => 'Not found or unauthorized'])->setStatusCode(404);
        }

        // mark all for user
        $this->notifModel->where('user_id', $userId)->where('is_read', 0)->set(['is_read' => 1])->update();
        return $this->response->setJSON(['success' => true]);
    }
}