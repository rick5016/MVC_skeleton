<?php

class View
{

    public $twig;
    public $view;
    public $parameters = array();

    public function __construct()
    {
        $cache = false;
//        $cache = '../temp/views'; // to activate in production
        
        $this->twig = new Twig_Environment(new Twig_Loader_Filesystem("../modules"), array("cache" => $cache));
        $this->twig->addGlobal('app', new Plugin_Form());
    }
    
    public function __set($name, $arguments)
    {
        $this->parameters[$name] = $arguments;
    }

    public function __get($name)
    {
        if (isset($this->parameters[$name])) {
            return $this->parameters[$name];
        }
        
        return null;
    }
    
    public function add(array $params)
    {
        $this->parameters += $params;
    }
    
    public function renderViewScript($action, $ctrl, $module, $template)
    {
        // find the view
        if (file_exists(ROOT_PATH . '/modules/' . $module . '/views/' . $ctrl . '#' . $action . '.html')) {
            $path = $module . '/views/' . $ctrl . '#' . $action . '.html';
        } else {
            if (file_exists(ROOT_PATH . '/modules/' . $module . '/views/' . $action . '.html')) {
                $path = $module . '/views/' . $action . '.html';
            } else {
                throw new Exception('"/modules/' . $module . '/views/' . $ctrl . '#' . $action . '.html" OR  "/modules/' . $module . '/views/' . $action . '.html" does not exist');
            }
        }
        
        // unique rendering
        if (!$template || !empty($_SERVER['HTTP_X_REQUESTED_WITH']))
        {
            $viewScript = $this->twig->load($path);
            $render = $viewScript->render(array('content' => ob_get_clean()) + $this->parameters);
            
            // AJAX
            if  (!empty($_SERVER['HTTP_X_REQUESTED_WITH']))
            {
                echo json_encode($render);
                exit;
            }
            
            echo $render;
            exit;
        }
        
        // rendered with template
        $this->view = $this->twig->load("/common/views/template.html");
        $viewScript = $this->twig->load($path);
        $content    = $viewScript->render(array('content' => ob_get_clean()) + $this->parameters);
        
        echo $this->view->render(array('content' => $content) + $this->parameters);
        exit;
    }
}
