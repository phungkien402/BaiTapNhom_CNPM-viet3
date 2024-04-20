<?php

	trait QueryBuilder{

		public $tableName = '';
		public $where = '';
		public $operator = '';
		public $selectField = '*';
		public $limit = '';
		public $orderBy = '';
		public $join = '';


		public function table($tableName){
			$this->tableName = $tableName;
			return $this;
		}

		public function where($field,$compare,$value){
			if(empty($this->where)){
				$this->operator = "WHERE";
				
			}else{
				$this->operator = " AND";
			}
			$this->where .="$this->operator $field $compare '$value'";
			return $this;
		}

		public function orWhere($field,$compare,$value){
			if(empty($this->where)){
				$this->operator = "WHERE";
				
			}else{
				$this->operator = " OR";
			}
			$this->where .="$this->operator $field $compare '$value'";
			return $this;
		}

		public function whereLike($field,$value){
			if(empty($this->where)){
				$this->operator = "WHERE";
				
			}else{
				$this->operator = " AND";
			}
			$this->where .="$this->operator $field"." LIKE"." '$value'";
			return $this;
		}

		public function select($field='*'){
			$this->selectField = $field;
			return $this;
		}

		//limit
		public function limit($number,$offset=0){
			$this->limit = " LIMIT $offset, $number";
			return $this;
		}

		public function oderBy($field,$type="ASC"){
			$fieldArr = array_filter(explode(',', $field));
			if(!empty($fieldArr) && count($fieldArr)>=2){
				$this->orderBy = "ORDER BY ".implode(',', $fieldArr);
			}else{
				$this->orderBy = " ORDER BY ".$field." ".$type;
			}
			return $this;
		}

		public function get(){
			$sqlQuery = "SELECT $this->selectField FROM $this->tableName $this->join $this->where $this->orderBy $this->limit";
			$sqlQuery = trim($sqlQuery);
			// echo $sqlQuery;
			$query = $this->db->query($sqlQuery);

			 $this->resetQuery();

	        if(!empty($query)){
	            return $query->fetchAll(PDO::FETCH_ASSOC);
	        }else{
	            return false;
	        }
		}

		//jion
		public function join($tableName,$relationship){
			$this->join .= "INNER JOIN ".$tableName.' ON '.$relationship.' ';
			return $this;
		}

		public function insert($data){
			$table = $this->tableName;
			$insertStatus = $this->db->insertData($table,$data);
			return $insertStatus;
		}

		public function update($data){
			$whereUpdate = str_replace("WHERE",'',$this->where);
			$whereUpdate = trim($whereUpdate);
			$tableName = $this->tableName;

			$tableName = $this->tableName;
			$statusUpdate = $this->db->UpdateData($tableName,$data,$whereUpdate);
			return $statusUpdate;
		}

		public function delete(){
			$whereDelete = str_replace("WHERE",'', $this->where);
			$whereDelete = trim($whereDelete);
			$tableName = $this->tableName;

			$statusDelete = $this->db->deleteData($tableName,$whereDelete);
			return $statusDelete;
		}

		public function lastID(){
			return $this->db->lastInsertId();
		}


		public function frist(){
			$sqlQuery = "SELECT $this->selectField FROM $this->tableName $this->join $this->where $this->orderBy $this->limit";
			// echo $sqlQuery;
			$query = $this->db->query($sqlQuery);

			//reset query
			$this->resetQuery();

	        if(!empty($query)){
	            return $query->fetch(PDO::FETCH_ASSOC);
	        }else{
	            return false;
	        }
		}

		public function resetQuery(){
			 $this->tableName = '';
			 $this->where = '';
			 $this->operator = '';
			 $this->selectField = '*';
			 $this->limit = '';
			 $this->orderBy = '';
			 $this->join = '';
		}
	}

?>