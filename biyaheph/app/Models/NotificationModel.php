<?php


namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['user_id','role','title','message','data','is_read','created_at'];
    protected $useTimestamps = false;

    public function getForUser($userId = null, $role = null, $limit = 20)
    {
        $builder = $this->orderBy('created_at', 'DESC')->limit($limit);

        // user-specific OR role-based OR broadcast (user_id IS NULL and role IS NULL)
        $builder->groupStart();
        if ($userId !== null) {
            $builder->orWhere('user_id', $userId);
        }
        if ($role !== null) {
            $builder->orWhere('role', $role);
        }
        $builder->orWhere('user_id IS NULL AND role IS NULL'); // broadcast
        $builder->groupEnd();

        return $builder->findAll();
    }

    public function countUnread($userId = null, $role = null)
    {
        $builder = $this->where('is_read', 0);
        $builder->groupStart();
        if ($userId !== null) {
            $builder->orWhere('user_id', $userId);
        }
        if ($role !== null) {
            $builder->orWhere('role', $role);
        }
        $builder->orWhere('user_id IS NULL AND role IS NULL');
        $builder->groupEnd();

        return $builder->countAllResults();
    }

    public function markRead($id, $userId = null)
    {
        // ensure user can only mark their notifications (or mark broadcast)
        if ($userId === null) {
            return $this->where('id', $id)->set(['is_read' => 1])->update();
        }

        return $this->where('id', $id)
            ->groupStart()
                ->where('user_id', $userId)
                ->orWhere('user_id IS NULL') // allow marking broadcast
            ->groupEnd()
            ->set(['is_read' => 1])
            ->update();
    }

    public function markAllRead($userId = null, $role = null)
    {
        $builder = $this;
        $builder->groupStart();
        if ($userId !== null) $builder->orWhere('user_id', $userId);
        if ($role !== null) $builder->orWhere('role', $role);
        $builder->orWhere('user_id IS NULL AND role IS NULL');
        $builder->groupEnd();

        return $builder->where('is_read', 0)->set(['is_read' => 1])->update();
    }

    public function createNotification($title, $message = null, $data = null, $userId = null, $role = null)
    {
        return $this->insert([
            'user_id' => $userId,
            'role' => $role,
            'title' => $title,
            'message' => $message,
            'data' => $data ? json_encode($data) : null,
            'is_read' => 0,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}