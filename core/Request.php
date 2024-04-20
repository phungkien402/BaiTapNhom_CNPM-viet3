<?php

	class Request{

		private $__rules = [],$__mes=[];
		private $__errors = [];
		public $db;
		private $file;

		public function __construct(){
			$this->db = new Database();
			// var_dump($this->db);
		}

		public function getMethod(){
			// echo strtolower($_SERVER['REQUEST_METHOD']);
			return strtolower($_SERVER['REQUEST_METHOD']);
		}

		public function isPost(){
			if($this->getMethod()=='post'){
				return true;
			}
			return false;
		}

		public function isGet(){
			if($this->getMethod()=='get'){
				return true;
			}
			return false;
		}

		public function getFields(){
			$dataFields = [];

			if($this->isGet()){
				//lấy dữ liệu từ get
				// print_r($_GET);

				if(!empty($_GET)){
					foreach($_GET as $key=>$value){
						if(is_array($value)){
							$dataFields[$key] = filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS,FILTER_REQUIRE_ARRAY);
						}else{
							$dataFields[$key] = filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS);
						}
					}
					return $dataFields;
				}
			}

			if($this->isPost()){
				//lấy dữ liệu từ get
				// print_r($_POST);

				if(!empty($_POST)){
					foreach($_POST as $key=>$value){
						if(is_array($value)){
							// echo $value;
							$dataFields[$key] = $value;
						}else{
							$dataFields[$key] = $value;
						}
					}
					// print_r($dataFields);

					//xử lý file
					if(isset($_FILES) && !empty($_FILES)){
						foreach($_FILES as $key=>$values){
							$_POST[$key] = $values;
							$dataFields[$key] = $_POST[$key]['name'];
							// print_r($dataFields);
						}
					}
					return $dataFields;
				}
			}

		}

		//set rule
		public function rules($rules=[]){
			$this->__rules = $rules;
			// print_r($this->__rules);
			
		}

		//set messige
		public function message($message){
			$this->__mes = $message;
			// print_r($this->__mes);
		}

		//Run validate
		public function validate(){

			$this->__rules = array_filter($this->__rules);

			$checkValidate = true;

			if(!empty($this->__rules)){

				$dataFields = $this->getFields();

				// echo "<pre>";
				// print_r($this->__rules);
				// echo "<pre>";	

				foreach($this->__rules as $fieldName=>$ruleItem){
					$ruleItemArr = explode("|", $ruleItem);
					// echo "<pre>";
					// print_r($ruleItemArr);
					// echo "<pre>";

					foreach($ruleItemArr as $rules){
						$ruleName = null;
						$ruleValue = null;
						
						$ruleArr = explode(":",$rules);

						$ruleName = reset($ruleArr);

						if(count($ruleArr) > 1){
							$ruleValue = end($ruleArr);
						}
						// print_r($ruleArr);
						//xét không được để trống
						if($ruleName == 'required'){
							if(empty($dataFields[$fieldName])){
								$this->setErrors($fieldName,$ruleName);
								$checkValidate = false;
							}
						}

						//xét độ dài tối thiểu
						if($ruleName == 'min'){
							if(strlen(trim($dataFields[$fieldName])) < $ruleValue ){
								$this->setErrors($fieldName,$ruleName);
								$checkValidate = false;
							}
						}	

						if($ruleName == 'max'){
							if(strlen(trim($dataFields[$fieldName])) > $ruleValue ){
								$this->setErrors($fieldName,$ruleName);
								$checkValidate = false;
							}
						}

						if($ruleName == 'value'){
							$num = $dataFields[$fieldName];
							if(!preg_match('/^[0-9]+$/',$num)){
								$this->setErrors($fieldName,$ruleName);
								$checkValidate = false;
							}
						}

						if($ruleName == 'positive'){
							$num = $dataFields[$fieldName];
							if($num <= 0 || $num >= 9999999999){
								$this->setErrors($fieldName,$ruleName);
								$checkValidate = false;
							}
						}

						if($ruleName == 'email'){
							if(!filter_var($dataFields[$fieldName], FILTER_VALIDATE_EMAIL )){
								$this->setErrors($fieldName,$ruleName);
								$checkValidate = false;
							}
						}

						if($ruleName == 'match'){
							if(trim($dataFields[$fieldName]) != trim($dataFields[$ruleValue])){
								$this->setErrors($fieldName,$ruleName);
								$checkValidate = false;
							}
						}

						if($ruleName == "kytu"){
							if(preg_match("/$ruleValue{1,}/",$dataFields[$fieldName] )){
								$this->setErrors($fieldName,$ruleValue);
							}
						}


						//kiểm tra cli
						if($ruleName == 'CCCD'){
							if(!preg_match('/^([0-9]{6}-[0-9]{4}-[0-9]{2}-[0-9]{3}-[0-9X])$/',$dataFields[$fieldName])){
								$this->setErrors($fieldName,$ruleName);
								$checkValidate = false;
							}
						}

						if($ruleName == 'date'){
							if(!preg_match('/^([0-9]{1,2})-([0-9]{1,2})-([0-9]{4})$/',$dataFields[$fieldName])){
								$this->setErrors($fieldName,$ruleName);
								$checkValidate = false;
							}
						}

						if($ruleName == 'std'){
							if(!preg_match('/^(0|84|09|012|016|017|018|019|091|092|093|094|096|097|098|099)([0-9]{8})$/',$dataFields[$fieldName])){
								$this->setErrors($fieldName,$ruleName);
								$checkValidate = false;
							}
						}

						//checkout cơ sở dữ liệu
						if($ruleName == 'unique'){
							$tableName = null;
							$fieldCheck = null;
							if(!empty($ruleArr[1])){
								$tableName = $ruleArr[1];
							}
							if(!empty($ruleArr[2])){
								$fieldCheck = $ruleArr[2];
							}

							if(!empty($tableName) && !empty($fieldCheck)){
								$checkExit = $this->db->query("SELECT $fieldCheck FROM $tableName where $fieldCheck = '$dataFields[$fieldName]'")->rowCount();
								if(!empty($checkExit)){
									$this->setErrors($fieldName,$ruleName);
									$checkValidate = false;
								}
							}
						}

						//xử lý tài khoản
						if($ruleName == 'taiKhoan'){
							$tableName = null;
							$fieldCheck = null;

							if(!empty($ruleArr[1])){
								$tableName = $ruleArr[1];
							}

							if(!empty($ruleArr[2])){
								$fieldCheck = $ruleArr[2];
								$fieldCheckArr = explode('?',$fieldCheck);
								// print_r($fieldCheckArr);

								foreach($fieldCheckArr as $field){
									$checkValidate = false;
									if(isset($field)){
										$checkExit = $this->db->query("SELECT $field FROM $tableName where $field = '$dataFields[$fieldName]'")->rowCount();

										if(!empty($checkExit)){
											$checkValidate = true;
											break;
										}	
									}
								}
								if(!$checkValidate){
									$this->setErrors($fieldName,$ruleName);
								}
							}

						}

						//check accout
						// echo "<pre>$ruleName<pre>";
						if($ruleName == 'nameCheck'){
							// echo "<pre>";
							// print_r($ruleArr);
							$tableName = null;
							$fieldCheck = null;
							if(!empty($ruleArr[1])){
								$tableName = $ruleArr[1];
							}
							if(!empty($dataFields[$fieldName])){
								$fieldCheck = $ruleArr[2];
							}

							if(!empty($tableName) && !empty($fieldCheck)){
								$checkExit = $this->db->query("SELECT $fieldCheck FROM $tableName where $fieldCheck = '$dataFields[$fieldName]'")->rowCount();
								if(empty($checkExit)){
									$this->setErrors($fieldName,$ruleName);
									$checkValidate = false;
								}
							}

						}

						// print_r($ruleArr);
						if($ruleName == 'image'){
							// echo $ruleName."<pre>";
							// echo $dataFields[$fieldName];
							// print_r($ruleArr);
							if(!empty($_POST['image'])){
								if(!preg_match('/(.jpg|.png|.img|.jpeg)$/',$dataFields[$fieldName])){
									$this->setErrors($fieldName,$ruleName);
									$checkValidate = false;
								}
							}
						}				

					}
				}			
			}
			return $checkValidate;
		}

		//xử lý ký tự '
		public function kytu($fieldArr=[]){
			$check = true;
			if(!empty($fieldArr)){
				// print_r($fieldArr);
				foreach($fieldArr as $value){
					if(!preg_match("/[0-9a-zA-Z_.@?]+/",$value) && $value!=""){
						$check = false;
					}else{
						$check = true;
					}
				}
			}
			return $check;
		}

		//xử lý tài khoản
		public function taiKhoan($name,$email){
			$check = false;
			if(!empty($name) || !empty($email)){
				$checkExit = this->db->query("SELECT name,email FROM users where name = '$name' or email = '$email' ")->rowCount();
				if(!empty($checkExit)){
					$check = true;
				}
			}
			return $check;
		}

		//get errors
		public function errors($fieldName = ''){
			if(!empty($this->__errors)){
				if(empty($fieldName)){
					$errorArr = [];
					foreach($this->__errors as $key=>$values){
						$errorArr[$key] = reset($values);
					}
					return $errorArr;
				}
				return reset($this->__errors[$fieldName]);
			}
			return false;
		}

		public function setErrors($fieldName,$ruleName){
			$this->__errors[$fieldName][$ruleName] = $this->__mes[$fieldName.'.'.$ruleName];
			// echo $fieldName;
		}
	}

?>