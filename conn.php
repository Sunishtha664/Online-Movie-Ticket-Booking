<?php
class connec
{
    public $username="root";
    public $password="";
    public $server_name="localhost";
    public $db_name="movie_ticket_booking";

    public $conn;


    function __construct()
    {
        $this->conn=new mysqli($this->server_name,$this->username,$this->password,$this->db_name);
        if($this->conn->connect_error)
        {
            die("Connection Failed");
        }
    }

    function select_all($table_name)
    {      
        $sql = "SELECT * FROM $table_name";
        $result=$this->conn->query($sql);
       
        
        return $result;
    }

     function select_movie($table_name, $date)
    {      
        $sql = "SELECT * FROM $table_name where rel_date > $date";
        $result=$this->conn->query($sql);
       
        
        return $result;
    }

    function select_by_query($query)
    {
        $result=$this->conn->query($query);
        return $result;
    }


    function select($table_name,$id)
    {      
        $sql = "SELECT * FROM $table_name where id=$id";
        $result=$this->conn->query($sql);
        return  $result;
    }


  
    function insert($query,$msg)
    { 
        if($this->conn->query($query)===TRUE)
        {
             echo '<script> alert("We Will Contact You Soon on Your Email");</script>' ;
        }
        else
        {
             echo '<script> alert("'.$this->conn->error.'");</script>' ;
          
        }
    }


    function update($query,$msg)
    { 
        if($this->conn->query($query)===TRUE)
        {
             echo '<script> alert("'.$msg.'");</script>' ;
        }
        else
        {
             echo '<script> alert("'.$this->conn->error.'");</script>' ;
        }
    }

    function delete($table_name,$id)
    { 

        $query="Delete from $table_name WHERE id =$id";
        if($this->conn->query($query)===TRUE)
        {
             echo '<script> alert("Record Deleted");</script>' ;
        }
        else
        {
             echo '<script> alert("'.$this->conn->error.'");</script>' ;
        }
    }
}
?>
