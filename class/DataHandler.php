<?
/**
*Functions related to versity search
*/
include __DIR__."/Database.php";

class DataHandler extends Database{

    function __construct() {
    }

    public function getVersityName() {
        $database = $this->connect_database();
        try {
            $stmt = $database->prepare("SELECT DISTINCT versity FROM Requirement ORDER BY versity");
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

    public function getUnitName($versity) {
        $database = $this->connect_database();
        try {
            $stmt = $database->prepare("SELECT DISTINCT unit FROM Requirement WHERE versity = ? ORDER BY Unit");
            $stmt->execute(array($versity));
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