<?php
require_once('./Controlador/crl.config.php');

class User{
    static public function existsEmail(string $email) : int{
        $conn = Connection::conn();
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

    static public function getUsername(int $id) : string{
        $conn = Connection::conn();
        $query = "SELECT username FROM usuarios WHERE idUsuario = :id";
        $statement = $conn->prepare($query);
        $statement->bindValue(":id",$id);
        $statement->execute();
        $resultado = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $resultado["username"];
    }
    static public function getUserImagePath(int $id) : string{
        $conn = Connection::conn();
        $query = "SELECT imagenUsuario FROM usuarios WHERE idUsuario = :id";
        $statement = $conn->prepare($query);
        $statement->bindValue(":id",$id);
        $statement->execute();
        
        $resultado = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $resultado["imagenUsuario"];
    }
    static public function getUserRol(int $id) :int{
        $conn = Connection::conn();
        $query = "SELECT rol FROM usuarios WHERE idUsuario = :id";
        $statement = $conn->prepare($query);
        $statement->bindValue(":id",$id);
        $statement->execute();
        $resultado = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $resultado["rol"];
    }
    static public function getUserFirstName(int $id) : string{
        $conn = Connection::conn();
        $query = "SELECT nombre FROM usuarios WHERE idUsuario = :id";
        $statement = $conn->prepare($query);
        $statement->bindValue(":id",$id);
        $statement->execute();
        $resultado = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $resultado['nombre'];
    }
    static public function getUserEmail(int $id) : string{
        $conn = Connection::conn();
        $query = "SELECT correo FROM usuarios WHERE idUsuario = :id";
        $statement = $conn->prepare($query);
        $statement->bindValue(":id",$id);
        $statement->execute();
        $resultado = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $resultado["correo"];
    }
    static function encPass($password){
        $password = password_hash($password,PASSWORD_DEFAULT,['cost' => 10]);
        return $password;
    }
    static public function existsUser(string $username) : int{
        $conn = Connection::conn();
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
    static function verifyUserEmail(string $value) : int{
        $conn = Connection::conn();
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
    static function getUserPassword(string $value) : string{
        $conn = Connection::conn();
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
    static function getUserbyEmailUser(string $value) : array{
        $conn = Connection::conn();
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
