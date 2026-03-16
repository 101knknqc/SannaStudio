<?php
class ControllerBlog extends Controller {
    public function __construct(array $url) {
        $bm   = new BlogManager();
        $slug = $url[1] ?? null;

        if ($slug) {
            $post = $bm->getBySlug($slug);
            if (!$post) { Session::flash('error','Article introuvable.'); functions::redirect('blog'); }
            $this->setView('BlogPost', ['post'=>$post,'title'=>$post->getTitle().' — SannaStudio'], true, $post->getTitle().' — SannaStudio');
            return;
        }

        $posts = $bm->getPublished(12);
        $this->setView('Blog', ['posts'=>$posts], true, 'Actualités — SannaStudio');
    }
}
