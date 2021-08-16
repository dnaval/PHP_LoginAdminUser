<?php
/* 
 * COMPANY: DNAVAL (2021)
 * Author: Daniel Naval
 * Description: DBController Class
 */
require_once 'C:\wamp64\config\zen-config.php';
class DBController {
	private $host = DAN_DB_HOST;
	private $user = DAN_DB_USER;
	private $password = DAN_DB_PASSWORD;
	private $database = DAN_DB_NAME;
	private $conn;
	private $connectionInfo;
        
	public function __construct() {
		$this->conn = $this->connectDB();
	}
	
	public function connectDB() {
        try
		{
				$this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->user, $this->password);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
				$this->connectionInfo = 'Connection Error: ' . $e->getMessage();
		}
		return $this->conn;
	}
	
	public function runQuery($query) {
		 //Prepare the query
         $stmt = $this->conn->prepare($query);

         //Execute the query
         $stmt->execute();
 
         //Get value from query
         while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
             $result_item[] = $row;
         }
         if(!empty($result_item)) {
             return $result_item;
         }
	}

    public function execQuery($query, $tab_arr) {
        //Prepare the query
        $stmt = $this->conn->prepare($query);

        //Execute the query
        $res = $stmt->execute($tab_arr);
        
        if($res) {
            $exec = 1;
        } else {
            $exec = 0;
        }
 
         return $exec;
    }

    public function execQueryOnly($query) {
        //Prepare the query
        $stmt = $this->conn->prepare($query);

        //Execute the query
        $res = $stmt->execute();
        
        if($res) {
            $exec = 1;
        } else {
            $exec = 0;
        }
 
         return $exec;
    }
        
	public function numRows($query) {
        //Prepare the query
        $stmt = $this->conn->prepare($query);

        //Execute the query
        $stmt->execute();

        //Get row count
        $nbr = $stmt->rowCount();

        return $nbr;
    }
        
  
}
