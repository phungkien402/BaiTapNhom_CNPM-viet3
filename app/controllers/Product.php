<?php
class Product extends Controller{
	public $__product;
	public function __construct(){
		$this->__product = $this->model('ProductModel');
	}

	public function index(){
		// print_r($_SESSION);
	}

	//trả về cho js 1 chi tiết sản phẩm
	public function detail($id = ''){
		// print_r($_SESSION);
		$request = new Request();
		if($request->getMethod() == 'get'){
			$data = $this->__product->getItem($id);
			echo json_encode($data);
		}else{

		}
	}

	public function getAll(){
		$request = new Request();
		if($request->getMethod() == 'get'){
			$data = $this->__product->getFellAll();
			print_r($data);
		}
	}

	// nhập dữ liêu sản phẩm từ js
	public function postItem(){
		$request = new Request();
		if($request->getMethod() == 'post'){
			$request->rules([
				'name_item' => 'required',
				'image' => 'required|unique:items:image|image',
				'price' => 'required|value|positive'
			]);

			$request->message([
				'name_item.required' => 'Tên sản phẩm không được để trống',
				'image.required' => 'Tên sản phẩm không được để trống',
				'image.unique' => 'Tên ảnh đã có trên hệ thống, vui lòng nhập lại',
				'image.image' => 'Chỉ nhận các loại đuôi ảnh .jpg,.png,.jped',
				'price.required' => 'Giá sản phẩm không được để trống',
				'price.value' => 'Giá của sản phẩm phải là số nguyên',
				'price.positive' => 'Giá của sản phẩm phải lớn hơn 0 và nhỏ hơn 10 tỷ'
			]);

			if(!$request->validate()){
				print_r($request->errors());
			}else{
				if($request->kytu($_POST)){
					$data = [
					"name_item" => $_POST['name_item'],
					'image' => $_POST['image']['name'],
					'price' => $_POST['price']
					];

					$file_name = $_FILES['image']['tmp_name'];
					// $destination = _WEB_ROOT.'/public/'.$_FILES['image']['name'];
					// echo realpath(dirname(__FILE__));
					$destination = SITE_ROOT.'/public/items/images/'.$_FILES['image']['name'];
					move_uploaded_file($file_name, $destination);
					// print_r($_FILES['image']);
					// echo $destination;

					// $this->__product->insertItem($data);
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
