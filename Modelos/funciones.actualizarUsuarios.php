<?php
require_once ('db/config.php');

$conn = Connection::conn();
class UserUpt
    {

#Declaracion de variables dentro de la clase tambien llamado atributos de clase

        public string $name;
        public string $username;
        public string $password;
        public string $email;
        public string $userImage;
        public ?int $userId;
        public object $db;

#Declaracion del metodo constructor para pasar argumentos

        public function __construct($name,$username,$password,$email,$userImage,$userId)
            {
                global $conn;
                $this->name = $name;
                $this->username = $username;
                $this->password = $password;
                $this->email = $email;
                $this->userImage = $userImage;
                $this->userId = $userId;
                $this->db = $conn;
            }

#Este bloque actualiza una receta buscada por ID dentro de la base de datos

        public function updateUser($userId)
            {
                $query = "UPDATE usuario SET nombre = :name, username = :username, 
                        password = :password, correo = :email, imagenUsuario = :userImage WHERE idUsuario = :userId";
                $statement = $this->db->prepare($query);
                $statement->bindValue(":usuario",$this->usuario);
                $statement->bindValue(":username",$this->username);
                $statement->bindValue(":password",$this->password);
                $statement->bindValue(":email",$this->email);
                $statement->bindValue(":userImage",$this->userImage);
                $statement->bindValue(":userId",$userId);
                
                $statement->execute();
                $statement->closeCursor();
            }

        public static function getImagePath($userId)
            {
                global $conn;
                $query = "SELECT imagenPost FROM usuario WHERE idUsuario = :userId";
                $statement = $conn->prepare($query);
                $statement->bindValue(":userId",$userId);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                $statement->closeCursor();
                return $result["imagenPost"];
            }
    }

function deleteUserImage($userId)
    {
        $userImage = UserUpt::getImagePath($userId);
        unlink($userImage);
        $userImage = explode("/",$userImage);
        array_pop($userImage);
        $userImage = implode("/",$userImage);
        rmdir($userImage);
    }