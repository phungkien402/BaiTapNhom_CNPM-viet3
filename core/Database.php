<?php
class Database{
	private $__conn;
	private $DB;

	public function __construct(){
		global $db_config;
		$this->__conn = Connection::getInstance($db_config);
	}

	//thêm dữ liệu
	public function insertData($table,$data){
		if(!empty($data)){
			$fieldStr = '';
			$valuesStr = '';
			//xử lý data thành các trường
			foreach($data as $key=>$value){
				$fieldStr .= $key.',';
				$valuesStr .= "'".$value."',";
			}
			$fieldStr = rtrim($fieldStr,',');
			$valuesStr = rtrim($valuesStr,',');
			$sql = "INSERT INTO $table($fieldStr)
					VALUES($valuesStr)";
			$status = $this->query($sql);
			if($status){
				return true;
			}
		}
		return false;
	}

	//update dữ liệu
	public function updateData($table,$data,$condition=''){
		// echo "\n\n";
		// print_r($data);
		// echo "\n\n";
		if(!empty($data)){
			$updateStr = '';
			// print_r($data);
			foreach($data as $key=>$value){
				$updateStr .= "$key='$value'".",";
			}
			$updateStr = rtrim($updateStr,',');

			if(empty($condition)){
				$sql = "UPDATE $table SET $updateStr";
			}else{
				$sql = "UPDATE $table SET $updateStr WHERE $condition";
			}

			echo $sql;
			$status = $this->query($sql);
			if($status){
				return true;
			}
		}
		return false;
	} 

	//xóa dữ liệu
	public function deleteData($table,$condition=''){
		if(!empty($condition)){
			$sql = "DELETE FROM $table WHERE $condition";
			
		}else{
			$sql = "DELETE FROM $table";
		}

		$status = $this->query($sql);

		if($status){
			return true;
		}

		return false;

	}

	public function query($sql){
		try{
            // echo "thành công";
            // echo "\n".$sql."\n";
            // var_dump($this->__conn);
            $statement = $this->__conn->prepare($sql);
            $statement->execute();
            // echo "<pre>";
            return $statement;
        }catch(Exception $exception){
        	echo $exception;
            $mess = $exception->getMessage();
            App::$app->loadError('400');
            return $mess;
            die();
        }
	}

	public function lastInsertID(){
		// echo $this->__conn->lastInsertID();
		return $this->__conn->lastInsertID();
	}


}

?>