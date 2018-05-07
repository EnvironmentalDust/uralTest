<?php
$mysqli = new mysqli("localhost", "root", "", "ural");
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
};


function generatePassword($length = 8)
{
	$chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
	$numChars = strlen($chars);
	$string = '';
	for ($i = 0; $i < $length; $i++) {
	$string .= substr($chars, rand(1, $numChars) - 1, 1);
	}
	return $string;
};
function InsertQuery($i=0, $j=10, $mysqli)
{
	// insert test sets
	$stmt = $mysqli->prepare("INSERT INTO devicequery (deviceID, queryDate, queryTime, ping) VALUES ( ?, ?, ?, ?)");
	$stmt->bind_param('issi', $deviceID, $queryDate, $queryTime, $ping);

	while ($i <= $j) {

		$deviceID = rand(2, 10);
		$queryDate = date('Y-m-d');
		/*$queryTime = date('H:i:s');*/
		$queryTime = rand(1,23) . ":" . rand(1,60) . ":" . rand(1,60);
		$ping = rand(2, 100);


		$stmt->execute();

		printf("%d Row inserted.\n", $stmt->affected_rows);
		$i++;
	}

	$stmt->close();
};
function InsertDevices($i=0, $j=10, $mysqli)
{
	// insert test sets
	$stmt = $mysqli->prepare("INSERT INTO device (deviceName, deviceIP, deviceTypeID) VALUES (?, ?, ?)");
	$stmt->bind_param('ssi', $deviceName, $deviceIP, $deviceTypeID);

	while ($i <= $j) {
		$deviceIP = rand(1, 255) . "." . rand(1, 255) . "." . rand(1, 255) . "." . rand(1, 255) . "\r";
		$deviceName = generatePassword();
		$deviceTypeID = rand(1, 5);
		$stmt->execute();

		printf("%d Row inserted.\n", $stmt->affected_rows);
		$i++;
	}
	$stmt->close();
};
function CreateTables($mysqli) 
{
	/* Select запросы возвращают результирующий набор */
	if ($result = $mysqli->query("CREATE TABLE device (deviceID int PRIMARY KEY AUTO_INCREMENT NOT NULL, deviceName varchar(255) NOT NULL, deviceIP varchar(15) NOT NULL, deviceTypeID varchar(10))")) {
	    printf("Создана таблица устройств");
	}
	/* Select запросы возвращают результирующий набор */
	if ($result = $mysqli->query("CREATE TABLE deviceQuery (queryID int PRIMARY KEY AUTO_INCREMENT NOT NULL, deviceID varchar(255) NOT NULL, queryDate date NOT NULL, queryTime time NOT NULL, ping int)")) {
	    printf("Создана таблица запросов по устройствам");
	}	
	/* Select запросы возвращают результирующий набор */
	if ($result = $mysqli->query("CREATE TABLE deviceType (deviceTypeID int PRIMARY KEY AUTO_INCREMENT NOT NULL, deviceTypeName varchar(255) NOT NULL)")) {
	    printf("Создана таблица типов устройств");
	}
};


InsertQuery(0, 1000000, $mysqli);
InsertDevices(0, 1000000, $mysqli);