<?php
class Testimonial {
    private $id,$name,$role,$photo_url,$content,$rating,$published,$created_at;
    public function __construct(array $d) { foreach ($d as $k=>$v) if (property_exists($this,$k)) $this->$k=$v; }
    public function getId(): int        { return (int)$this->id; }
    public function getName(): string   { return $this->name ?? ''; }
    public function getRole(): string   { return $this->role ?? ''; }
    public function getPhotoUrl(): string{ return $this->photo_url ?? ''; }
    public function getContent(): string{ return $this->content ?? ''; }
    public function getRating(): int    { return (int)$this->rating; }
    public function isPublished(): bool { return (bool)$this->published; }
}

class TestimonialManager extends Model {
    protected $_table = 'testimonials';
    protected $_obj   = 'Testimonial';

    public function getPublished(): array {
        $s=$this->getDb()->query("SELECT * FROM `{$this->_table}` WHERE published=1 ORDER BY created_at DESC");
        $rows=[];
        while ($r=$s->fetch(\PDO::FETCH_ASSOC)) $rows[]=new Testimonial($r);
        return $rows;
    }

    public function getAll(): array {
        $s=$this->getDb()->query("SELECT * FROM `{$this->_table}` ORDER BY created_at DESC");
        $rows=[];
        while ($r=$s->fetch(\PDO::FETCH_ASSOC)) $rows[]=new Testimonial($r);
        return $rows;
    }
}
