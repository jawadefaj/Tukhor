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

    public function addLogicLeastSubCount($versity, $unit, $background, $subjectList, $minimumCount) {
        $database = $this->connect_database();
        try {
            $stmt = $database->prepare("SELECT DISTINCT code
                                        FROM LeastSubjectCount
                                        WHERE leastCount = ?");
            $stmt->execute(array($minimumCount));
            $allCodes = [];
            $subCount = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $allCodes[] = $row;
                $subCount[] = 0;
            }            
            $stmt = $database->prepare("SELECT code, subject
                                        FROM LeastSubjectCount
                                        WHERE leastCount = ?");
            $stmt->execute(array($minimumCount));
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
                                        FROM LeastSubjectCount");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $theCode = $row['MaxCode']+1;
                $count = count($subjectList);
                for ($i=0; $i<$count; $i++) {
                    $stmt = $database->prepare("INSERT INTO LeastSubjectCount (code, subject, leastCount)
                                        VALUES (?, ?, ?)");
                    $stmt->execute(array($theCode, $subjectList[$i], $minimumCount));
                }
            }
            $stmt = $database->prepare("SELECT COUNT(*) as rowCount
                                        FROM Requirement
                                        WHERE versity = ? AND unit = ? AND background = ? AND logicType = 'leastSubCount' AND code = ?");
            $stmt->execute(array($versity, $unit, $background, $theCode));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['rowCount'] === 0) {
                $stmt = $database->prepare("INSERT INTO Requirement (versity, unit, background, logicType, code)
                                            VALUES (?, ?, ?, 'leastSubCount', ?)");
                $stmt->execute(array($versity, $unit, $background, $theCode));
            }
            return true;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function addLogicLeastSubLeastGrade($versity, $unit, $background, $subjectList, $minimumCount, $minimumGrade) {
        $database = $this->connect_database();
        try {
            $stmt = $database->prepare("SELECT DISTINCT code
                                        FROM LeastSubjectLeastGrade
                                        WHERE minCount = ? AND val = ?");
            $stmt->execute(array($minimumCount, $minimumGrade));
            $allCodes = [];
            $subCount = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $allCodes[] = $row;
                $subCount[] = 0;
            }            
            $stmt = $database->prepare("SELECT code, subject
                                        FROM LeastSubjectLeastGrade
                                        WHERE minCount = ? AND val = ?");
            $stmt->execute(array($minimumCount, $minimumGrade));
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
                                        FROM LeastSubjectLeastGrade");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $theCode = $row['MaxCode']+1;
                $count = count($subjectList);
                for ($i=0; $i<$count; $i++) {
                    $stmt = $database->prepare("INSERT INTO LeastSubjectLeastGrade (code, subject, val, minCount)
                                        VALUES (?, ?, ?, ?)");
                    $stmt->execute(array($theCode, $subjectList[$i], $minimumGrade, $minimumCount));
                }
            }
            $stmt = $database->prepare("SELECT COUNT(*) as rowCount
                                        FROM Requirement
                                        WHERE versity = ? AND unit = ? AND background = ? AND logicType = 'leastSubLeastGrade' AND code = ?");
            $stmt->execute(array($versity, $unit, $background, $theCode));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['rowCount'] === 0) {
                $stmt = $database->prepare("INSERT INTO Requirement (versity, unit, background, logicType, code)
                                            VALUES (?, ?, ?, 'leastSubLeastGrade', ?)");
                $stmt->execute(array($versity, $unit, $background, $theCode));
            }
            return true;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function addLogicMaxSubLeastGrade($versity, $unit, $background, $subjectList, $maxCount, $minimumGrade) {
        $database = $this->connect_database();
        try {
            $stmt = $database->prepare("SELECT DISTINCT code
                                        FROM MaxSubjectLeastGrade
                                        WHERE maxCount = ? AND val = ?");
            $stmt->execute(array($maxCount, $minimumGrade));
            $allCodes = [];
            $subCount = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $allCodes[] = $row;
                $subCount[] = 0;
            }            
            $stmt = $database->prepare("SELECT code, subject
                                        FROM MaxSubjectLeastGrade
                                        WHERE maxCount = ? AND val = ?");
            $stmt->execute(array($maxCount, $minimumGrade));
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
                                        FROM MaxSubjectLeastGrade");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $theCode = $row['MaxCode']+1;
                $count = count($subjectList);
                for ($i=0; $i<$count; $i++) {
                    $stmt = $database->prepare("INSERT INTO MaxSubjectLeastGrade (code, subject, val, maxCount)
                                        VALUES (?, ?, ?, ?)");
                    $stmt->execute(array($theCode, $subjectList[$i], $minimumGrade, $maxCount));
                }
            }
            $stmt = $database->prepare("SELECT COUNT(*) as rowCount
                                        FROM Requirement
                                        WHERE versity = ? AND unit = ? AND background = ? AND logicType = 'maxSubLeastGrade' AND code = ?");
            $stmt->execute(array($versity, $unit, $background, $theCode));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['rowCount'] === 0) {
                $stmt = $database->prepare("INSERT INTO Requirement (versity, unit, background, logicType, code)
                                            VALUES (?, ?, ?, 'maxSubLeastGrade', ?)");
                $stmt->execute(array($versity, $unit, $background, $theCode));
            }
            return true;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function addLogicMinLogic($versity, $unit, $background, $subject, $minimumGrade) {
        $database = $this->connect_database();
        try {
            $stmt = $database->prepare("SELECT code
                                        FROM MinLogic
                                        WHERE subject = ? AND val = ?");
            $stmt->execute(array($subject, $minimumGrade));
            $theCode = -1;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $theCode = $row['code'];
            }
            if ($theCode === -1) {
                $stmt = $database->prepare("SELECT MAX(code) as MaxCode
                                        FROM MinLogic");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $theCode = $row['MaxCode']+1;
                $stmt = $database->prepare("INSERT INTO MinLogic (code, subject, val)
                                        VALUES (?, ?, ?)");
                $stmt->execute(array($theCode, $subject, $minimumGrade));
            }
            $stmt = $database->prepare("SELECT COUNT(*) as rowCount
                                        FROM Requirement
                                        WHERE versity = ? AND unit = ? AND background = ? AND logicType = 'minLogic' AND code = ?");
            $stmt->execute(array($versity, $unit, $background, $theCode));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['rowCount'] === 0) {
                $stmt = $database->prepare("INSERT INTO Requirement (versity, unit, background, logicType, code)
                                            VALUES (?, ?, ?, 'minLogic', ?)");
                $stmt->execute(array($versity, $unit, $background, $theCode));
            }
            return true;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}