<?php
	abstract class Model extends Database{
		protected $db;

		use QueryBuilder;

		public function __construct(){
			// echo "khoi tao model<pre>";
			$this->db = new Database();
		}

		abstract public function tableFill();
    	abstract public function fieldFill();
    	abstract public function primaryKey();

    	protected function getFethAll(){
    		$table = $this->tableFill();
    		$fieldSelect = $this->fieldFill();

    		if(empty($fieldSelect)){
    			$fieldSelect = '*';
    		}

    		$sql = "SELECT $fieldSelect FROM $table";
    		$query = $this->db->query($sql);
    		if(!empty($query)){
    			return $query->fetchAll(PDO::FETCH_ASSOC);
    		}else{
    			return false;
    		}
    	}

    	protected function getfirst($find){
    		$table = $this->tableFill();
    		$fieldSelect = $this->fieldFill();
    		$primaryKey = $this->primaryKey();

    		if(empty($fieldSelect)){
    			$fieldSelect = '*';
    		}

    		$sql = "SELECT $fieldSelect FROM $table WHERE $primaryKey = $find";
    		$query = $this->db->query($sql);
    		if(!empty($query)){
    			return $query->fetch(PDO::FETCH_ASSOC);
    		}else{
    			return false;
    		}
    	}
	}
?>