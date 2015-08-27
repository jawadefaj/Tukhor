<?
/**
*Functions related to users 
*/
include __DIR__."/Database.php";

class VersityFinder extends Database{

    function __construct() {
    }

    public function showAllVersityName() {
        $database = $this->connect_database();
        try {
            $stmt = $database->prepare("SELECT DISTINCT versity, unit FROM Requirement");
            $stmt->execute();
            $rows = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $rows[] = $row;
            }
            return $rows;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}