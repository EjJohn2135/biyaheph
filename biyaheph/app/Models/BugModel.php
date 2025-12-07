<?php


namespace App\Models;

use CodeIgniter\Model;

class BugModel extends Model
{
    protected $table = 'bugs';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'bug_id',
        'module',
        'title',
        'description',
        'steps_to_reproduce',
        'severity',
        'status',
        'screenshot',
        'reported_by',
        'assigned_to',
        'created_at',
        'updated_at',
        'resolved_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // ...existing code...

    /**
     * Return a bug with reporter name joined.
     */
    public function getBugWithReporter($id = null)
    {
        return $this->select('bugs.*, users.name as reporter_name')
            ->join('users', 'users.id = bugs.reported_by', 'left')
            ->where('bugs.id', $id)
            ->get()
            ->getRowArray();
    }

    /**
     * Return all bugs with reporter and assigned names.
     */
    public function getAllBugsWithDetails()
    {
        return $this->select('bugs.*, users.name as reporter_name, u2.name as assigned_to_name')
            ->join('users', 'users.id = bugs.reported_by', 'left')
            ->join('users as u2', 'u2.id = bugs.assigned_to', 'left')
            ->orderBy('bugs.created_at', 'DESC')
            ->findAll();
    }

    /**
     * Search helper (keeps original behaviour).
     */
    public function searchBugs($keyword)
    {
        return $this->select('bugs.*, users.name as reporter_name, u2.name as assigned_to_name')
            ->join('users', 'users.id = bugs.reported_by', 'left')
            ->join('users as u2', 'u2.id = bugs.assigned_to', 'left')
            ->groupStart()
                ->like('bugs.bug_id', $keyword)
                ->orLike('bugs.title', $keyword)
                ->orLike('bugs.description', $keyword)
                ->orLike('bugs.module', $keyword)
            ->groupEnd()
            ->orderBy('bugs.created_at', 'DESC')
            ->findAll();
    }

    /**
     * Generate a readable unique bug id like BUG-00001.
     * Uses the highest existing id and pads it.
     */
    public function generateBugId(): string
    {
        $latest = $this->select('id')->orderBy('id', 'DESC')->limit(1)->first();
        $nextId = ($latest['id'] ?? 0) + 1;
        $candidate = 'BUG-' . str_pad((string)$nextId, 5, '0', STR_PAD_LEFT);

        // Ensure uniqueness (in rare race conditions)
        $exists = $this->where('bug_id', $candidate)->countAllResults();
        if ($exists) {
            // fallback to timestamp based id to avoid collisions
            return 'BUG-' . date('YmdHis') . '-' . bin2hex(random_bytes(3));
        }

        return $candidate;
    }

    /**
     * Get statistics (uses direct DB queries to avoid modifying model builder state).
     */
    public function getStatistics(): array
    {
        $db = $this->db->table($this->table);

        $total = (int) $db->countAllResults(false); // false prevents reset of query but we immediately get new builder below

        $open = (int) $this->db->table($this->table)->where('status', 'open')->countAllResults();
        $in_progress = (int) $this->db->table($this->table)->where('status', 'in_progress')->countAllResults();
        $resolved = (int) $this->db->table($this->table)->where('status', 'resolved')->countAllResults();
        $closed = (int) $this->db->table($this->table)->where('status', 'closed')->countAllResults();

        $critical = (int) $this->db->table($this->table)->where('severity', 'critical')->countAllResults();
        $high = (int) $this->db->table($this->table)->where('severity', 'high')->countAllResults();
        $medium = (int) $this->db->table($this->table)->where('severity', 'medium')->countAllResults();
        $low = (int) $this->db->table($this->table)->where('severity', 'low')->countAllResults();

        return [
            'total' => $total,
            'open' => $open,
            'in_progress' => $in_progress,
            'resolved' => $resolved,
            'closed' => $closed,
            'critical' => $critical,
            'high' => $high,
            'medium' => $medium,
            'low' => $low,
        ];
    }

    /**
     * Safely create an auto-reported bug (used by global exception handler).
     * Returns inserted ID or false on failure.
     */
    public function createAutoBug(array $data)
    {
        try {
            if (empty($data['bug_id'])) {
                $data['bug_id'] = $this->generateBugId();
            }

            // Ensure minimal required fields
            $data = array_merge([
                'module' => 'System',
                'title' => 'Automatic Bug Report',
                'description' => '',
                'steps_to_reproduce' => '',
                'severity' => 'medium',
                'status' => 'open',
                'screenshot' => null,
                'reported_by' => null,
            ], $data);

            // Trim title length
            $data['title'] = mb_substr($data['title'], 0, 255);

            $this->insert($data);
            return $this->getInsertID();
        } catch (\Throwable $e) {
            // Log and return false; handler that called this should also log
            log_message('error', 'createAutoBug failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get bug by bug_id
     */
    public function getByBugId(string $bugId)
    {
        return $this->where('bug_id', $bugId)->first();
    }

    // ...existing code...
}
