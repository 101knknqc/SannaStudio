<?php
class View {
    private string $file;
    private string $folder;
    private string $defaultTitle = 'SannaStudio';

    public function __construct(string $action, string $folder = 'landing') {
        $this->folder = $folder;
        $this->file   = PATH_VIEWS.'/'.$folder.'/view'.$action.'.php';
    }

    public function prepare(array $data = [], bool $template = true, ?string $title = null): string {
        $content = $this->renderFile($this->file, $data);

        if (!$template) return $content;

        $templateFile = PATH_VIEWS.'/'.$this->folder.'/template.php';
        return $this->renderFile($templateFile, array_merge($data, [
            'content' => $content,
            'title'   => $title ?? $this->defaultTitle,
        ]));
    }

    public function generate(array $data = [], bool $template = true, ?string $title = null): void {
        echo $this->prepare($data, $template, $title);
        exit;
    }

    private function renderFile(string $file, array $data): string {
        if (!file_exists($file)) {
            http_response_code(404);
            throw new Exception("Vue introuvable : $file");
        }
        extract($data, EXTR_SKIP);
        ob_start();
        require $file;
        return ob_get_clean();
    }
}
