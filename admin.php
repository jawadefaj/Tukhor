<HTML>
<head>
</head>
<body>
	<select id="versitySelect">
	</select>
	Other Versity Name: <input type="text" id="versityName"/><br/><br/>
	<select id="unitSelect">
	</select>
	Other Unit Name: <input type="text" id="unitName"/><br/><br/>
	Target background
	<select id="backgroundSelect">
		<option value="All">All students</option>
		<option value="General">Bangla Medium and Madrasa</option>
		<option value="GeneralSci">Bangla Medium Science</option>
		<option value="GeneralCom">Bangla Medium Commerece</option>
		<option value="GeneralArts">Bangla Medium Arts</option>
		<option value="MadrasaSci">Madrasa Science</option>
		<option value="MadrasaGen">Madrasa General</option>
		<option value="English">English Medium</option>
	</select><br/><br/>
	Type of requirement:
	<select id="logicSelect">
		<option value="minimumYear">Least passing year</option>
		<option value="addMinimum">Minimum summation of grades</option>
		<option value="leastSubCount">Minimum subject count</option>
		<option value="leastSubLeastGrade">Minimum number of subjects with a certain grade</option>
		<option value="maxSubLeastGrade">Maximum allowable subject with a grade</option>
		<option value="minLogic">Minimum grade in a subject or exam</option>
	</select><br/><br/>
	<button id="loadDetails">Add Details</button><br/><br/>
    <div id="details"></div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="/Tukhor/script/admin.js"></script>
</body>
</HTML>