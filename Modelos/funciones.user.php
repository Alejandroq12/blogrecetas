<?php 
require_once ('db/config.php');

$conn = Connection::conn();
#clase que modifica usuarios
class User
{
    #propiedades necesarias
    public string $name;
    public string $token;
    public string $username;
    public string $lastName;
    public string $password;
    public string $email;
    public string $image;
    public object $db;

    public function __construct($token,$name,$lastName,$username,$password,$email,$image)
    {
        global $conn;
        $this->token = $token;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->image = $image;
        $this->db = $conn;
    }

    #funcion que crea usuarios
    public function makeUser(){

        $query = "INSERT INTO usuarios (token, nombre, apellido, username, password, correo, imagenUsuario) 
                VALUES(:token, :name, :lastName, :username, :password, :email, :image)";
        
        $statement = $this->db->prepare($query);
        $statement->bindValue(":token", $this->token);
        $statement->bindValue(":name", $this->name);
        $statement->bindValue(":lastName", $this->lastName);
        $statement->bindValue(":username", $this->username);
        $statement->bindValue(":password", $this->password);
        $statement->bindValue(":email", $this->email);
        $statement->bindValue(":image", $this->image);
        $statement->execute();
        $statement->closeCursor();

    }

    #Funcion para actualizar usuarios
    #AUN EN PROCESO :v
    // static function updateUser($idUsuario)
    //         {
    //             $query = "UPDATE usuario SET nombre = :name, username = :username, 
    //                     password = :password, correo = :email, imagenUsuario = :image WHERE idUsuario = :idUsuario";
    //             $statement = $this->db->prepare($query);
    //             $statement->bindValue(":usuario",$this->usuario);
    //             $statement->bindValue(":username",$this->username);
    //             $statement->bindValue(":password",$this->password);
    //             $statement->bindValue(":email",$this->email);
    //             $statement->bindValue(":image",$this->image);
    //             $statement->bindValue(":idUsuario",$idUsuario);
                
    //             $statement->execute();
    //             $statement->closeCursor();
    //         }
            

    static public function getUsername($id){
        global $conn;
        $query = "SELECT username FROM usuarios WHERE idUsuario = :id";
        $statement = $conn->prepare($query);
        $statement->bindValue(":id",$id);
        $statement->execute();
        
        $resultado = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $resultado["username"];
    }

    static public function getUserImagePath($id){
        global $conn;
        $query = "SELECT imagenUsuario FROM usuarios WHERE idUsuario = :id";
        $statement = $conn->prepare($query);
        $statement->bindValue(":id",$id);
        $statement->execute();
        
        $resultado = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $resultado["imagenUsuario"];
    }

    static public function getUserRol($id){
        global $conn;
        $query = "SELECT rol FROM usuarios WHERE idUsuario = :id";
        $statement = $conn->prepare($query);
        $statement->bindValue(":id",$id);
        $statement->execute();
        $resultado = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $resultado["rol"];
    }

    static public function deleteUser($id)
        {
            global $conn;
            $query = "DELETE FROM usuarios WHERE idUsuario = :id";
            $statement = $conn->prepare($query);
            $statement->bindValue(":id",$id);
            $statement->execute();
            $statement->closeCursor();
        }

    static public function getUserFirstName($id)
        {
        global $conn;
        $query = "SELECT nombre FROM usuarios WHERE idUsuario = :id";
        $statement = $conn->prepare($query);
        $statement->bindValue(":id",$id);
        $statement->execute();
        $resultado = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $resultado['nombre'];
        }

    static public function GetUserEmail($id)
        {
        global $conn;
        $query = "SELECT correo FROM usuarios WHERE idUsuario = :id";
        $statement = $conn->prepare($query);
        $statement->bindValue(":id",$id);
        $statement->execute();
        $resultado = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $resultado["correo"];
        }

    //metodo para encriptar la contra con un costo de 10
    //el costo es la cantidad de veces que se palica el mismo algoritmo a la contra
    static function encPass($password){
        $password = password_hash($password,PASSWORD_DEFAULT,['cost' => 10]);
        return $password;
    }

    //metodo para verificar si ya hay un usuario que use el mismo nombre de usuario
    static public function existsUser($username){
        global $conn;
        $statement = $conn->prepare(
            "SELECT COUNT(username) from usuarios WHERE username = :username"
        );
        $statement->execute([
            ':username' => $username
        ]);
        $result = $statement->fetch(PDO::FETCH_COLUMN);
        $statement->closeCursor();
        $statement = null;
        return $result;
    }

    //metodo para verificar si ya hay un usuario que use el mismo correo
    static public function existsEmail($email){
        global $conn;
        $statement = $conn->prepare(
            "SELECT COUNT(correo) from usuarios WHERE correo = :email"
        );
        $statement->execute([
            ':email' => $email
        ]);
        $result = $statement->fetch(PDO::FETCH_COLUMN);
        $statement->closeCursor();
        $statement = null;
        return $result;
    }

    //metodo para verificar si hay un usuatio con el corre introducido
    static function verifyUserEmail($value){
        global $conn;
        $statement = $conn->prepare(
            "SELECT COUNT(*) FROM usuarios WHERE correo = :email OR username = :username;"
        );
        $statement->execute([
            ':email' => $value,
            ':username' => $value
        ]);
        $result = $statement->fetch(PDO::FETCH_COLUMN);
        $statement->closeCursor();
        $statement = null;
        return $result;
    }
    //metodo para obtener contra de usuario
    static function getUserPassword($value){
        global $conn;
        $statement = $conn->prepare(
            "SELECT password FROM usuarios WHERE correo = :email OR username = :username;"
        );
        $statement->execute([
            ':email' => $value,
            ':username' => $value
        ]);
        $result = $statement->fetch(PDO::FETCH_COLUMN);
        $statement->closeCursor();
        $statement = null;
        return $result;
    }
    //metodo para traernos toda la info del usuario
    static function getUserbyEmailUser($value){
        global $conn;
        $statement = $conn->prepare(
            "SELECT * FROM usuarios WHERE correo = :email OR username = :username;"
        );
        $statement->execute([
            ':email' => $value,
            ':username' => $value
        ]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        $statement = null;
        return $result;
    }
}