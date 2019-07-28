<?

class MysqlClass{

	var $mysqli;
	var $result;
	var $row;
	
	public function MysqlClass() {
        $this->DBconnect();
    }	

	function __construct($sql){
		$this->DBconnect();
		$this->result =  $this->mysqli->query($sql);
	}
	

	function DBconnect(){
		echo " 11;";
		$db=array(
		    "host"=>"localhost",  
		    "user"=>"root", 
		    "pass"=>"root", 
		    "dbname"=>"homework2", 
			"charset"=>"utf8" 
		);

		$mysqli =  new mysqli($db['host'],$db['user'],$db['pass'],$db['dbname']);

		if ($mysqli->connect_errno) {
		    echo $mysqli->connect_error;
		    exit;
		}

		$mysqli->set_charset($db['charset]']);
		$mysqli->query("SET NAMES UTF8");
	}

	function DBquery($sql){
		$this->result =  $this->mysqli->query($sql);
		return $this->result;	

	}
	function DBfields(){
		return $this->result->fetch_field();
	}
	function countFields(){
		return $this->result->field_count;
	}
	function countRows(){
		return $this->result->num_rows;
	}
	function DBresult(){
		return $this->result;
	}
	function DBquery1sql($sql){
		$this->result =  $this->mysqli->query($sql);
		$this->row = $this->result->fetch_array();

		return $this->row;	
		
	}
	function fetchArray(){
		$this->row = $this->result->fetch_array();
		return $this->row;
		
	}
	function fetchAssoc(){
		$this->row = $this->result->fetch_assoc();
		return $this->row;
		
	}

	function DBclose(){
		$this->mysqli->close();
	}

	function DBinsert($sql){
		$this->result = $this->mysqli->query($sql);

		return $this->result;

	}

	function DBupdate($sql){
		$this->result = $this->mysqli->query($sql);

		return $this->result;
	}




}





?>
