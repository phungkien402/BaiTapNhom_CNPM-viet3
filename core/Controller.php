<?php 
	class Controller{

		public function model($model){
			// echo 'app/model/'.$model.'.php';
			if(file_exists('app/model/'.$model.'.php')){
				require_once 'app/model/'.$model.'.php';
				if(class_exists($model)){
					$model = new $model();
					return $model;
				}
			}
			return false;
		}

		//taoj render chuyển hướng view
		public function render($views,$data=[]){
			extract($data);
			if(file_exists('app/views/'.$views)){
				require_once 'app/views/'.$views;
			}else{
				App::$app->loadError('404');
				die();
			}
		}

		//cap nhap du lieu
		public function valueData($array){
			$mangSo = array_values($array);
			return $mangSo;
		}
	}
 ?>