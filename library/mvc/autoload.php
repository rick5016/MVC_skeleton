<?php
function autoloader($className)
{
    $modules = array('common', 'front');
    if (strlen($className) > 10 && substr($className, -10) == 'Controller') // controller
    {
        $ctrl = array_reverse(explode('_', $className));
        foreach ($modules as $module)
        {
            if (file_exists(ROOT_PATH . '/modules/' . $module . '/ctrl/' . $ctrl[0] . '.php')) {
                require_once ROOT_PATH . '/modules/' . $module . '/ctrl/' . $ctrl[0] . '.php';
            }
        }
    }
    elseif (substr($className, 0, 5) == 'Form_') // forms
    {
        $form = array_reverse(explode('_', $className));
        foreach ($modules as $module)
        {
            if (file_exists(ROOT_PATH . '/modules/' . $module . '/form/' . $form[0] . '.php')) {
                require_once ROOT_PATH . '/modules/' . $module . '/form/' . $form[0] . '.php';
            }
        }
    }
    if (substr($className, 0, 6) == 'Plugin') // custom Twig functions
    {
        $plugin = array_reverse(explode('_', $className));
        foreach ($modules as $module)
        {
            if (file_exists(ROOT_PATH . '/library/plugins/twig/' . $plugin[0] . '.php')) {
                require_once ROOT_PATH . '/library/plugins/twig/' . $plugin[0] . '.php';
            }
        }
    }
    else // MVC
    {
        if (file_exists(ROOT_PATH . '/library/mvc/' . $className . '.php')) {
            require_once ROOT_PATH . '/library/mvc/' . $className . '.php';
        }
    }
}