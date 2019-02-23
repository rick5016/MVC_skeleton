<?php

class Controller
{

    public $action;
    public $ctrl;
    public $module;

    public $view        = null;
    public $template    = true; // TODO

    protected $_request = null;

    public function __construct($action = 'index', $ctrl = 'index', $module = 'common')
    {
        $this->action = $action;
        $this->ctrl   = $ctrl;
        $this->module = $module;
        $this->view   = new View();
    }

    public function getRequest()
    {
        if ($this->_request == null) {
            $this->_request = new Request();
        }

        return $this->_request;
    }

    public function execute()
    {
        // find the action
        if (!method_exists($this, $this->action . 'Action')) {
            throw new Exception($this->action . 'Action does not exist');
        }

        $this->{$this->action . 'Action'}(); // go to the action

        // TODO
        if (!($this->action == 'index' && $this->ctrl == 'index' && $this->module == 'common') && $this->template && empty($_SERVER['HTTP_X_REQUESTED_WITH']))
        {
            $controllerFront = new IndexController();
            $controllerFront->indexAction();
            $this->view->add($controllerFront->view->parameters);
        }

        // launch the view associated with the action
        $this->view->renderViewScript($this->action, $this->ctrl, $this->module, $this->template);
    }
}
