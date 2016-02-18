<?php
 
    // http://www.w3schools.com/php/func_mysqli_query.asp
    // DATABASE_URL => mysql://[username]:[password]@[host]/[database name]?reconnect=true */
    //  Local : mysql://root@localhost/products */
 
/**
 * A class file to connect to database
 */
class DB_CONNECT {
 
    var $con;
 
    // constructor
    function __construct() {
        // connecting to database
        $this->connect();
    }
 
    // destructor
    function __destruct() {
        // closing db connection
        $this->close();
    }
 
    /**
     * Function to connect with database
     */
    function connect() {
        
        // retrieve databse context : Local or On Cloud (heroku)

        $env = getenv('CLEARDB_DATABASE_URL');
        if ($env == "") {
            $server = "localhost";
            $username = "root";
            $password = "";
            $db = "laposte";
        } else {
            $url = parse_url($env);
            $server = $url["host"];
            $username = $url["user"];
            $password = $url["pass"];
            $db = substr($url["path"], 1);
        }

        $con = new mysqli($server, $username, $password, $db);
        
        if (mysqli_connect_errno()) {
         echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
        // returing connection cursor
            $this->con = $con;          
            return $con;
    }
 
    /**
     * Function to close db connection
     */
    function close() {
        // closing db connection
        
        return mysqli_close($this->con);
        
    }
 
}
 
?>