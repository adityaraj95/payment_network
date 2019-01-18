<?php
	class general
	{ 
		private $db;
		//Connect to DB when the class construct
		public function __construct($database)
		{
	    		$this->db = $database;
		}
		public function select_query_count($tables,$where,$data_array)
		{
			$query_string="SELECT COUNT(*) FROM ".$tables." ".$where;
			$query = $this->db->prepare($query_string);
			foreach($data_array As $key=>$value)
			{
				$data_array[$key] = stripslashes($value);
			}			 
			try
			{	
				$query->execute($data_array);
				if($query->errorCode() == 0)
				{
					$num_rows = $query->fetchColumn();
					return $num_rows;
				}
			} 
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}
		public function select_query_random($fields,$tables,$where,$data_array)
		{
			$query_string="SELECT ".$fields." FROM ".$tables." ".$where." ORDER BY rand() LIMIT 0, 1";
			$query = $this->db->prepare($query_string);
			foreach($data_array As $key=>$value)
			{
				$data_array[$key] = stripslashes($value);
			}			 
			try
			{
 				$query->execute($data_array);
				if($query->errorCode() == 0)
				{
					$result = $query->fetch(PDO::FETCH_ASSOC);
					return $result;
				} 
				else
				{
					$errors = $prepare_sql->errorInfo();
					echo '<pre>';
					print_r($errors);
					echo '</pre>';
					die();
				}
			} 
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}
		public function select_query($fields,$tables,$where,$data_array,$mode)
		{
			$query_string="SELECT ".$fields." FROM ".$tables." ".$where." ";
			$query = $this->db->prepare($query_string);
			//echo $query_string;print_r($data_array);
			foreach($data_array As $key=>$value)
			{
				$data_array[$key] = stripslashes($value);
			}			 
			try
			{
 				$query->execute($data_array);
				if($query->errorCode() == 0)
				{
					if($mode == 1)
					{	
						/*
						fetch single record from database
						Fetch single dataset in default way
						mixed PDOStatement::fetch(
							int$mode=PDO_FETCH_BOTH,
							int$orientation=PDO_FETCH_ORI_NEXT,
							int$offset=0)

						PDO_FETCH_BOTH above send a array default(assoc/numeric)
						*/
						$result = $query->fetch(PDO::FETCH_OBJ);
					}
					else if($mode == 2)
					{
						/*
						fetch multiple record from database
						Fetch all rows at once in default way
						array PDOStatement::fetchAll(
							int$mode=PDO_FETCH_BOTH,
							string$class_name=NULL,
							array$ctor_args=NULL)

						PDO_FETCH_BOTH above send a array default(assoc/numeric)
						*/
						$result = $query->fetchAll(PDO::FETCH_OBJ);
					}
					return $result;
				} 
				else
				{
					$errors = $prepare_sql->errorInfo();
					echo '<pre>';
					print_r($errors);
					echo '</pre>';
					die();
				}
			} 
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}
		public function select_query_to_do_count($tables,$where,$data_array)
		{
			$query_string="SELECT COUNT(DISTINCT (image_answer)) FROM ".$tables." ".$where." ";
			$query = $this->db->prepare($query_string);
			//echo $query_string;print_r($data_array);
			foreach($data_array As $key=>$value)
			{
				$data_array[$key] = stripslashes($value);
			}			 
			try
			{	
				$query->execute($data_array);
				if($query->errorCode() == 0)
				{
					$num_rows = $query->fetchColumn();
					return $num_rows;
				}
			} 
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}
		public function insert_query($table, $fields, $values, $data_array)
		{
			$result = false;
			$query_string = "INSERT INTO ".$table." (".$fields.") VALUES (".$values.")";
			$query = $this->db->prepare($query_string);
			foreach($data_array As $key=>$value)
			{
				$data_array[$key] = stripslashes($value);
			}
			try
			{
 				$query->execute($data_array);
				if($query->errorCode() == 0)
				{
					$result = $this->db->lastInsertId();
					return $result;
				} 
				else
				{
					$errors = $prepare_sql->errorInfo();
					echo '<pre>';
					print_r($errors);
					echo '</pre>';
					die();
				}
			} 
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}
		public function update_query($table, $update_field_values, $where, $data_array)
		{
			$result = false;
			$query_string = "UPDATE ".$table." SET ".$update_field_values."  ".$where."";
			$query = $this->db->prepare($query_string);
			//echo $query_string;print_r($data_array);
			foreach($data_array As $key=>$value)
			{
				$data_array[$key] = stripslashes($value);
			}
			try
			{
 				$affected_rows=$query->execute($data_array);
				if($query->errorCode() == 0)
				{
					if($affected_rows===0)
					{
						$result=true;
					}
					else if($affected_rows>0)
					{
						$result=$affected_rows;
					}
					return $result;
				} 
				else
				{
					$errors = $prepare_sql->errorInfo();
					echo '<pre>';
					print_r($errors);
					echo '</pre>';
					die();
				}
			} 
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}
		public function delete_query($table, $where, $data_array)
		{
			$result = false;
			$query_string = "DELETE FROM ".$table."  ".$where."";
			$query = $this->db->prepare($query_string);
			foreach($data_array As $key=>$value)
			{
				$data_array[$key] = stripslashes($value);
			}
			try
			{
 				$affected_rows=$query->execute($data_array);
				if($query->errorCode() == 0)
				{
					if($affected_rows===0)
					{
						$result=true;
					}
					else if($affected_rows>0)
					{
						$result=$affected_rows;
					}
					return $result;
				} 
				else
				{
					$errors = $prepare_sql->errorInfo();
					echo '<pre>';
					print_r($errors);
					echo '</pre>';
					die();
				}
			} 
			catch (PDOException $e)
			{
				die($e->getMessage());
			}
		}

		
		public function empty_query($table)
		{
			$query_string = "TRUNCATE TABLE ".$table;
			$this->db->query($query_string);
		}

		public function specialhtmlremover($string)
		{
			return $string;
		}
		
		public function validation_check($checkingVariable, $destinationPath)
		{
			if($checkingVariable == '')
			{
				echo "<script language='javaScript' type='text/javascript'>
					window.location.href='".$destinationPath."';
				</script>";
			}
		}

		function capthha_generate_code($length=7)
		{
		   $phrase = "";
		   $chars = array ("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9");

		   $count = count ($chars) - 1;

		   srand ((double) microtime() * 1234567);

		   for ($i = 1; $i < $length; $i++)
			  $phrase .= $chars[rand (0, $count)];

		   return $phrase;
		}
	}
?>