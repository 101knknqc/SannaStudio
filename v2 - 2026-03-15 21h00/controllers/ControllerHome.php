<?php
class ControllerHome extends Controller {
    public function __construct(array $url) {
        $this->setView('Home', [], true, 'SannaStudio — Webdiffusion Professionnelle Québec');
    }
}
