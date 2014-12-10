<?php

require_once 'API.class.php';
class MyAPI extends API
{
	protected $User;
	protected $conn;
	
    public function __construct($request, $origin) {
        parent::__construct($request);
		
		
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "knights";

		try {
			$this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo "barf;";
		}

/*
        // Abstracted out for example
        $APIKey = new Models\APIKey();
        $User = new Models\User();

        if (!array_key_exists('apiKey', $this->request)) {
            throw new Exception('No API Key provided');
        } else if (!$APIKey->verifyKey($this->request['apiKey'], $origin)) {
            throw new Exception('Invalid API Key');
        } else if (array_key_exists('token', $this->request) &&
             !$User->get('token', $this->request['token'])) {

            throw new Exception('Invalid User Token');
        }

        $this->User = $User; */
    }

    /**
     * Example of an Endpoint
     */
     protected function users() {
        if ($this->method == 'GET') {
				$users = array();
          		$stmt = $this->conn->prepare("SELECT * FROM users"); 
				$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

   				foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) { 
						echo $users[] = $v;
					} 
			
          return $users;
          //     return "Your name is " . $this->User->name;
        } else {
            return "Only accepts GET requests";
        }
     }
 }

?>