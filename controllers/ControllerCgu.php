<?php
class ControllerCgu extends Controller {
    public function __construct(array $url) {
        $this->setView('Cgu', [], true, 'Conditions Générales d\'Utilisation — SannaStudio');
    }
}
