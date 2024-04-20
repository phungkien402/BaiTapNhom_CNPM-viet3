<?php
//Kế thừa từ class model

class AdminModel extends Model{

    protected $table = 'users';

    /**từ lớp con gọi lớp cha
    * public function __construct(){
    *     parent::__construct();
     }
    */

     public function getDB(){
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

    public function getUser(){
        $data = $this->table('users')->select('id,name,email,level')->get();
        return $data;
    }

    public function getLoai(){
        $data = $this->table('loai')->select('*')->oderBy("id")->get();
        return $data;
    }


    public function getList($table){
        $data = $this->table($table)->select('*')->get();
        return $data;
    }

    public function getFiled($table,$field){
        $data = $this->table($table)->select($field)->get();
    }


    public function sreach($table,$colum,$sreach){
        $data = $this->table($table)->whereLike($colum,$sreach)->select('')->frist();
        return $data;
    }

    public function insertList($table,$data){
        $this->table($table)->insert($data);
    }

    public function updateUser($table,$colum,$condition,$data){

        $data = $this->table($table)->where($colum,'=',$condition)->update($data);
    }

    public function deleteList($table,$colum,$condition){
        $this->table($table)->where($colum,'=',$condition)->delete();
    }
}