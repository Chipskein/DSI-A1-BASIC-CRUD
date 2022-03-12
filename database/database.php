<?php
class Database{
    private $host="localhost";
    private $username="chipskein";
    private $password="123456";
    private $database="DS1_LIB";
    private $db_connection;
    function __construct()
    {
        $con=mysqli_connect($this->host,$this->username,$this->password,$this->database);
        if($con)
        {
            $this->db_connection=$con;
        }
    }
    public function get()
    {
        if($this->db_connection)
        {
            return $this->db_connection;
        }
    }
    public function close(){
        if($this->db_connection)
        {
            $this->db_connection->close();
            return true;
        }
        return false;
    }
}
?>
