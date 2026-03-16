<?php
class BlogPost {
    private $id,$author_id,$title,$slug,$excerpt,$content,$cover_url,$published,$published_at,$created_at;
    public function __construct(array $d) { foreach ($d as $k=>$v) if (property_exists($this,$k)) $this->$k=$v; }
    public function getId(): int         { return (int)$this->id; }
    public function getTitle(): string   { return $this->title ?? ''; }
    public function getSlug(): string    { return $this->slug ?? ''; }
    public function getExcerpt(): string { return $this->excerpt ?? ''; }
    public function getContent(): string { return $this->content ?? ''; }
    public function getCoverUrl(): string{ return $this->cover_url ?? ''; }
    public function isPublished(): bool  { return (bool)$this->published; }
    public function getPublishedAt(): string { return $this->published_at ?? ''; }
    public function getCreatedAt(): string   { return $this->created_at ?? ''; }
}

class BlogManager extends Model {
    protected $_table = 'blog_posts';
    protected $_obj   = 'BlogPost';

    public function getPublished(int $limit=10, int $offset=0): array {
        $s=$this->getDb()->prepare("SELECT * FROM `{$this->_table}` WHERE published=1 ORDER BY published_at DESC LIMIT $limit OFFSET $offset");
        $s->execute(); $rows=[];
        while ($r=$s->fetch(\PDO::FETCH_ASSOC)) $rows[]=new BlogPost($r);
        return $rows;
    }

    public function getBySlug(string $slug): ?BlogPost {
        $s=$this->getDb()->prepare("SELECT * FROM `{$this->_table}` WHERE slug=? AND published=1");
        $s->execute([$slug]);
        $r=$s->fetch(\PDO::FETCH_ASSOC);
        return $r ? new BlogPost($r) : null;
    }

    public function getAll(): array {
        $s=$this->getDb()->query("SELECT * FROM `{$this->_table}` ORDER BY created_at DESC");
        $rows=[];
        while ($r=$s->fetch(\PDO::FETCH_ASSOC)) $rows[]=new BlogPost($r);
        return $rows;
    }

    public function create(array $d): int {
        $slug = $this->makeSlug($d['title']);
        return $this->insert(['author_id'=>$d['author_id']??null,'title'=>$d['title'],'slug'=>$slug,'excerpt'=>$d['excerpt']??null,'content'=>$d['content'],'cover_url'=>$d['cover_url']??null,'published'=>$d['published']??0,'published_at'=>$d['published']?date('Y-m-d H:i:s'):null]);
    }

    public function countPublished(): int {
        return (int)$this->getDb()->query("SELECT COUNT(*) FROM `{$this->_table}` WHERE published=1")->fetchColumn();
    }

    private function makeSlug(string $title): string {
        $s=strtolower($title);
        $s=preg_replace('/[àáâãäå]/','a',$s); $s=preg_replace('/[èéêë]/','e',$s);
        $s=preg_replace('/[ìíîï]/','i',$s); $s=preg_replace('/[òóôõö]/','o',$s);
        $s=preg_replace('/[ùúûü]/','u',$s); $s=preg_replace('/[^a-z0-9]+/','-',$s);
        return trim($s,'-').'-'.time();
    }
}
