<?php

class IndexController extends Controller
{
    
    function loginAction()
    {
        if (isset($_SESSION['user']))
        {
            header('Location: http://' . $_SERVER['SERVER_NAME'] . ROOT_HOME);
            exit();
        }
        $loginSubmit    = $this->getRequest()->getParam('login-submit');
        $registerSubmit = $this->getRequest()->getParam('register-submit');

        $this->template = false;
        $formLogin      = new Form_login();
        $formRegister   = new Form_register();
        $params         = $this->getRequest()->getParams();
        if ($this->getRequest()->isPost() && isset($loginSubmit) && $formLogin->isValid($params)) {
            header('Location: http://' . $_SERVER['SERVER_NAME'] . ROOT_HOME);
        }
        if ($this->getRequest()->isPost() && isset($registerSubmit))
        {
            $this->view->registerDisplay = true;
            if ($formRegister->isValid($params))
            {
                // TODO
            }
        }
        $this->view->login = $formLogin;
        $this->view->register = $formRegister;
    }
    
    function logoutAction()
    {
        Model::factory('user')->logout();
        header('Location: http://' . $_SERVER['SERVER_NAME'] . '/login');
    }

    function indexAction()
    {
        if (!isset($_SESSION['user']))
        {
            header('Location: http://' . $_SERVER['SERVER_NAME'] . '/login');
            exit();
        }
        
        $this->view->user                 = (isset($_SESSION['user'])) ? $_SESSION['user'] : false;
        
    }


}
