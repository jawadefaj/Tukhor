<?php
/**
*Functions related to versity search
*/
include __DIR__."/Database.php";

class VersityFinder extends Database{

    function __construct() {
    }

    public function showAvailableVersityUnit($subjectList, $gradeList, $background) {
        $database = $this->connect_database();
        try {
        	switch ($background) {
        		case 'All':
        			$stmt = $database->prepare("SELECT DISTINCT versity, unit
                                        		FROM Requirement
                                        		WHERE background = 'All'");		
        			break;
        		case 'General':
        			$stmt = $database->prepare("SELECT DISTINCT versity, unit
                                        		FROM Requirement
                                        		WHERE background = 'All'
                                        		UNION
                                        		SELECT DISTINCT versity, unit
                                        		FROM Requirement
                                        		WHERE background = 'General'");
        			break;
        		case 'GeneralSci':
        			$stmt = $database->prepare("SELECT DISTINCT versity, unit
                                        		FROM Requirement
                                        		WHERE background = 'All'
                                        		UNION
                                        		SELECT DISTINCT versity, unit
                                        		FROM Requirement
                                        		WHERE background = 'General'
                                        		UNION
                                        		SELECT DISTINCT versity, unit
                                        		FROM Requirement
                                        		WHERE background = 'GeneralSci'");
        			break;
        		case 'GeneralCom':
        			$stmt = $database->prepare("SELECT DISTINCT versity, unit
                                        		FROM Requirement
                                        		WHERE background = 'All'
                                        		UNION
                                        		SELECT DISTINCT versity, unit
                                        		FROM Requirement
                                        		WHERE background = 'General'
                                        		UNION
                                        		SELECT DISTINCT versity, unit
                                        		FROM Requirement
                                        		WHERE background = 'GeneralCom'");
        			break;
        		case 'GeneralArts':
        			$stmt = $database->prepare("SELECT DISTINCT versity, unit
                                        		FROM Requirement
                                        		WHERE background = 'All'
                                        		UNION
                                        		SELECT DISTINCT versity, unit
                                        		FROM Requirement
                                        		WHERE background = 'General'
                                        		UNION
                                        		SELECT DISTINCT versity, unit
                                        		FROM Requirement
                                        		WHERE background = 'GeneralArts'");
        			break;
        		case 'MadrasaSci':
        			$stmt = $database->prepare("SELECT DISTINCT versity, unit
                                        		FROM Requirement
                                        		WHERE background = 'All'
                                        		UNION
                                        		SELECT DISTINCT versity, unit
                                        		FROM Requirement
                                        		WHERE background = 'General'
                                        		UNION
                                        		SELECT DISTINCT versity, unit
                                        		FROM Requirement
                                        		WHERE background = 'MadrasaSci'");
        			break;
        		case 'MadrasaGen':
        			$stmt = $database->prepare("SELECT DISTINCT versity, unit
                                        		FROM Requirement
                                        		WHERE background = 'All'
                                        		UNION
                                        		SELECT DISTINCT versity, unit
                                        		FROM Requirement
                                        		WHERE background = 'General'
                                        		UNION
                                        		SELECT DISTINCT versity, unit
                                        		FROM Requirement
                                        		WHERE background = 'MadrasaGen'");
        			break;
        			case 'English':
        			$stmt = $database->prepare("SELECT DISTINCT versity, unit
                                        		FROM Requirement
                                        		WHERE background = 'All'
                                        		UNION
                                        		SELECT DISTINCT versity, unit
                                        		FROM Requirement
                                        		WHERE background = 'English'");
        			break;
        	}
            $stmt->execute(array());
            $allVersities = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $allVersities[] = $row;
            }
            switch ($background) {
        		case 'All':
        			$stmt = $database->prepare("SELECT versity, unit, logicType, code
                                        		FROM Requirement
                                        		WHERE background = 'All'");		
        			break;
        		case 'General':
        			$stmt = $database->prepare("SELECT versity, unit, logicType, code
                                        		FROM Requirement
                                        		WHERE background = 'All'
                                        		UNION
                                        		SELECT versity, unit, logicType, code
                                        		FROM Requirement
                                        		WHERE background = 'General'");
        			break;
        		case 'GeneralSci':
        			$stmt = $database->prepare("SELECT versity, unit, logicType, code
                                        		FROM Requirement
                                        		WHERE background = 'All'
                                        		UNION
                                        		SELECT versity, unit, logicType, code
                                        		FROM Requirement
                                        		WHERE background = 'General'
                                        		UNION
                                        		SELECT versity, unit, logicType, code
                                        		FROM Requirement
                                        		WHERE background = 'GeneralSci'");
        			break;
        		case 'GeneralCom':
        			$stmt = $database->prepare("SELECT versity, unit, logicType, code
                                        		FROM Requirement
                                        		WHERE background = 'All'
                                        		UNION
                                        		SELECT versity, unit, logicType, code
                                        		FROM Requirement
                                        		WHERE background = 'General'
                                        		UNION
                                        		SELECT versity, unit, logicType, code
                                        		FROM Requirement
                                        		WHERE background = 'GeneralCom'");
        			break;
        		case 'GeneralArts':
        			$stmt = $database->prepare("SELECT versity, unit, logicType, code
                                        		FROM Requirement
                                        		WHERE background = 'All'
                                        		UNION
                                        		SELECT versity, unit, logicType, code
                                        		FROM Requirement
                                        		WHERE background = 'General'
                                        		UNION
                                        		SELECT versity, unit, logicType, code
                                        		FROM Requirement
                                        		WHERE background = 'GeneralArts'");
        			break;
        		case 'MadrasaSci':
        			$stmt = $database->prepare("SELECT versity, unit, logicType, code
                                        		FROM Requirement
                                        		WHERE background = 'All'
                                        		UNION
                                        		SELECT versity, unit, logicType, code
                                        		FROM Requirement
                                        		WHERE background = 'General'
                                        		UNION
                                        		SELECT versity, unit, logicType, code
                                        		FROM Requirement
                                        		WHERE background = 'MadrasaSci'");
        			break;
        		case 'MadrasaGen':
        			$stmt = $database->prepare("SELECT versity, unit, logicType, code
                                        		FROM Requirement
                                        		WHERE background = 'All'
                                        		UNION
                                        		SELECT versity, unit, logicType, code
                                        		FROM Requirement
                                        		WHERE background = 'General'
                                        		UNION
                                        		SELECT versity, unit, logicType, code
                                        		FROM Requirement
                                        		WHERE background = 'MadrasaGen'");
        			break;
        			case 'English':
        			$stmt = $database->prepare("SELECT versity, unit, logicType, code
                                        		FROM Requirement
                                        		WHERE background = 'All'
                                        		UNION
                                        		SELECT versity, unit, logicType, code
                                        		FROM Requirement
                                        		WHERE background = 'English'");
        			break;
        	}
            $stmt->execute(array());
            /*$temp = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            	$temp[] = $row;
            }
            return $temp;*/
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $key = array_search(array('versity' => $row['versity'], 'unit' => $row['unit']), $allVersities);
                if ($allVersities[$key]['unit'] === "Rejected") {
                    continue;
                }
                switch ($row['logicType']) {
                    case 'addMinimum':
                        $satisfy = $this->addMinimum($subjectList, $gradeList, $row['code']);
                        break;
					case 'leastSubCount':
						$satisfy = $this->leastSubjectCount($subjectList, $row['code']);
						break;
                    case 'leastSubLeastGrade':
                        $satisfy = $this->leastSubLeastGrade($subjectList, $gradeList, $row['code']);
                        break;
                    case 'maxSubLeastGrade':
                        $satisfy = $this->maxSubLeastGrade($subjectList, $gradeList, $row['code']);
                        break;
                    case 'minLogic':
                        $satisfy = $this->minLogic($subjectList, $gradeList, $row['code']);
                        break;
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
	
	public function leastSubjectCount ($subjectList, $code){
		$database = $this->connect_database();
		try {
			$stmt = $database->prepare("SELECT subject, leastCount
										FROM LeastSubjectCount
										WHERE code = ?");
			$stmt->execute(array($code));
			$subject = [];
			$count = 0;
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$subject[] = $row['subject'];
				$minCount = $row['leastCount'];
				if($row['subject'] == "O level") {
					$tempCount = 0;
					for ($i=0; $i<count($subjectList); $i++) {
						if($subjectList[$i] != "O level" && $subjectList[$i] != "A level" && strpos($subjectList[$i], "O level") !== false) {
							$tempCount++;
						}
					}
					return $tempCount >= $minCount;
				}
				if($row['subject'] == "A level") {
					$tempCount = 0;
					for ($i=0; $i<count($subjectList); $i++) {
						if($subjectList[$i] != "O level" && $subjectList[$i] != "A level" && strpos($subjectList[$i], "O level") === false) {
							$tempCount++;
						}
					}
					return $tempCount >= $minCount;
				}
				if(in_array($row['subject'], $subjectList)) {
					$count++;
				}
			}
			return $count >= $MinValue;
		} catch (PDOException $ex) {
            echo $ex->getMessage();
        }
	}
	
	public function leastSubLeastGrade($subjectList, $gradeList, $code) {
		$database = $this->connect_database();
		try {
			$stmt = $database->prepare("SELECT subject, val, minCount
										FROM LeastSubjectLeastGrade
										WHERE code = ?");
			$stmt->execute(array($code));
			$subject = [];
			$count = 0;
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$subject[] = $row['subject'];
				$minCount = $row['minCount'];
				$val = $row['val'];
				if($row['subject'] == "O level") {
					$tempCount = 0;
					for ($i=0; $i<count($subjectList); $i++) {
						if($subjectList[$i] != "O level" && $subjectList[$i] != "A level" && strpos($subjectList[$i], "O level") !== false && $gradeList[$i] >= $val) {
							$tempCount++;
						}
					}
					return $tempCount >= $minCount;
				}
				if($row['subject'] == "A level") {
					$tempCount = 0;
					for ($i=0; $i<count($subjectList); $i++) {
						if($subjectList[$i] != "O level" && $subjectList[$i] != "A level" && strpos($subjectList[$i], "O level") === false && $gradeList[$i] >= $val) {
							$tempCount++;
						}
					}
					return $tempCount >= $minCount;
				}
				if(($key = array_search($row['subject'], $subjectList)) !== false) {
					if ($gradeList[$key] >= $val) {
						$count++;
					}
				}
			}
			return $count >= $minCount;
		} catch (PDOException $ex) {
            echo $ex->getMessage();
        }
	}
	
	public function maxSubLeastGrade($subjectList, $gradeList, $code) {
		$database = $this->connect_database();
		try {
			$stmt = $database->prepare("SELECT subject, val, mxaCount
										FROM MaxSubjectLeastGrade
										WHERE code = ?");
			$stmt->execute(array($code));
			$subject = [];
			$count = 0;
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$subject[] = $row['subject'];
				$maxCount = $row['maxCount'];
				$val = $row['val'];
				if($row['subject'] == "O level") {
					$tempCount = 0;
					for ($i=0; $i<count($subjectList); $i++) {
						if($subjectList[$i] != "O level" && $subjectList[$i] != "A level" && strpos($subjectList[$i], "O level") !== false && $gradeList[$i] <= $val) {
							$tempCount++;
						}
					}
					return $tempCount >= $minCount;
				}
				if($row['subject'] == "A level") {
					$tempCount = 0;
					for ($i=0; $i<count($subjectList); $i++) {
						if($subjectList[$i] != "O level" && $subjectList[$i] != "A level" && strpos($subjectList[$i], "O level") === false && $gradeList[$i] <= $val) {
							$tempCount++;
						}
					}
					return $tempCount <= $maxCount;
				}
				if(($key = array_search($row['subject'], $subjectList)) !== false) {
					if ($gradeList[$key] <= $val) {
						$count++;
					}
				}
			}
			return $count <= $MinValue;
		} catch (PDOException $ex) {
            echo $ex->getMessage();
        }
	}
	
	public function minLogic($subjectList, $gradeList, $code) {
		$database = $this->connect_database();
		$stmt = $database->prepare("SELECT subject, val
									FROM MinLogic
									WHERE code = ?");
		$stmt->execute(array($code));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if(($key = array_search($row['subject'], $subjectList)) !== false) {
			if ($gradeList[$key] >= $row['val']){
				return true;
			}
		}
		return false;
	}
}
?>
