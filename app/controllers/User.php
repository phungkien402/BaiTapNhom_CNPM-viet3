<?php
class User extends Controller{
	public $__user;
	public function __construct(){
		$this->__user = $this->model('UserModel');
	}

	public function index(){
		echo "ffds";
	}

	//trả về cho js 1 chi tiết sản phẩm
	public function detail($id = ''){
		$request = new Request();
		if($request->getMethod() == 'get'){
			$data = $this->__product->getItem($id);
			echo json_encode($data);
		}else{

		}
	}

	public function getUserFrist($id){
		$data = $this->__user->getFrist($id);
		print_r($data);
	}

	public function getAll(){
		$request = new Request();
		if($request->getMethod() == 'get'){
			$data = $this->__user->getFellAll();
			print_r($data);
		}
	}

	// nhập dữ liêu sản phẩm từ js
	public function postUser(){
		$request = new Request();
		if($request->getMethod() == 'post'){
			$request->rules([
				'cli' => 'required|CCCD|unique:user_imformation:cli',
				'full_name' => 'required',
				'address' => 'required',
				'gender' => 'required',
				'birthday' => 'required|date',
				'phone_number' => 'required|std'
			]);

			$request->message([
				'cli.required' => 'Căn cước công dân không được để trống',
				'cli.CCCD' => 'Phải là căn cước công dân',
				'cli.unique' => 'Đã sử dụng căn cước công dân trên hệ thống',
				'full_name.required' => 'Tên không được để trống',
				'address.required' => 'Địa chỉ không được để trống',
				'gender.required' => 'Giới tính không được để trống',
				'birthday.required' => 'Ngày sinh không được để trống',
				'birthday.date' => 'Ngày sinh phải theo chuân dd-mm-yyyy. VD: 22-05-2022',
				'phone_number.required' => 'Số điền thoại không được để trống',
				'phone_number.std' => 'Phải là số điền thoại'
			]);

			if(!$request->validate()){
				print_r($request->errors());
			}else{
				if($request->kytu($_POST)){
					$data = [
					'cli' => $_POST['cli'],
					'full_name' => $_POST['full_name'],
					'address' => $_POST['address'],
					'gender' => $_POST['gender'],
					'birthday' => date($_POST['birthday']),
					'phone_number' => $_POST['phone_number']
					];
					$this->__user->insertItem($data);
				}else{
					echo "các trường không được chứa ký tự ' ";
				}				
			}
		}else{
			$response = new Response();
			$response->redirect('home/index');
		}
	}
}

?>
