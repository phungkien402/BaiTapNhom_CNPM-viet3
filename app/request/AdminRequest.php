<?php
	class AdminRequest extends Controller{
		public $admin;

		public function __construct(){
			$this->admin = $this->model('AdminModel');
		}

		public function loai(){
			$data = $this->admin->getLoai();
			echo json_encode($data);
		}

		public function user(){
			$data = $this->admin->getUser();
			echo json_encode($data);
		}

		public function item(){
			$data = $this->admin->getList("items");
			echo json_encode($data);
		}

// nhập dữ liêu sản phẩm từ js
	public function postItem(){
		$request = new Request();
		if($request->getMethod() == 'post'){
			$request->rules([
				'id' => 'required|unique:items:id',
				'name_item' => 'required',
				'image' => 'required|unique:items:image|image',
				'price' => 'required|value|positive',
				'quantity' => 'required|value|positive',
				'tom_tat' => 'required',
				'noi_dung' => 'required' 
			]);

			$request->message([
				'id.required' => 'Không được để trống',
				'id.unique' => 'Mã sản phẩm đã có trên hệ thống',
				'name_item.required' => 'Tên sản phẩm không được để trống',
				'image.required' => 'Tên sản phẩm không được để trống',
				'image.unique' => 'Tên ảnh đã có trên hệ thống, vui lòng nhập lại',
				'image.image' => 'Chỉ nhận các loại đuôi ảnh .jpg,.png,.jpeg',
				'price.required' => 'Giá sản phẩm không được để trống',
				'price.value' => 'Giá của sản phẩm phải là số nguyên',
				'price.positive' => 'Giá của sản phẩm phải lớn hơn 0 và nhỏ hơn 10 tỷ',
				'quantity.required' => 'Số lượng sản phẩm không được để trống',
				'quantity.value' => 'Số lượng của sản phẩm phải là số nguyên',
				'quantity.positive' => 'Số lượng của sản phẩm phải lớn hơn 0 và nhỏ hơn 10 tỷ',
				'tom_tat.required' => 'Tóm tắt không được để trống',
				'noi_dung.required' => 'Nội dung không được để trống'
			]);

			if(!$request->validate()){
				echo json_encode($request->errors(),JSON_UNESCAPED_UNICODE);
			}else{
				$dataPost=[];
				if(isset($_POST['image'])){
					unset($_POST['image']);
				}
				foreach ($_POST as $key => $value) {
					$dataPost[$key] = $_POST[$key];
				}
				if($request->kytu($_POST)){
					$dataPost['image'] = $_FILES['image']['name'];

					$file_name = $_FILES['image']['tmp_name'];
					$destination = SITE_ROOT.'/public/items/images/'.$_FILES['image']['name'];
					move_uploaded_file($file_name, $destination);
					$this->admin->insertList('Items',$dataPost);
					echo 'submit';
				}else{
					echo "các trường không được chứa ký tự ' ";
				}				
			}
		}else{
			$response = new Response();
			$response->redirect('home/index');
		}
	}


	public function deleteItem(){
		$request = new Request();
		if ($request->getMethod() == 'post') {
			$dataPost = $this->valueData($_POST);
			$data["id"] = $dataPost[0];
			$this->admin->deleteList('items',"id", $dataPost[0]);
			// echo $data;
			echo 'submit';
		}
	}

	public function updateItem(){
		$request = new Request();
		if ($request->getMethod() == 'post') {
			// $dataPost = $this->valueData($_POST);
			$data["id"] = $_POST[0];
			$data["name_item"] = $_POST[1];
			$data["price"] = trim(str_replace("VNĐ", "", $_POST[2]));
			$data["quantity"] = trim(str_replace("VND", "", $_POST[3]));
			$data["tom_tat"] = $_POST[4];
			$data["noi_dung"] = $_POST[5];
			$data["loai"] = $_POST[6];
			print_r($data);
			$this->admin->updateUser("items","id",$_POST[0],$data);
			// echo $data;
			echo 'submit';
		}
	}


	public function insertLoai(){
		$request = new Request();
		if ($request->getMethod() == 'post') {
			$request->rules([
				'id' => 'required|unique:loai:id',
				'ten' => 'required'
			]);

			$request->message([
				'id.required' => 'Không được để trống',
				'id.unique' => 'Mã sản phẩm đã có trên hệ thống',
				'ten.required' => 'Tên sản phẩm không được để trống'
			]);

			if (!$request->validate()) {
				echo json_encode($request->errors(), JSON_UNESCAPED_UNICODE);
			} else {
				if ($request->kytu($_POST)) {
					$dataPost = $this->valueData($_POST);
					$data["id"] = $dataPost[0];
					$data["ten"] = $dataPost[1];
					$this->admin->insertList('loai', $data);
					// echo $data;
					echo 'submit';
				} else {
					echo "các trường không được chứa ký tự ' ";
				}
			}
		} else {
			$response = new Response();
			$response->redirect('home/index');
		}
	}

	public function updateLoai(){
		$request = new Request();
		if ($request->getMethod() == 'post') {
			$dataPost = $this->valueData($_POST);
			$data["id"] = $dataPost[0];
			$data["ten"] = $dataPost[1];
			$this->admin->updateUser("loai","id",$dataPost[0],$data);
			// echo $data;
			echo 'submit';
		}
	}

	public function deleteLoai(){
		$request = new Request();
		if ($request->getMethod() == 'post') {
			$dataPost = $this->valueData($_POST);
			$data["id"] = $dataPost[0];
			$this->admin->deleteList('loai',"id", $dataPost[0]);
		}
	}
}

?>