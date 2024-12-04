<?php

class GlobalController {

    public $current_view = __DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'homeController.php';
    
    function change_view($view) {
        $this->current_view = $view;
        // require_once($current_view);
    }
}