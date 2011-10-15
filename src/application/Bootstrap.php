<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initViewHelpers()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->addHelperPath(APPLICATION_PATH . '/views/helpers', 'Gnome_View_Helper');

        return $view;
    }

}

