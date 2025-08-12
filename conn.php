<?
class connec{
    public $username="root";
    public $password="";
    public $server_name="localhost";
    public $db_name="movie_ticket_booking";


    public $conn;
    function __construct()
    {
        $this->conn = new mysqli($this->server_name, $this->username, $this->password, $this->db_name);
        if($this->conn->connect_error){
            die("Connection failed");
        }
        
    }

    function select_data(){
        
    }
}
?>