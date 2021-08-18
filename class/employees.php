<?php
class Employee{

    // Connection
    private $conn;

    // Table
    private $db_table = "Prueba";

    // Columns
    public $id;
    public $lote;
    public $nombre;
    public $apellido;
    public $inicio;
    public $terminacion;
    public $tipo;
    public $numPieza;
    public $defPieza;

    // Db connection
    public function __construct($db){
        $this->conn = $db;
    }

    // GET ALL
    public function getEmployees(){
        $sqlQuery = "SELECT id, lote, nombre, apellido, inicio, terminacion, tipo,numPieza, defPieza FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    // CREATE
    public function createEmployee(){
        $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        lote = :lote, 
                        nombre = :nombre, 
                        apellido = :apellido, 
                        inicio = :inicio, 
                        terminacion = :terminacion,
                        tipo = :tipo,
                        numPieza = :numPieza,
                        defPieza = :defPieza";

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->lote=htmlspecialchars(strip_tags($this->lote));
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->apellido=htmlspecialchars(strip_tags($this->apellido));
        $this->inicio=htmlspecialchars(strip_tags($this->inicio));
        $this->terminacion=htmlspecialchars(strip_tags($this->terminacion));
        $this->tipo=htmlspecialchars(strip_tags($this->tipo));
        $this->numPieza=htmlspecialchars(strip_tags($this->numPieza));
        $this->defPieza=htmlspecialchars(strip_tags($this->defPieza));

        // bind data
        $stmt->bindParam(":lote", $this->lote);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellido", $this->apellido);
        $stmt->bindParam(":inicio", $this->inicio);
        $stmt->bindParam(":terminacion", $this->terminacion);
        $stmt->bindParam(":tipo", $this->tipo);
        $stmt->bindParam(":numPieza", $this->numPieza);
        $stmt->bindParam(":defPieza", $this->defPieza);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // READ single
    public function getSingleEmployee(){
        $sqlQuery = "SELECT
                        id, 
                        name, 
                        email, 
                        age, 
                        designation, 
                        created
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $dataRow['name'];
        $this->email = $dataRow['email'];
        $this->age = $dataRow['age'];
        $this->designation = $dataRow['designation'];
        $this->created = $dataRow['created'];
    }

    // UPDATE
    public function updateEmployee(){
        $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        email = :email, 
                        age = :age, 
                        designation = :designation, 
                        created = :created
                    WHERE 
                        id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->age=htmlspecialchars(strip_tags($this->age));
        $this->designation=htmlspecialchars(strip_tags($this->designation));
        $this->created=htmlspecialchars(strip_tags($this->created));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind data
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":age", $this->age);
        $stmt->bindParam(":designation", $this->designation);
        $stmt->bindParam(":created", $this->created);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // DELETE
    function deleteEmployee(){
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

}
?>