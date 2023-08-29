<?php

class dbconnect
{
    // Database connection properties
    protected $host = 'localhost';
    protected $user = 'root';
    protected $password = '';
    protected $database = "mogds";

    // Connection property
    public $con = null;

    // Call constructor
    public function __construct()
    {
        $this->con = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if (mysqli_connect_error()) {
            echo "fail" . mysqli_connect_error();
        }
    }

public function __destruct(){
    $this->closeConnection();
}



//for mysqli closing connection
protected function closeConnection(){
    if($this->con !=null){
        $this->con->close();
        $this->con = null;
    }
}

}


