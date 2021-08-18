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
                        lote, 
                        nombre, 
                        apellido, 
                        inicio, 
                        terminacion, 
                        tipo, 
                        numPieza, 
                        defPieza
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->lote = $dataRow['lote'];
        $this->nombre = $dataRow['nombre'];
        $this->apellido = $dataRow['apellido'];
        $this->inicio = $dataRow['inicio'];
        $this->terminacion = $dataRow['terminacion'];
        $this->tipo = $dataRow['tipo'];
        $this->numPieza = $dataRow['numPieza'];
        $this->defPieza = $dataRow['defPieza'];
    }

    // UPDATE
    public function updateEmployee(){
        $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        lote = :lote, 
                        nombre = :nombre, 
                        apellido = :apellido, 
                        inicio = :inicio, 
                        terminacion = :terminacion, 
                        tipo = :tipo, 
                        numPieza = :numPieza, 
                        defPieza = :defPieza
                    WHERE 
                        id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->lote=htmlspecialchars(strip_tags($this->lote));
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->apellido=htmlspecialchars(strip_tags($this->apellido));
        $this->inicio=htmlspecialchars(strip_tags($this->inicio));
        $this->terminacion=htmlspecialchars(strip_tags($this->terminacion));
        $this->tipo=htmlspecialchars(strip_tags($this->tipo));
        $this->numPieza=htmlspecialchars(strip_tags($this->numPieza));
        $this->defPieza=htmlspecialchars(strip_tags($this->defPieza));
        $this->id=htmlspecialchars(strip_tags($this->id));

        // bind data
        $stmt->bindParam(":lote", $this->lote);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellido", $this->apellido);
        $stmt->bindParam(":inicio", $this->inicio);
        $stmt->bindParam(":terminacion", $this->terminacion);
        $stmt->bindParam(":tipo", $this->tipo);
        $stmt->bindParam(":numPieza", $this->numPieza);
        $stmt->bindParam(":defPieza", $this->defPieza);
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