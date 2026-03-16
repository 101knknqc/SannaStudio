<?php
class Invoice {
    private $id,$user_id,$appt_id,$number,$type,$amount,$status,$pdf_path,$notes,$issued_at,$created_at;
    public function __construct(array $d) { foreach ($d as $k=>$v) if (property_exists($this,$k)) $this->$k=$v; }
    public function getId(): int        { return (int)$this->id; }
    public function getUserId(): int    { return (int)$this->user_id; }
    public function getNumber(): string { return $this->number ?? ''; }
    public function getType(): string   { return $this->type ?? 'devis'; }
    public function getAmount(): float  { return (float)$this->amount; }
    public function getStatus(): string { return $this->status ?? 'draft'; }
    public function getPdfPath(): string{ return $this->pdf_path ?? ''; }
    public function getNotes(): string  { return $this->notes ?? ''; }
    public function getIssuedAt(): string { return $this->issued_at ?? ''; }
    public function getCreatedAt(): string { return $this->created_at ?? ''; }
}

class InvoiceManager extends Model {
    protected $_table = 'invoices';
    protected $_obj   = 'Invoice';

    public function create(array $data): int {
        $num = 'SSP-'.date('Y').'-'.str_pad($this->countAll()+1, 4, '0', STR_PAD_LEFT);
        return $this->insert([
            'user_id'  => $data['user_id'],
            'appt_id'  => $data['appt_id'] ?? null,
            'number'   => $num,
            'type'     => $data['type'] ?? 'devis',
            'amount'   => $data['amount'] ?? 0,
            'status'   => $data['status'] ?? 'draft',
            'notes'    => $data['notes'] ?? null,
            'issued_at'=> $data['issued_at'] ?? date('Y-m-d'),
        ]);
    }

    public function getByUser(int $userId): array {
        $s=$this->getDb()->prepare("SELECT * FROM `{$this->_table}` WHERE user_id=? ORDER BY created_at DESC");
        $s->execute([$userId]);
        $rows=[];
        while ($r=$s->fetch(\PDO::FETCH_ASSOC)) $rows[]=new Invoice($r);
        return $rows;
    }

    public function getAll(): array {
        $s=$this->getDb()->prepare("SELECT i.*,u.first_name,u.last_name,u.email FROM `{$this->_table}` i JOIN users u ON u.id=i.user_id ORDER BY i.created_at DESC");
        $s->execute();
        return $s->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function countAll(): int {
        return (int)$this->getDb()->query("SELECT COUNT(*) FROM `{$this->_table}`")->fetchColumn();
    }

    public function getById(int $id): ?Invoice {
        $s=$this->getDb()->prepare("SELECT * FROM `{$this->_table}` WHERE id=?");
        $s->execute([$id]);
        $r=$s->fetch(\PDO::FETCH_ASSOC);
        return $r ? new Invoice($r) : null;
    }
}
