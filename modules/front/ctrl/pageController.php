<?php

class Front_PageController extends Controller
{
    
    function indexAction()
    {
        $this->view->text    = "coucou";
    }
}

