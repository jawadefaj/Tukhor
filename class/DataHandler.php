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
            $stmt = $database->prepare("SELECT unit FROM Requirement WHERE versity = ? ORDER BY Unit");
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

    public function getSubjectListAll() {
        $database = $this->connect_database();
        try {
            $stmt = $database->prepare("SELECT subject
                                        FROM Subject
                                        WHERE background = 'All'
                                        ");
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

    public function getSubjectListGeneral() {
        $database = $this->connect_database();
        try {
            $stmt = $database->prepare("SELECT subject 
                                        FROM Subject
                                        WHERE background = 'All'
                                        UNION
                                        SELECT subject
                                        FROM Subject
                                        WHERE background = 'General'
                                        ");
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

    public function getSubjectListGeneralSci() {
        $database = $this->connect_database();
        try {
            $stmt = $database->prepare("SELECT subject 
                                        FROM Subject
                                        WHERE background = 'All'
                                        UNION
                                        SELECT subject
                                        FROM Subject
                                        WHERE background = 'General'
                                        UNION
                                        SELECT subject
                                        FROM Subject
                                        WHERE background = 'GeneralSci'
                                        ");
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

    public function getSubjectListGeneralCom() {
        $database = $this->connect_database();
        try {
            $stmt = $database->prepare("SELECT subject 
                                        FROM Subject
                                        WHERE background = 'All'
                                        UNION
                                        SELECT subject
                                        FROM Subject
                                        WHERE background = 'General'
                                        UNION
                                        SELECT subject
                                        FROM Subject
                                        WHERE background = 'GeneralCom'
                                        ");
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

    public function getSubjectListGeneralArts() {
        $database = $this->connect_database();
        try {
            $stmt = $database->prepare("SELECT subject 
                                        FROM Subject
                                        WHERE background = 'All'
                                        UNION
                                        SELECT subject
                                        FROM Subject
                                        WHERE background = 'General'
                                        UNION
                                        SELECT subject
                                        FROM Subject
                                        WHERE background = 'GeneralArts'
                                        ");
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

    public function getSubjectListMadrasaSci() {
        $database = $this->connect_database();
        try {
            $stmt = $database->prepare("SELECT subject 
                                        FROM Subject
                                        WHERE background = 'All'
                                        UNION
                                        SELECT subject
                                        FROM Subject
                                        WHERE background = 'General'
                                        UNION
                                        SELECT subject
                                        FROM Subject
                                        WHERE background = 'MadrasaSci'
                                        ");
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

    public function getSubjectListMadrasaGen() {
        $database = $this->connect_database();
        try {
            $stmt = $database->prepare("SELECT subject 
                                        FROM Subject
                                        WHERE background = 'All'
                                        UNION
                                        SELECT subject
                                        FROM Subject
                                        WHERE background = 'General'
                                        UNION
                                        SELECT subject
                                        FROM Subject
                                        WHERE background = 'MadrasaGen'
                                        ");
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

    public function getSubjectListEnglish() {
        $database = $this->connect_database();
        try {
            $stmt = $database->prepare("SELECT subject 
                                        FROM Subject
                                        WHERE background = 'All'
                                        UNION
                                        SELECT subject
                                        FROM Subject
                                        WHERE background = 'English'
                                        ");
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