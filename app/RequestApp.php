<?php
	class RequestApp{

		public $url="";

		public $__controller,$__action,$__param=[];

		public function __construct($url){
			// print_r($_GET);
			$this->url = $url;
			$this->__controller = 'HomeRequest';
			$this->__action = 'index';
			$this->__param = [];

			$this->handleUrl();

		}

		public function getUrl(){
				$url = $this->url;
				$url = trim($url,'/');
				return $url;
			}

		public function handleUrl(){
			$url = $this->getUrl();
			$urlArray = explode('/', $url);
			

			//chuyển trang
			if(!empty($urlArray[0])){
				$this->__controller = ucfirst($urlArray[0]);
				unset($urlArray[0]);
			}

			//xử lý controller
			if(file_exists('app/request/'.$this->__controller.'.php')){
				require_once 'app/request/'.$this->__controller.'.php';
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