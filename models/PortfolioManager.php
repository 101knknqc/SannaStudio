<?php
class PortfolioItem {
    private $id,$title,$description,$category,$cover_url,$video_url,$tags,$published,$sort_order,$created_at;
    public function __construct(array $d) { foreach ($d as $k=>$v) if (property_exists($this,$k)) $this->$k=$v; }
    public function getId(): int          { return (int)$this->id; }
    public function getTitle(): string    { return $this->title ?? ''; }
    public function getDescription(): string { return $this->description ?? ''; }
    public function getCategory(): string { return $this->category ?? ''; }
    public function getCoverUrl(): string { return $this->cover_url ?? ''; }
    public function getVideoUrl(): string { return $this->video_url ?? ''; }
    public function getTags(): array      { return array_filter(array_map('trim', explode(',', $this->tags ?? ''))); }
    public function isPublished(): bool   { return (bool)$this->published; }
}

class PortfolioManager extends Model {
    protected $_table = 'portfolio';
    protected $_obj   = 'PortfolioItem';

    public function getPublished(): array {
        $s=$this->getDb()->query("SELECT * FROM `{$this->_table}` WHERE published=1 ORDER BY sort_order ASC, created_at DESC");
        $rows=[];
        while ($r=$s->fetch(\PDO::FETCH_ASSOC)) $rows[]=new PortfolioItem($r);
        return $rows;
    }

    public function getAll(): array {
        $s=$this->getDb()->query("SELECT * FROM `{$this->_table}` ORDER BY sort_order ASC, created_at DESC");
        $rows=[];
        while ($r=$s->fetch(\PDO::FETCH_ASSOC)) $rows[]=new PortfolioItem($r);
        return $rows;
    }
}
