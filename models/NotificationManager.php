<?php
class Notification {
    private $id, $user_id, $type, $title, $body, $link, $read_at, $created_at;
    public function __construct(array $d) { foreach ($d as $k=>$v) if (property_exists($this,$k)) $this->$k=$v; }
    public function getId(): int        { return (int)$this->id; }
    public function getUserId(): int    { return (int)$this->user_id; }
    public function getType(): string   { return $this->type ?? 'info'; }
    public function getTitle(): string  { return $this->title ?? ''; }
    public function getBody(): string   { return $this->body ?? ''; }
    public function getLink(): string   { return $this->link ?? ''; }
    public function isRead(): bool      { return $this->read_at !== null; }
    public function getCreatedAt(): string { return $this->created_at ?? ''; }
}

class NotificationManager extends Model {
    protected $_table = 'notifications';
    protected $_obj   = 'Notification';

    public function create(int $userId, string $type, string $title, string $body='', string $link=''): int {
        return $this->insert(['user_id'=>$userId,'type'=>$type,'title'=>$title,'body'=>$body,'link'=>$link]);
    }

    public function getByUser(int $userId, int $limit=20): array {
        $s = $this->getDb()->prepare("SELECT * FROM `{$this->_table}` WHERE user_id=? ORDER BY created_at DESC LIMIT $limit");
        $s->execute([$userId]);
        $rows=[];
        while ($r=$s->fetch(\PDO::FETCH_ASSOC)) $rows[]=new Notification($r);
        return $rows;
    }

    public function countUnread(int $userId): int {
        return (int)$this->getDb()->prepare("SELECT COUNT(*) FROM `{$this->_table}` WHERE user_id=? AND read_at IS NULL")
            ->execute([$userId]) ? $this->getDb()->prepare("SELECT COUNT(*) FROM `{$this->_table}` WHERE user_id=? AND read_at IS NULL")->execute([$userId]) : 0;
    }

    public function markAllRead(int $userId): void {
        $this->getDb()->prepare("UPDATE `{$this->_table}` SET read_at=NOW() WHERE user_id=? AND read_at IS NULL")->execute([$userId]);
    }

    public function countUnreadForUser(int $userId): int {
        $s=$this->getDb()->prepare("SELECT COUNT(*) FROM `{$this->_table}` WHERE user_id=? AND read_at IS NULL");
        $s->execute([$userId]);
        return (int)$s->fetchColumn();
    }
}
