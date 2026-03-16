<?php
class ControllerPolitique extends Controller {
    public function __construct(array $url) {
        $this->setView('Politique', [], true, 'Politique de confidentialité — SannaStudio');
    }
}
