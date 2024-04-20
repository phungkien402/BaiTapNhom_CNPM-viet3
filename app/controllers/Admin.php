<?php
class Admin extends Controller{
	public $__admin,$__user;
	public function __construct(){
		global $config;
		$this->__admin = $this->model('AdminModel');
	}

	public function index(){
		if(isset($_SESSION) && isset($_SESSION['id']['level']) ){
			if($_SESSION['id']['level'] == 0 ){
				$this->render('layout/admin.php');
			}else{
				header("location: "._WEB_ROOT);
			}
		}else{
			header('location: '._WEB_ROOT);
		}
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

	public function getUser($table){
		$request = new Request();
		if($request->getMethod() == 'get'){
			if(!empty($table)){
				$data = $this->__user->getList($table);
				print_r($data);
			}else{
				echo "nhập table";
			}
		}
	}

	public function sreachInfo($table,$colum,$search){
		$request = new Request();
		if($request->getMethod() == 'get'){
			if(!empty($table) && !empty($colum) && !empty($search)){
				$data = $this->__user->search($table,$colum,$search);
				print_r($data);
			}else{
				echo "nhập table nhập colum nhập sreach";
			}
		}
	}

	public function insertInfo(){
		$request = new Request();
		if($request->getMethod == 'post'){
			$table = $_POST['table'];
			$colum = $_POST['colum'];
			unset($_POST['table']);
			unset($_POST['colum']);
			$data = array_values($_POST);

			$this->__admin->insertList($table,$colum,$data);
			$dataAdmin = getList($table);
			print_r($dataAdmin);
		}
	}

	public function updateInfo(){
		$request = new Request();
		if($request->getMethod == 'post'){
			$table = $_POST['table'];
			$colum = $_POST['colum'];
			$condition = $_POST['condition'];
			unset($_POST['table']);
			unset($_POST['colum']);
			unset($_POST['condition']);
			$data = array_values($_POST);

			$this->__admin->updateList($table,$condition,$colum,$data);
			$dataAdmin = getList($table);
			print_r($dataAdmin);
		}
	}

	public function deleteInfo(){
		$request = new Request();
		if($request->getMethod == 'post'){
			$table = $_POST['table'];
			$colum = $_POST['colum'];
			$condition = $_POST['condition'];

			$this->__admin->deleteList($table,$condition,$colum);
			$dataAdmin = getList($table);
			print_r($dataAdmin);
		}
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

	//xử lý request
	public function requestAdmin(){
		$url = $_GET['url'];
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
			if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
				// echo "vfdgfdg";
				require_once 'app/RequestApp.php';
				$requestApp = new RequestApp($url);
			}
		}
	}
}

?>
