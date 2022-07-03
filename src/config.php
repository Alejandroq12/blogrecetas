<?php
class ConnectionTest{

    static public function conn() {
        $servername = "localhost";
        $username = "root";
        $password = "1234";
        try {
            $conn = new PDO("mysql:host=$servername;port=3306;dbname=blogreceta", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Connected successfully";
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $conn;

    }

}

?>