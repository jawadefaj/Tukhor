<?php
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
                        $satisfy = $this->addMinimum($subjectList, $gradeList, $row['code']);
                        break;
					
					case 'leastSubCount':
						$satisfy = $this->leastSubjectCount($subjectList, $row['code']);
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
	
	/* Least subject count */
	
	public function leastSubjectCount( $subjectList, $code){
		$database = $this->connect_database();
		$stmt = $database->prepare("SELECT subject, leastCount
									FROM LeastSubjectCount 
									WHERE code = ?");
		$stmt->execute(array($code));
		$count = 0;
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$MinValue = $row['leastCount'];
			
			$isHave = in_array ($row['subject'] , $subjectList);
			if($isHave) {
				$count++;
			}
		}
		return $count >= $MinValue;
	}
	
	/* leastSubLeastGrade */
	
	public function leastSubLeastGrade($subjectList, $gradeList, $code)
	{
		$database = $this->connect_database();
		$stmt = $database->prepare("SELECT subject, val, minCount
									FROM LeastSubLeastGrade
									WHERE code = ?");
		$stmt->execute(array($code));
		$subject = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$subject = $row['subject'];
			$val = $row['val'];
			$minCount = $row['minCount'];
		}
		if($subject[0] == 'OAAll' || $subject[0] == 'OAll' || $subject[0] == 'AAll' || $subject[0] == 'GAll')
		{
			$count = 0;
			for($j=0; $j<count($gradeList), $j++)
			{
				if($gradeList[$j] >= $val)
					$count++;
			}
			return $count >= $minCount;
		}
		$count = 0;
		for($i=0; i<count($subject); i++)
		{
			if (($index = array_search($subject[$i], $subjectList)) === false) {
				return false;
			}
			if($gradeList[$index] >= $val)
				$count++;
		}
		return $count >= $minCount;
	}
	
	/* max subject least grade */
	
	public function maxSubLeastGrade($subjectList, $gradeList, $code)
	{
		$database = $this->connect_database();
		$stmt = $database->prepare("SELECT subject, val, maxCount
									FROM LeastSubLeastGrade
									WHERE code = ?");
		$stmt->execute(array($code));
		$subject = [];
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$subject = $row['subject'];
			$val = $row['val'];
			$maxCount = $row['maxCount'];
		}
		if($subject[0] == 'OAAll' || $subject[0] == 'OAll' || $subject[0] == 'AAll' || $subject[0] == 'GAll')
		{
			$count = 0;
			for($j=0; $j<count($gradeList), $j++)
			{
				if($gradeList[$j] < $val)
					$count++;
			}
			return $count > $maxCount;
		}
		$count = 0;
		for($i=0; i<count($subject); i++)
		{
			$index;
			if (($index = array_search($subject[$i], $subjectList)) === false) {
				return false;
			}
			if($gradeList[$index] < $val)
				$count++;
		}
		return $count > $maxCount;
	
	}
	
	/* min logic */
	
	public function minLogic($subject, $grade, $code)
	{
		$database = $this->connect_database();
		$stmt = $database->prepare("SELECT subject, val
									FROM LeastSubLeastGrade
									WHERE code = ?");
		$stmt->execute(array($code));
		$row = $stmt->fetch(PDO::FETCH_ASSOC)
		if(($row['subject'] == $subject && ($row['val'] >= $grade))
			return true;
		else 
			return false;
	}



?>