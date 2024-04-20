<?php
class HomeRequest extends Controller
{
	public $homeModel;

	public function __construct()
	{
		$this->homeModel = $this->model('HomeModel');
	}

	public function index()
	{
		$data = $this->homeModel->getItem();
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}

	public function detail(){
		// print_r($_POST);
		if(isset($_POST['id'])){
			// print_r($_POST);
			$id = $_POST['id'];
			$data = $this->homeModel->getItemDetail($id);
			
			echo json_encode($data, JSON_UNESCAPED_UNICODE);
		}
	}
	
	public function session(){
		$session = new Session();
		echo json_encode($session->getSession('id'),JSON_UNESCAPED_UNICODE);
	}	

	public function loai()
	{
		$data = $this->homeModel->getLoai();
		print_r($data);
	}

	public function search()
	{
		if(isset($_POST['name'])){
			$name = $_POST['name'];
		}else{
			$name = "";
		}	
		$data = $this->homeModel->search('items', 'name_item', $name);
		if(isset($_POST['sort'])){
			$sort = $_POST['sort'];
			$data = $this->homeModel->search('items', 'name_item', $name,$sort);
		}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}

	public function searchLoai(){
		// print_r($_POST);
		$data = $this->homeModel->getFieldWhere('items','id_loai',$_POST['id']);
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
	}

	public function gia()
	{
		if (isset($_POST['data'])) {
			$name = $_POST['data'];
			$data = $this->homeModel->getGia($name);
			print_r($data);
		}
		echo "fail";
	}

	public function list()
	{
		$data = $this->homeModel->getFrist($_POST['name']);
		echo json_encode($data);
	}

	public function getID(){
		$data = $this->homeModel->getID($_POST);
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
	}

	//xử lý url
	public function url(){
		echo json_encode(_WEB_ROOT, JSON_UNESCAPED_UNICODE);
	}

	public function sidebarLoai(){
		$data = $this->homeModel->getFiled('loai','ten,id');
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
	}

	public function dangKy()
	{
		$request = new Request();
		// echo $request->getMethod();
		if ($request->getMethod() == 'post') {
			//Set rule
			$request->rules([
				'name' => "std|required|min:5|max:40|unique:users:name",
				'email' => "email|min:6|unique:users:email",
				'pass' => "required|min:6",
				'confirm_password' => "required|match:pass",
			]);

			$request->message([
				'name.std' => 'Số điện thoại không hợp lệ',
				'name.required' => 'Tài khoản không được để trống',
				'name.min' => 'Tài khoản phải lớn hơn 5 ký tự',
				'name.max' => 'Tài khoản phải nhỏ hơn 40 ký tự',
				'name.unique' => 'Số điền thoại đã có trong hệ thông',
				'email.email' => 'email không hợp lệ',
				'email.min' => 'Email phải lơn hơn 6 ký tự',
				'email.unique' => 'Địa chỉ email đã tồn tại',
				'pass.required' => 'Mật khẩu không được để trống',
				'pass.min' => 'Mật khẩu phải lớn hơn 6 ký tự',
				'confirm_password.required' => 'Nhâp lại mật khẩu không được để trống',
				'confirm_password.match' => 'Mật khẩu nhập lại không trùng',
			]);

			if (
				$request->kytu(
					[
						$_POST['name'],
						$_POST['pass'],
						$_POST['email']
					]
				)
			) {
				$validate = $request->validate();
				if (!$validate) {
					$json = json_encode($request->errors(), JSON_UNESCAPED_UNICODE);
					echo $json;
				} else {
					$data = [
						'name' => $_POST['name'],
						'pass' => md5($_POST['pass']),
						'email' => $_POST['email'],
						'level' => '3',
					];
					$this->homeModel->insertHome('users',$data);
					echo "submit";
				}
			} else {
				echo "kytu";
			}
		} else {
			$response = new Response();
			$response->redirect('home/dangKy');
		}
	}

	public function dangNhap()
	{
		$_POST['pass'] = md5($_POST['pass']);
		$request = new Request();

		if ($request->getMethod() == 'post') {
			if (
				$request->kytu(
					[
						$_POST['name'],
						$_POST['pass'],
					]
				)
			) {
				// echo $_POST['pass'];
				$request->rules([
					'name' => 'required|min:5|max:40|taiKhoan:users:name?email',
					'pass' => 'required|min:6|nameCheck:users:pass',
				]);

				$request->message([
					'name.required' => 'Tài khoản không được để trống',
					'name.min' => 'Tài khoản lớn hơn 5 ký tự',
					'name.taiKhoan' => 'Tài khoản không đúng',
					'name.max' => 'Tài khoản nhỏ hơn 40 ký tự',
					'pass.required' => 'Password không được để trống',
					'pass.min' => 'Password lớn hơn 6 ký tự',
					'pass.nameCheck' => 'Mật khẩu không đúng'
				]);

				if (!$request->validate()) {
					$data = json_encode($request->errors(), JSON_UNESCAPED_UNICODE);
					echo $data;
				} else {
					$data = $this->homeModel->getFrist($_POST['name']);
					$session = new Session();
					$session->deloySession('id');
					$session->setSession($data);
					$name = $session->getSession('id');
					// print_r($_SESSION);
					echo json_encode($name,JSON_UNESCAPED_UNICODE);
				}

			} else {
				echo "kytu";
			}
		} else {

		}

	}


	public function level()
	{
		$level = $this->homeModel->getFrist();
	}


	public function sorf () {
		if (isset($_POST['sort'])) {
			$sortType = $_POST['sort'];
			if ($sortType == 'asc') {
				usort($data, function($a, $b) {
					return $a['price'] - $b['price'];
				});
			} else if ($sortType == 'desc') {
				usort($data, function($a, $b) {
					return $b['price'] - $a['price'];
				});
			}
			echo json_encode($data);
			exit();
		}
	}

	public function logout() {
		// session_start();
		session_destroy(); // Hủy tất cả dữ liệu session
		// Trả về một response cho AJAX call
		echo json_encode(['status' => 'success', 'message' => 'Đăng xuất thành công']);
	}

	public function add_to_cart() {
		$data = $_POST;
		$data['user_id'] = $_SESSION['id']['id'];

		$cart = $this->homeModel->isCart('cart_items',$data['user_id'],$data['product_id']);
		// echo "<pre>---------------------------------------<pre>";
		if(!empty($cart)){
			// echo $cart[0]['quantity'];
			$data['quantity']+=$cart[0]['quantity'];
			// print_r($data);
			$this->homeModel->set_cart($data);
		}else{
			$this->homeModel->insertHome('cart_items',$data);
		}
		// print_r($data);
		
	}

	public function showCart(){
		$data = $this->homeModel->getTables('cart_items',
			'items',
			'user_id,product_id,cart_items.quantity,id,name_item,image,price,id_shop',
			'cart_items.user_id=items.id'
		);
		
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
	}

	public function getCart() {
		$data = $this->homeModel->getOne('cart_items',$_POST);
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
	}
}
?>