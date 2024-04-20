<?php
class Connection{
    //tạo ra biến tĩnh, chỉ gọi 1 lần chạy
    private static $instance = null, $conn=null;

    public function __construct($config){
        //kết nối database
        // echo "ket noi cơ sở dữ liêu<pre>";
        // print_r($config);


        try{
            //cấu hình dns
            $dns = 'mysql:dbname='.$config['db'].';host='.$config['host'];
    
            //cấu hình options
    
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];
            $conn = new PDO($dns,$config['user'],$config['pass'], $options);
            self::$conn = $conn;
        
        }catch(Exception $e){
            App::$app->loadError('400');
            die($mess);
        }
    }

    public static function getInstance($config){
        // kiểm tra khi đã kết nối vào database rồi
        // sẽ không tạo ra Connection nữa
        if(self::$instance == null){
            $connection = new Connection($config);
            self::$instance = self::$conn;
        }

        return self::$instance;
    }
}

?>