<?php
class Routes{
    public function __construct(){
        
    }

    //hàm xử lý
    public function handleRouter($url){
        global $router;

        //cắt '/' 2 đầu
        $url = trim($url,'/');
        // echo $url;
        //
        $handleUrl = $url;
        
        //kiểm tra xem họ có tìm gì trên thanh công cụ tìm kiếm không
        if(!empty($router)){
            foreach($router as $key => $value){
                if(preg_match('~'.$key.'~is',$url)){
                   $handleUrl=preg_replace('~'.$key.'~is',$value,$url);
                }
            }
        }
        return $handleUrl;
    }
}

?>