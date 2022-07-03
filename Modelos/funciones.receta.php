<?php
require_once ('db/config.php');

# rec es igual a decir receta

$conn = Connection::conn();
class Rec
    {
#Declaracion de variables dentro de la clase tambien llamado atributos de clase

        public string $recTitle;
        public string $recDescription;
        public string $recSteps;
        public string $recImage;
        public ?string $recDate;
        public ?int $id;
        public object $db;

#Declaracion del metodo constructor para pasar argumentos

        public function __construct($recTitle,$recDescription,$recSteps,$recImage,$recDate,$id)
            {
                global $conn;
                $this->recTitle = $recTitle;
                $this->recDescription = $recDescription;
                $this->recSteps = $recSteps;
                $this->recImage = $recImage;
                $this->recDate = $recDate;
                $this->id = $id;
                $this->db = $conn;
            }

# Este bloque crea una receta dentro de la base de datos

        public function createRec()
            {
                $query = "INSERT INTO receta (tituloPost, descripcionPost, imagenPost, pasosPost, fecha, id_usuario) 
                            VALUES (:recTitle, :recDescription, :recImage,:recSteps , :recDate, :id_usuario)";

                $statement = $this->db->prepare($query);
                $statement->bindValue(":recTitle", $this->recTitle);
                $statement->bindValue(":recDescription", $this->recDescription);
                $statement->bindValue(":recImage", $this->recImage);
                $statement->bindValue(":recSteps", $this->recSteps);
                $statement->bindValue(":recDate", $this->recDate);
                $statement->bindValue(":id_usuario", $this->id);

                $statement->execute();
                $statement->closeCursor();
                
            }

#Este bloque busca una receta por ID

        static public function getRec($id)
            {
                global $conn;
                $query = "SELECT * FROM receta WHERE idReceta = :id";
                $statement = $conn->prepare($query);
                $statement->bindValue(":id", $id);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                $statement->closeCursor();
                
                return $result;
            }

#Este bloque obtiene todas las recetas de la base de datos

        static public function getAllRec()
            {
                global $conn;
                $query = "SELECT * FROM receta ORDER BY idReceta DESC";
                $statement = $conn->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                $statement->closeCursor();
                
                return $result;
            }

#Obtiene las recetas que cumplan un cierto string

        static public function getRecByTitle($title){
            global $conn;
            $query = "SELECT * FROM receta WHERE tituloPost LIKE :recTitle ORDER BY idReceta DESC";
            $statement = $conn->prepare($query);
            $statement->bindValue(":recTitle","%$title%");
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement->closeCursor();

            return $result;
        }

#Obtiene las rectas por usuario

        static public function getRecByUserId($id){
            global $conn;
            $query = "SELECT * FROM receta WHERE id_usuario = :id_usuario ORDER BY idReceta DESC";
            $statement = $conn->prepare($query);
            $statement->bindValue(":id_usuario",$id);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement->closeCursor();
            return $result;
        }

#Este bloque borra la receta de la base de datos buscada por ID

        static public function deleteRecById($id)
            {
                global $conn;
                $query = "DELETE FROM receta WHERE idReceta = :id";
                $statement = $conn->prepare($query);
                $statement->bindValue(":id",$id);
                $statement->execute();
                $statement->closeCursor();
                $conn = null;
            }

#Este bloque actualiza una receta buscada por ID dentro de la base de datos

        public function updateRecById($id)
            {
                $query = "UPDATE receta 
                        SET tituloPost = :recTitle, descripcionPost = :recDescription, imagenPost = :recImage, pasosPost = :recSteps 
                        WHERE idReceta = :id";
                $statement = $this->db->prepare($query);
                $statement->bindValue(":recTitle",$this->recTitle);
                $statement->bindValue(":recDescription",$this->recDescription);
                $statement->bindValue(":recImage",$this->recImage);
                $statement->bindValue(":recSteps",$this->recSteps);
                $statement->bindValue(":id",$id);
                
                $statement->execute();
                $statement->closeCursor();
            }

        public static function getImagePathById($id){
            global $conn;
            $query = "SELECT imagenPost FROM receta WHERE idReceta = :id";
            $statement = $conn->prepare($query);
            $statement->bindValue(":id",$id);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();
            return $result["imagenPost"];
        }
    }


#Devuelve un nuevo directorio con nombre aleatorio


function deleteImageRec($id){
    $recImage = Rec::getImagePathById($id);
    unlink($recImage);
    $recImage = explode("/",$recImage);
    array_pop($recImage);
    $recImage = implode("/",$recImage);
    rmdir($recImage);
}