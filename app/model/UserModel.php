<?php
	class UserModel extends Model{
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
	        return 'users_imformation';
	    }

	    public function fieldFill(){
	        return 'full_name,address,gender,birthday,phone_number';
	    }

	    public function primaryKey(){
	        return 'id_user';
	    }

	    public function getFellAll(){
	        $data = $this->getFethAll();
	        return $data;
	    }


	    public function getList(){
	        $data = $this->table('users_imformation')->where('name','=','viet')->WhereLike('name','%v%')->select('id,name')->get();
	        return $data;
	    }

	    public function insertItem($data){
	        $this->table('users_imformation')->insert($data);
	    }

	    //lấy dữ liệu 1 sản phâm
	    public function getItem($id){
	        $this->table('users_imformation')->where('id_user','=',$id);
	    }

	    public function getFrist($id){
	        $data = $this->table('users_imformation')->where('id_imformation','=',$id)->select('*')->frist();
	        return $data;
		}
	}

?>