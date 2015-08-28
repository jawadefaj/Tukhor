<?
/**
*Functions related to versity search
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

    public function showAvailableVersityUnit($subjectList, $gradeList, $background) {
        $database = $this->connect_database();
        try {
            $stmt = $database->prepare("SELECT DISTINCT versity, unit
                                        FROM Requirement
                                        WHERE background = ?");
            $stmt->execute(array($background));
            $allVersities = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $allVersities[] = $row;
            }
            $stmt = $database->prepare("SELECT versity, unit, logicType, code 
                                        FROM Requirement
                                        WHERE background = ?");
            $stmt->execute(array($background));
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (($key = array_search(array('versity' => $row['versity'], 
                                                'unit' => $row['unit']), $allVersities)) === false) {
                    continue;
                }
                switch ($row['logicType']) {
                    /*
                    other cases
                    */
                    case 'addMinimum':
                        $satisfy = true;//$this->addMinimum($subjectList, $gradeList, $row['code']);
                        break;
                    /*
                    other cases
                    */
                    default:
                        $satisfy = false;
                }
                if (!$satisfy) { 
                    $key = array_search(array('versity' => $row['versity'], 'unit' => $row['unit']), $allVersities);
                    $allVersities[$key]['unit'] = "Rejected";
                }
            }
            $count = count($allVersities);
            $availableVersities = [];
            for ($i=0; $i<$count; $i++) {
                if($allVersities[$i]['unit'] != "Rejected") {
                    $availableVersities[] = $allVersities[$i];
                }
            }
            return $availableVersities;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }    

    public function addMinimum($subjectList, $gradeList, $code) {
        $database = $this->connect_database();
        try {
            $stmt = $database->prepare("SELECT subject, val
                                        FROM AddMinimum
                                        WHERE code = ?");
            $stmt->execute(array($code));
            $toBeTestedSubjects = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $toBeTestedSubjects[] = $row['subject'];
                $minimumValue = $row['val'];
            }
            $count = count($subjectList);
            $total = 0;
            for ($i=0; $i<$count; $i++) {
                if(($key = array_search($subjectList[$i], $toBeTestedSubjects)) !== false) {
                    $total += $gradeList[$i];
                }
            }
            return $total >= $minimumValue;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}