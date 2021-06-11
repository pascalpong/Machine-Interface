<?php

@session_start();
class Connect {
	public $db;
	private $con;
	private $host = "127.0.0.1";
	private $user = "root";
	private $password = "";
	private $dbName = "pmii_interface_project_i";
	public $mssql = false;
	public function connect() {
		if ($this->mssql) {
			$servername = 'ISSERVER2014\SERVER2012';
			$databasename = 'pmii_2018_sv';
			$user = 'pmii';
			$pass = '123456';
			$connection = "DRIVER={SQL Server};SERVER=$servername;DATABASE=$databasename;AutoTranslate=no";
			$this->con = odbc_connect($connection, $user, $pass);
		} else {
			$this->con = mysqli_connect($this->host, $this->user, $this->password, $this->dbName);
			if (!$this->con) {
				die('Could not connect: ' . mysqli_error());
			}
		}
                
                
                
                
	}
	public function close() {
		if ($this->mssql) {
			odbc_close($this->con);
		} else {
			mysqli_close($this->con);
		}
	}

	public function query($sql) {
		require_once 'JWT.php';
		$token = JWT::decode($_SESSION["token"], 'Is@7433'.date("Y-m-d"));
		$http_referer = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
		$servername = $_SERVER["SERVER_NAME"];
		
			if ($this->mssql) {
				$rs = @odbc_exec($this->con, $sql);
			} else {
				mysqli_query($this->con, "SET character_set_results=utf8");
				mysqli_query($this->con, "SET character_set_client='utf8'");
				mysqli_query($this->con, "SET character_set_connection='utf8'");
				mysqli_query($this->con, "collation_connection = utf8_unicode_ci");
				mysqli_query($this->con, "collation_database = utf8_unicode_ci");
				mysqli_query($this->con, "collation_server = utf8_unicode_ci");
//            $sql = (iconv('utf-8', 'TIS620', $sql));
				$rs = mysqli_query($this->con, $sql);
				if ($rs == true) {
					$date = new DateTime();
					$ts = date_format($date, 'Y-m-d H:i:s');
					$sql2 = strtoupper($sql);
					$sql3 = str_replace("'", ' ', str_replace('"', ' ', $sql));
					$user = $_SESSION['username'] != NULL ? $_SESSION['username'] : "";
					if (strpos($sql2, "INSERT") !== false) {
						$sql4 = "INSERT INTO log_details(details,type,ts,user) VALUES('$sql3','insert','$ts','$user')";
						$rs4 = mysqli_query($this->con, $sql4);
					} elseif (strpos($sql2, "UPDATE") !== false) {
						$sql4 = "INSERT INTO log_details(details,type,ts,user) VALUES('$sql3','update','$ts','$user')";
						$rs4 = mysqli_query($this->con, $sql4);
					} elseif (strpos($sql2, "DELETE") !== false) {
						$sql4 = "INSERT INTO log_details(details,type,ts,user) VALUES('$sql3','delete','$ts','$user')";
						$rs4 = mysqli_query($this->con, $sql4);
					}
				} else {
					$sql4 = "INSERT INTO log_details(details,type,ts,user) VALUES('$sql','error','$ts','$user')";
					$rs4 = mysqli_query($this->con, $sql4);
				}
			}
			return $rs;

	}



	public function query_prepare($sql,$type="",$array1){
		require_once 'JWT.php';
		$token = JWT::decode($_SESSION["token"], 'Is@7433'.date("Y-m-d"));
		$http_referer = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
		$servername = $_SERVER["SERVER_NAME"];
		// && $http_referer == $servername
		if($token == $_SESSION["username"] && $_SESSION["username"] != ""){
			$con = new mysqli($this->host, $this->user, $this->password, $this->dbName);
			$con->query( "SET character_set_results=utf8");
			$con->query( "SET character_set_results=utf8");
			$con->query( "SET character_set_client='utf8'");
			$con->query( "SET character_set_connection='utf8'");
			$con->query("collation_connection = utf8_unicode_ci");
			$con->query( "collation_database = utf8_unicode_ci");
			$con->query( "collation_server = utf8_unicode_ci");
        // $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
			$stmt = $con->prepare($sql);
			if($type == ""){
			}else{
				$array1 = self::detectArray($array1);
				$stmt->bind_param($type, ...$array1);
			}
			$stmt->execute();
        //echo $stmt->error;
			$result = $stmt->get_result();
		// echo (String)$stmt;
			if($stmt == true){
				$date = new DateTime();
				$ts = date_format($date, 'Y-m-d H:i:s');
				$sql2 = strtoupper($sql);
				$sql3 = str_replace("'", ' ', str_replace('"', ' ', $sql));
				$user = $_SESSION['username'] != NULL ? $_SESSION['username'] : "";
				if (strpos($sql2, "INSERT") !== false) {
					$sql4 = "INSERT INTO log_details(details,type,ts,user) VALUES('$sql3','insert','$ts','$user')";
					$rs4 = $con->query( $sql4);
					return true;
				} elseif (strpos($sql2, "UPDATE") !== false) {
					$sql4 = "INSERT INTO log_details(details,type,ts,user) VALUES('$sql3','update','$ts','$user')";
					$rs4 = $con->query( $sql4);
					return true;
				} elseif (strpos($sql2, "DELETE") !== false) {
					return true;
					$sql4 = "INSERT INTO log_details(details,type,ts,user) VALUES('$sql3','delete','$ts','$user')";
					$rs4 = $con->query($sql4);
					return true;
				}
			}
			$stmt->close();
			return $result; 
		}else{
			$protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' : 'http://';
			$fullPath = explode("/", dirname($_SERVER["PHP_SELF"]));
			$programPath = $protocol . $_SERVER["SERVER_NAME"] . "/$fullPath[1]/";
			header( "location: ".$programPath."login.php" );
		}
	}

	public function detectArray($array1) {
		$newarr = array();
		foreach ($array1 as $value) {
			$value =  self::detectParam($value);
			array_push($newarr, $value);
		}
		return $newarr;
	}


	public function parseArray($rs) {
		if ($this->mssql) {
			return odbc_fetch_array($rs);
		} else {
			return mysqli_fetch_array($rs);
		}
	}

	public function getNumRowdata($rs) {
		if ($this->mssql) {
			$n = 0;
			while ($row = odbc_fetch_array($rs)) {
				$n++;
			}
			return $n;
		} else {
			return mysqli_num_rows($rs);
		}
	}

	public  function detectParam($param){


		$param = strip_tags($param);
		$param = htmlspecialchars($param);
		$param = htmlentities($param);
		$param = addslashes($param);
		
		$param =  self::detectQuery($param);
		return $param;
	}

	public function detectQuery($param)
	{




		$operators = array(
			'select * ',
			'select ',
			'union all ',
			'union ',
			' all ',
			' where ',
			' and 1 ',
			' and ',
			' or ',
			' 1=1 ',
			' 2=2 ',
			'script',
		);

		$v = urldecode(strtolower($param));

		foreach($operators as $operator)
		{
			if (preg_match("/".$operator."/i", $v)) {
                                //echo  "operator: '".$operator."', val: '".$v."'";
				return "";
			}




		}

	       //$param =  str_replace('\'', "\'",$param);

               // $param =  str_replace('"', "\"",$param);
               //$param =  str_replace('\"', '',$param);


		return $param;
	}



}

?>
