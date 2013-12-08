<?php

function __autoload($className)
{
	if (file_exists(ROOT . DS . 'models' . DS . strtolower($className) . '.php'))
		require_once(ROOT . DS . 'models' . DS . strtolower($className) . '.php');
        if (file_exists(ROOT . DS . 'classes' . DS . strtolower($className) . '.php'))
		require_once(ROOT . DS . 'classes' . DS . strtolower($className) . '.php');
        if (file_exists(ROOT . DS . 'pages' . DS . strtolower($className) . DS . strtolower($className) . '.php'))
		require_once(ROOT . DS . 'pages' . DS . strtolower($className) . DS . strtolower($className) . '.php');
}

function stripSlashesDeep($value)
{
	$value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
	return $value;
}

function removeMagicQuotes()
{
    if ( get_magic_quotes_gpc() )
    {
            $_GET    = stripSlashesDeep($_GET   );
            $_POST   = stripSlashesDeep($_POST  );
            $_COOKIE = stripSlashesDeep($_COOKIE);
    }
}

function callHook()
{
    global $url;
    global $default;

    $queryString = array();
    
    if (!isset($url))
    {
            $controller = 'home';
            $action = 'index';
    }
    else
    {
            //$url = routeURL($url);
            $urlArray = explode("/",$url);
            $controller = $urlArray[0];
            array_shift($urlArray);
            if (isset($urlArray[0]))
            {
                    $action = $urlArray[0];
                    array_shift($urlArray);
            }
            else
                    $action = 'index'; // Default Action
            $queryString = $urlArray;
    }

    if(!file_exists(ROOT . DS . 'pages' . DS . $controller . DS . $controller . '.php'))
    {
            $controller = 'error';
            $action = 'notfound';
            $queryString = array('error'=>$url);
    }


    $controllerName = ucfirst($controller);
    //var_dump(isset($url));

    $dispatch = new $controllerName($controller,$action,false);

    if(!$dispatch->maySeeThisPage()) 
    {
        $controllerName = 'error';
        $action = 'notallowed';
        $dispatch = new $controllerName('error',$action,true);
    }
    else
        $dispatch = new $controllerName($controller,$action,true,$queryString);

    if (method_exists($controllerName, $action))
    {
            call_user_func_array(array($dispatch,$action),$queryString);
    } else {
    }
    
    //var_dump($dispatch);
    
    $dispatch->render();
}