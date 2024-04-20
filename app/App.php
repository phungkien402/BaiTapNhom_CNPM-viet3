<?php
	class App{

		public $__controller,$__action,$__param=[],$__router;

		public static $app;

		public function __construct(){
			global $router;
			$this->__router = new Routes();

			//tạo ra biến app gọi bên Database
			self::$app = $this;

			if(!empty($router)){
				$this->__controller = $router['trang chu'];
			}
			$this->__action = 'index';
			$this->__param = [];

			$this->handleUrl();

		}

		public function getUrl(){
			if(!empty($_SERVER['PATH_INFO'])){
				$url = $_SERVER['PATH_INFO'];
				// echo $url;
				$url = trim($url,'/');
				return $url;
			}else{
				return '/';
			}
		}

		public function handleUrl(){
			$url = $this->getUrl();
			$url = $this->__router->handleRouter($url);
			// echo $url;
			$urlArray = explode('/', $url);
			

			//chuyển trang
			if(!empty($urlArray[0])){
				$this->__controller = ucfirst($urlArray[0]);
				unset($urlArray[0]);
			}

			//xử lý controller
			if(file_exists('app/controllers/'.$this->__controller.'.php')){
				require_once 'app/controllers/'.$this->__controller.'.php';
				if(class_exists($this->__controller)){
					$this->__controller = new $this->__controller;
				}
			}else{
				
				$this->loadError('404');
			}

			//xử lý action
			if(!empty($urlArray[1])){
				$this->__action = $urlArray[1];
				unset($urlArray[1]);
			}

			if(!method_exists($this->__controller, $this->__action)){
				echo '<pre>Lỗi';
				$this->loadError('404');
			}

			//xử lý param
			$this->__param = array_values($urlArray);
			try{
				call_user_func_array([$this->__controller,$this->__action],$this->__param);

			}catch(ArgumentCountError $e){
				$this->loadError('404');
			}

		}


		//xử lý lỗi
		public function loadError($error){
			require_once 'app/errors/'.$error.'.php';
			die();

		}
	}

?>