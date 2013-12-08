<?php
session_start();
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors','On');

include_once(ROOT.DS.'inc'.DS.'connect.php');
include_once(ROOT.DS.'inc'.DS.'core.php');
$url = $_GET['url'];
removeMagicQuotes();
$GLOBALS['params'] = explode('/', $_GET['url']);
callHook();