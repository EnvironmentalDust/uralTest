<?php

const PAGE_ENCODING     ='UTF-8';

if(mb_internal_encoding(PAGE_ENCODING) != PAGE_ENCODING) 
throw new SomeException('There is no support encoding: '.PAGE_ENCODING);

$mysqli = new mysqli("localhost", "root", "", "ural");
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if (isset($_GET) && !empty($_GET['deviceName'])) {
    $Name = strval($_GET['deviceName']);
    $Name = substr($Name, 1, -1);
    if ($stmt = $mysqli->prepare("SELECT devicequery.queryTime, devicequery.ping, device.deviceIP, deviceType.deviceTypeType, deviceType.deviceTypeName, device.deviceSerial, device.deviceMAC, device.deviceTelNum, device.deviceSubDiv, device.deviceInv, device.deviceNote FROM devicequery LEFT JOIN device ON devicequery.deviceID = device.deviceID LEFT JOIN deviceType ON device.deviceTypeID = deviceType.deviceTypeID WHERE device.deviceName = ? AND devicequery.queryTime > '07:00' AND devicequery.queryTime < '19:00'")) {
        $stmt->bind_param("s", $Name);
        $stmt->execute();
        $stmt->bind_result($queryTime, $ping, $IP, $typeType, $typeName, $serial, $MAC, $telNum, $subDiv, $inv, $note);
        $current = "";
        while ($row = $stmt->fetch()) {
            $timeRow = substr($queryTime, 0, -3);
            $IP = substr($IP, 0, -2);
            $text = sprintf ("{\"queryTime\":\"%s\",\"ping\":\"%s\",\"IP\":\"%s\",\"typeType\":\"%s\",\"typeName\":\"%s\",\"serial\":\"%s\",\"MAC\":\"%s\",\"telNum\":\"%s\",\"subDiv\":\"%s\",\"inv\":\"%s\",\"note\":\"%s\"}, \n", $timeRow, $ping, $IP, $typeType, $typeName, $serial, $MAC, $telNum, $subDiv, $inv, $note);
            $current .= $text;
        }
        $current = substr($current, 0, -3);
        echo "[$current]";
        $stmt->close();
    } else {
        echo "ERROR";
    }
} elseif (isset($_POST)) {
    var_dump($_POST);
    if ($stmt = $mysqli->prepare("UPDATE device SET deviceName=?,deviceIP=?,deviceSerial=?,deviceMAC=?,deviceTelNum=?,deviceSubDiv=?,deviceInv=?,deviceNote=? WHERE deviceName=? OR deviceIP=?")) {
        $stmt->bind_param("ssssssssss", $_POST['name'], $_POST['IP'], $_POST['serNum'], $_POST['MAC'], $_POST['telNum'], $_POST['subDiv'], $_POST['inv'], $_POST['note'], $_POST['name'], $_POST['IP']);
        $stmt->execute();
        var_dump($stmt);
        $stmt->close();
    }
}
?>
