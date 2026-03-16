<?php
class Appointment {
    private $id;
    private $user_id;
    private $full_name;
    private $email;
    private $phone;
    private $service;
    private $requested_date;
    private $duration;
    private $platforms;
    private $message;
    private $status;
    private $created_at;

    public function __construct(array $data) {
        foreach ($data as $k => $v) {
            if (property_exists($this, $k)) $this->$k = $v;
        }
    }

    public function getId(): int          { return (int)$this->id; }
    public function getUserId(): ?int     { return $this->user_id ? (int)$this->user_id : null; }
    public function getFullName(): string { return $this->full_name ?? ''; }
    public function getEmail(): string    { return $this->email ?? ''; }
    public function getPhone(): string    { return $this->phone ?? ''; }
    public function getService(): string  { return $this->service ?? ''; }
    public function getDate(): string     { return $this->requested_date ?? ''; }
    public function getDuration(): string { return $this->duration ?? ''; }
    public function getPlatforms(): string{ return $this->platforms ?? ''; }
    public function getMessage(): string  { return $this->message ?? ''; }
    public function getStatus(): string   { return $this->status ?? 'new'; }
    public function getCreatedAt(): string{ return $this->created_at ?? ''; }
}

class AppointmentManager extends Model {
    protected $_table = 'appointments';
    protected $_obj   = 'Appointment';

    public function create(array $data): int {
        return $this->insert([
            'user_id'        => $data['user_id'] ?? null,
            'full_name'      => $data['full_name'],
            'email'          => $data['email'],
            'phone'          => $data['phone'] ?? null,
            'service'        => $data['service'],
            'requested_date' => $data['date'] ?? null,
            'duration'       => $data['duration'] ?? null,
            'platforms'      => $data['platforms'] ?? null,
            'message'        => $data['message'],
            'status'         => 'new',
        ]);
    }

    public function getByUser(int $userId): array {
        $sql = $this->getDb()->prepare(
            "SELECT * FROM `{$this->_table}` WHERE user_id=? ORDER BY created_at DESC"
        );
        $sql->execute([$userId]);
        $rows = [];
        while ($r = $sql->fetch(PDO::FETCH_ASSOC)) $rows[] = new Appointment($r);
        return $rows;
    }

    public function getRecent(int $limit = 10): array {
        $sql = $this->getDb()->prepare(
            "SELECT * FROM `{$this->_table}` ORDER BY created_at DESC LIMIT $limit"
        );
        $sql->execute();
        $rows = [];
        while ($r = $sql->fetch(PDO::FETCH_ASSOC)) $rows[] = new Appointment($r);
        return $rows;
    }

    public function countNew(): int {
        return (int)$this->getDb()
            ->query("SELECT COUNT(*) FROM `{$this->_table}` WHERE status='new'")
            ->fetchColumn();
    }


    public function updateStatus(int $id, string $status): void {
        $this->getDb()->prepare("UPDATE `{$this->_table}` SET status=? WHERE id=?")->execute([$status,$id]);
    }

    public function countAll(): int {
        return (int)$this->getDb()->query("SELECT COUNT(*) FROM `{$this->_table}`")->fetchColumn();
    }}