<?php
//Kế thừa từ class model

class HomeModel extends Model{

    protected $table = 'users';

    /**từ lớp con gọi lớp cha
    * public function __construct(){
    *     parent::__construct();
     }
    */

     public function getDB(){
        // var_dump($this->db);
        $data =$this->getFethAll();
        return $data;
     }

    //tạo ra 1 bảng dữ liệu

    public function tableFill(){
        return 'users';
    }

    public function fieldFill(){
        return '';
    }

    public function primaryKey(){
        return 'id';
    }

    public function getAll(){
        $data = $this->getFethAll();
        print_r($data);
    }

    public function getItem(){
        $data = $this->table("Items")->select("*")->get();
        $i=0;
        for($i;$i<count($data);$i++){
            $anh = _WEB_ROOT.'/public/items/images/'.$data[$i]['image'];
            $data[$i]['image'] = $anh;
        }
        return $data;
    }

    public function search($table,$field,$name="",$sort="ASC"){
        $data = $this->table("items")->whereLike($field,"%$name%")->oderBy('price',$sort)->select("*")->get();
        $i=0;
        for($i;$i<count($data);$i++){
            $anh = _WEB_ROOT.'/public/items/images/'.$data[$i]['image'];
            $data[$i]['image'] = $anh;
            echo "\n";
        }
        return $data;
    }

    public function getItemDetail($id,$field="id"){
        $data = $this->table('items')->where('id','=',"$id")->select('*')->frist();
        if(!empty($data)){
            $anh = _WEB_ROOT.'/public/items/images/'.$data['image'];
            $data['image'] = $anh;
            return $data;
        }
        return false;
    }

    public function isCart($table,$id1,$id2){
        $data = $this->table($table)->where('user_id','=',$id1)->
        where('product_id','=',$id2)->get();
        return $data;
    }

    public function getID($name){
        $data = $this->table('users')->where('name','=',"$name")->select("id")->frist();
        return $data;
    }

    public function getLoat(){
        $data = $this->table('items')->select('loai')->get();
        return $data;
    }

    public function getFiled($table,$field){
        $data = $this->table($table)->select($field)->get();
        return $data;
    }

    public function getFieldWhere($table,$field,$condition){
        $data = $this->table($table)->select("*")->where($field,'=',$condition)->get();
        $i=0;
        for($i;$i<count($data);$i++){
            $anh = _WEB_ROOT.'/public/items/images/'.$data[$i]['image'];
            $data[$i]['image'] = $anh;
        }
        return $data;
    }

    public function getGia($sapxep){
        $data = $this->table('items')->select('*')->orderBy('price',$sapxep)->get();
        return $data;
    }

    public function set_cart($data){
        echo "\n\n\n";
        print_r($data);
        echo "\n\n\n";
        $data = $this->table('cart_items')
        ->where('user_id','=',$data['user_id'])
        ->where('product_id','=',$data['product_id'])
        ->update(['quantity' => $data['quantity']]);
    }

    public function getList($id){
        $data = $this->table('users')->where('id','=',$id)->select('id,name')->get();
        return $data;
    }

    public function getOne($table,$name){
        $data = $this->table($table)->where('user_id','=',$name)->get();
        return $data;
    }

    public function getTables($table1,$table2,$field,$relationShip){
        $data = $this->table($table1)->select($field)->join($table2,$relationShip)->get();
        $i=0;
        if(count($data) > 0){
            for($i;$i<count($data);$i++){
                if(empty($data[$i]['image'])){
                    $anh = _WEB_ROOT.'/public/items/images/'.$data[$i]['image'];
                    $data['image'] = $anh;
                }
            }
        }
        return $data;
    }
        
    public function getFrist($name){
        $data = $this->table('users')->where('name','=',$name)->orWhere('email','=',$name)->select('id,name,email,level')->frist();
        return $data;
    }

    public function insertHome($table="users",$data){
        $this->table($table)->insert($data);
    }

    public function updateHome($table,$data){
        $data = $this->table($table)->update($data);
        $this->lastId();
    }
}