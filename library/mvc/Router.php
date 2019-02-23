<?php

class Router
{

    private $_routes;
    public $uri;

    function __construct($routes)
    {
        $this->_routes = $routes;
    }

    public function execute()
    {
        try
        {
            // find the route
            $uriTab = explode('?', $_SERVER['REQUEST_URI']);
            $uri    = substr($uriTab[0], strlen(WEB_ROOT));

            if (!isset($this->_routes[$uri]) && $uri != '"/favicon.ico"') {
                throw new Exception('no route added for ' . $_SERVER['REQUEST_URI']);
            }

            // explode the route (can be improved)
            $moduleCtrlAction = array_reverse(explode('/', $this->_routes[$uri])); // array(actionName&ctrlName, module)
            $ctrlAction       = array_reverse(explode('#', $moduleCtrlAction[0])); // arrray(actionName, ctrlName)

            $ctrlName = (strtolower($moduleCtrlAction[1]) != 'common') ? ucfirst($moduleCtrlAction[1]) . '_' : '';
            $ctrlName .= ucfirst($ctrlAction[1]) . 'Controller';

            if ($ctrlAction[0] == 'index' && $ctrlAction[1] == 'index' && $moduleCtrlAction[1] == 'common') { // home page redirection
                header('Location: http://' . $_SERVER['SERVER_NAME'] . ROOT_HOME);
            } else {
                $controller = new $ctrlName($ctrlAction[0], $ctrlAction[1], $moduleCtrlAction[1]); // go to the controller
            }
            
            $controller->execute();
        }
        catch (Exception $exception)
        {
            $controller = new ErrorController('error');
            $controller->setException($exception);
            $controller->execute();
        }
    }
}
