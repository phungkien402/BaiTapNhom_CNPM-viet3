<?php
//Kế thừa từ class model

class ProductModel extends Model{

    protected $table = 'Items';

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
        return 'Items';
    }

    public function fieldFill(){
        return 'id_item,name_item,image,price,evaluate';
    }

    public function primaryKey(){
        return 'id_Item';
    }

    public function getFellAll(){
        $data = $this->getFethAll();
        return $data;
    }


    public function getList(){
        $data = $this->table('items')->where('name','=','viet')->WhereLike('name','%v%')->select('id,name')->get();
        return $data;
    }

    public function insertItem($data){
        $this->table('Items')->insert($data);
    }

    //lấy dữ liệu 1 sản phâm
    public function getItem($id){
        $this->table('items')->where('id_item','=',$id);
    }

    public function getFrist(){
        $data = $this->table('items')->where('name','=','viet')->select('id,name,pass')->frist();
        return $data;
    }
}