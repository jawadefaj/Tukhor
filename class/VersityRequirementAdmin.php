<?
/**
*Functions related to versity requirement add
*/
include __DIR__."/Database.php";

class VersityRequirementAdmin extends Database{

    function __construct() {
    }

    public function addLogicAddMinimum($versity, $unit, $background, $subjectList, $minimumValue) {
        $database = $this->connect_database();
        try {
            $stmt = $database->prepare("SELECT DISTINCT code
                                        FROM AddMinimum
                                        WHERE val = ?");
            $stmt->execute(array($minimumValue));
            $allCodes = [];
            $subCount = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $allCodes[] = $row;
                $subCount[] = 0;
            }            
            $stmt = $database->prepare("SELECT code, subject
                                        FROM AddMinimum
                                        WHERE val = ?");
            $stmt->execute(array($minimumValue));
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $key = array_search(array('code' => $row['code']), $allCodes);
                if (array_search($row['subject'], $subjectList) === false) {
                    $allCodes[$key]['code'] = -1;
                }
                else {
                    $subCount[$key]++;
                }
            }
            $count = count($subCount);
            $theCode = -1;
            for ($i=0; $i<$count; $i++) {
                if($subCount[$i] === count($subjectList) && $allCodes[$i]['code'] > -1) {
                    $theCode = $allCodes[$i]['code'];
                    break;
                }
            }
            if ($theCode === -1) {
                $stmt = $database->prepare("SELECT MAX(code) as MaxCode
                                        FROM AddMinimum");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $theCode = $row['MaxCode']+1;
                $count = count($subjectList);
                for ($i=0; $i<$count; $i++) {
                    $stmt = $database->prepare("INSERT INTO AddMinimum (code, subject, val)
                                        VALUES (?, ?, ?)");
                    $stmt->execute(array($theCode, $subjectList[$i], $minimumValue));
                }
            }
            $stmt = $database->prepare("SELECT COUNT(*) as rowCount
                                        FROM Requirement
                                        WHERE versity = ? AND unit = ? AND background = ? AND logicType = 'addMinimum' AND code = ?");
            $stmt->execute(array($versity, $unit, $background, $theCode));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['rowCount'] === 0) {
                $stmt = $database->prepare("INSERT INTO Requirement (versity, unit, background, logicType, code)
                                            VALUES (?, ?, ?, 'addMinimum', ?)");
                $stmt->execute(array($versity, $unit, $background, $theCode));
            }
            return true;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}