<?
class connec{
    public $username="root";
    public $password="";
    public $server_name="localhost";
    public $db_name="movie_ticket_booking";


    public $conn;
    function __construct()
    {
        $this->conn = new mysqli($username, $password, $server_name, $db_name);
        
    }
}
?>