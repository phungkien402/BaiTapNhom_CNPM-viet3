<?php
	class Home extends Controller{

		public $data = [];

		public $model_home;

		public function __construct(){
			// echo _WEB_ROOT;
			$this->model_home = $this->model("HomeModel");
		}

		public function index($a="",$b=""){

			// unset($_SESSION);
			// print_r($_SESSION);
			// $this->render('layout/client_layout.php');
			$this->render('layout/client_layout.php');
			// $this->render('pages/cart.php');
			

		}

		public function detail($key=""){
			$this->render('layout/item_layout.php');
		}

		// trả ra nhưng 
		public function list_home(){
			$dataHome = $this->model_home->getList();
			$this->data['dataHome'] = $dataHome;
			echo json_encode($dataHome);

			$title = "tiêu đề";
			$this->data['title'] = $title;

		}

		public function location($id=""){
			$response = new Response();
			if(!empty($id)){
				$response->redirect($id);
			}else{
				$response->redirect('home/index');
			}	
		}


		//lấy dữ liệu từ user
		public function dangKy(){
			$this->render('pages/dangky.php');
			$request = new Request();
			// echo $request->getMethod();
			if($request->getMethod() == 'post'){
			//Set rule
				$request->rules([
					'name' => "required|min:5|max:40|kytu:'|unique:users:name",
					'email' => "email|min:6|kytu:'|unique:users:email",
					'pass' => "required|min:6|kytu:'",
					'confirm_password' => "required|match:pass|kytu:'",
				]);

				$request->message([
					'name.required' => 'Tài khoản không được để trống',
					'name.min' => 'Tài khoản lớn hơn 5 ký tự',
					'name.max' => 'Tài khoản nhỏ hơn 40 ký tự',
					'name.kytu' => 'Tài khoản không được chứa ký tự đặc biệt',
					'name.unique' => 'Tài khoản đã tồn tại',
					'email.email' => 'Phải là email',
					'email.min' => 'Email phải lơn hơn 6 ký tự',
					'email.kytu' => 'Email chỉ được chứa ký tự đặc biệt là @ và .',
					'email.unique' => 'Email đã tồn tại',
					'pass.required' => 'Password không được để trống',
					'pass.min' => 'Password lớn hơn 6 ký tự',
					"pass.kytu' => 'password không được chứa dấu '",
					'confirm_password.required' => 'Nhâp lại mật khẩu nhông được để trống',
					'confirm_password.match' => 'Mật khẩu nhập lại không trùng',
					"confirm_password.kytu" => "Mật khẩu nhập lại không được chưa dấu '"
				]);

				$validate = $request->validate();
				// echo "<pre>";
				// echo $validate;
				if(!$validate){
					$request->errors();
				}else{
					if(!$request->kytu(
						[$_POST['name'],
						$_POST['pass'],
						$_POST['email']
					])){
						echo "không được chứa ký tự '";
					}else{

						$data = [
							'name' => $_POST['name'],
							'pass' => md5($_POST['pass']),
							'email' => $_POST['email'],
							'level' => '3',
						];
						$this->model_home->insertUser($data);
						$this->render('home/index');
					}
				}
			}else{
				$response = new Response();
				$response->redirect('home/dangKy');
			}
		}

		public function dangNhap(){
			$this->render('pages/dangnhap.php');
			// $this->render('layout/testjs.php');
			$request = new Request();

			if($request->getMethod() == 'post'){
				if(!$request->kytu()){
					$_POST['pass'] = md5($_POST['pass']);
					$request->rules([
						'name' => 'required|min:5|max:40|taiKhoan:users:name?email',
						'pass' => 'required|min:6|nameCheck:users:pass',
					]);

					$request->message([
						'name.required' => 'Tài khoản không được để trống',
						'name.min' => 'Tài khoản lớn hơn 5 ký tự',
						'name.nameCheck' => 'Tài khoản không đúng',
						'name.max' => 'Tài khoản nhỏ hơn 40 ký tự',
						'name.taiKhoan' => 'Tài khoản không đúng',
						'pass.required' => 'Password không được để trống',
						'pass.min' => 'Password lớn hơn 6 ký tự',
						'pass.nameCheck' =>'Mật khẩu không đúng'
					]);

					if(!$request->validate()){
						print_r($request->errors());
					}else{
						$response = new Response();
						$response->redirect('home/index');
					}

				}else{
					echo "<pre>Các trường không được chứa ký tự '";
				}
			}else{

			}

		}


		public function cart($url=""){
			// echo $url;
			$this->render('pages/cart.php');
		}

		public function requestHome(){
			$url = $_GET['url'];
			if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
				if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
					require_once 'app/RequestApp.php';
					$requestApp = new RequestApp($url);
				}
			}
		}

	}

?>