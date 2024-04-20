<?php
    session_start();
    //đường dẫn chính
    define("_DIR_ROOT",str_replace('\\','/',__DIR__));
    define ('SITE_ROOT', str_replace('\\','/',realpath(dirname(__FILE__))));

    //tạo web_root
    if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTP']=='on'){
        $web_root = 'https://'.$_SERVER['HTTP_HOST'];
    }else{
        $web_root = 'http://'.$_SERVER['HTTP_HOST'];
    }
    
    $fordel = str_replace($_SERVER['DOCUMENT_ROOT'],'',_DIR_ROOT);
    $web_root = $web_root.$fordel;

    define('_WEB_ROOT',$web_root);


	$config_dir = scandir('config');

	foreach($config_dir as $file) {
        if($file != '.'&& $file != '..' && file_exists('config/'.$file)) {
            require_once 'config/'.$file;
        }
    }

    //kiểm tra config và load database
    if(!empty($config['database'])){
        $db_config = array_filter($config['database']);
        // print_r($db_config);
        if(!empty($db_config)) {
            require_once 'core/Connection.php';
            require_once 'core/QueryBuilder.php';
            require_once 'core/Database.php';
            require_once 'core/QueryBuilder.php';
            require_once 'core/Model.php';
        }
    }

    require_once 'core/Request.php';
    require_once 'core/Response.php';
	require_once 'core/Routes.php';
    require_once 'core/Session.php';
    require_once 'core/Controller.php';
    require_once 'app/RequestApp.php';
	require_once 'app/App.php';
?>