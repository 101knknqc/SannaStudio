<?php
class ControllerPortfolio extends Controller {
    public function __construct(array $url) {
        $pm    = new PortfolioManager();
        $items = $pm->getPublished();
        $this->setView('Portfolio', ['items'=>$items], true, 'Portfolio — SannaStudio');
    }
}
