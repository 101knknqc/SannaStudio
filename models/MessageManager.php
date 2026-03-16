<?php
class Message {
    private $id,$from_id,$to_id,$subject,$body,$read_at,$created_at;
    public function __construct(array $d) { foreach ($d as $k=>$v) if (property_exists($this,$k)) $this->$k=$v; }
    public function getId(): int        { return (int)$this->id; }
    public function getFromId(): int    { return (int)$this->from_id; }
    public function getToId(): int      { return (int)$this->to_id; }
    public function getSubject(): string{ return $this->subject ?? ''; }
    public function getBody(): string   { return $this->body ?? ''; }
    public function isRead(): bool      { return $this->read_at !== null; }
    public function getCreatedAt(): string { return $this->created_at ?? ''; }
}

class MessageManager extends Model {
    protected $_table = 'messages';
    protected $_obj   = 'Message';

    public function send(int $fromId, int $toId, string $subject, string $body): int {
        return $this->insert(['from_id'=>$fromId,'to_id'=>$toId,'subject'=>$subject,'body'=>$body]);
    }

    public function getInbox(int $userId): array {
        $s=$this->getDb()->prepare("SELECT m.*,u.first_name,u.last_name FROM `{$this->_table}` m JOIN users u ON u.id=m.from_id WHERE m.to_id=? ORDER BY m.created_at DESC");
        $s->execute([$userId]);
        return $s->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getSent(int $userId): array {
        $s=$this->getDb()->prepare("SELECT m.*,u.first_name,u.last_name FROM `{$this->_table}` m JOIN users u ON u.id=m.to_id WHERE m.from_id=? ORDER BY m.created_at DESC");
        $s->execute([$userId]);
        return $s->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function countUnread(int $userId): int {
        $s=$this->getDb()->prepare("SELECT COUNT(*) FROM `{$this->_table}` WHERE to_id=? AND read_at IS NULL");
        $s->execute([$userId]);
        return (int)$s->fetchColumn();
    }

    public function markRead(int $id, int $userId): void {
        $this->getDb()->prepare("UPDATE `{$this->_table}` SET read_at=NOW() WHERE id=? AND to_id=?")->execute([$id,$userId]);
    }

    public function getById(int $id): ?array {
        $s=$this->getDb()->prepare("SELECT m.*,uf.first_name AS from_first,uf.last_name AS from_last,ut.first_name AS to_first,ut.last_name AS to_last FROM `{$this->_table}` m JOIN users uf ON uf.id=m.from_id JOIN users ut ON ut.id=m.to_id WHERE m.id=?");
        $s->execute([$id]);
        return $s->fetch(\PDO::FETCH_ASSOC) ?: null;
    }
}
