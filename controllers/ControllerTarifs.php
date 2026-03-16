<?php
class ControllerTarifs extends Controller {
    public function __construct(array $url) {
        $this->setView('Tarifs', [], true, 'Tarifs — SannaStudio');
    }
}
