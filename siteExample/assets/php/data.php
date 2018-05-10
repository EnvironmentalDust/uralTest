<?php

const PAGE_ENCODING     ='UTF-8';

if(mb_internal_encoding(PAGE_ENCODING) != PAGE_ENCODING) 
throw new SomeException('There is no support encoding: '.PAGE_ENCODING);

$mysqli = new mysqli("localhost", "root", "", "ural");
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
if (isset($_GET) && !empty($_GET['deviceName'])) {
    $Name = rawurldecode($_GET['deviceName']);
    $Name = strval($Name);
    
    if ($stmt = $mysqli->prepare("SELECT devicequery.queryTime, devicequery.ping, device.ipaddr, device.type, device.sernum, device.macaddr, device.telefon, device.podr, device.inv, device.note FROM devicequery LEFT JOIN device ON devicequery.deviceID = device.id WHERE device.name = ? AND devicequery.queryTime > '07:00' AND devicequery.queryTime < '19:00'")) {
        $stmt->bind_param("s", $Name);
        $stmt->execute();
        $stmt->bind_result($queryTime, $ping, $IP, $type, $serial, $MAC, $telNum, $subDiv, $inv, $note);
        $current = "";
        while ($row = $stmt->fetch()) {
            $timeRow = substr($queryTime, 0, -3);
            $IP = substr($IP, 0, -2);
            $MAC = str_replace("\r\n", ",", $MAC);
            // $MAC = str_replace("\r", ",", $MAC);
            $text = sprintf ("{\"queryTime\":\"%s\",\"ping\":\"%s\",\"IP\":\"%s\",\"type\":\"%s\",\"serial\":\"%s\",\"MAC\":\"%s\",\"telNum\":\"%s\",\"subDiv\":\"%s\",\"inv\":\"%s\",\"note\":\"%s\"}, \n", $timeRow, $ping, $IP, $type, $serial, $MAC, $telNum, $subDiv, $inv, $note);
            $current .= $text;
        }
        $current = substr($current, 0, -3);
        echo "[$current]";
        $stmt->close();
    } else {
        echo "ERROR";
    }
} elseif (isset($_POST) && htmlspecialchars(rawurldecode($_POST["state"])) == "Изменить") {
    $Name = htmlspecialchars(rawurldecode($_POST['name']));
    $IP = htmlspecialchars(rawurldecode($_POST['IP']) . "FU");
    $serial =  htmlspecialchars(rawurldecode($_POST['serial']));
    $MAC = htmlspecialchars(rawurldecode($_POST['MAC']));
    $telNum = htmlspecialchars(rawurldecode($_POST['telNum']));
    $subDiv = htmlspecialchars(rawurldecode($_POST['subDiv']));
    $inv = htmlspecialchars(rawurldecode($_POST['inv']));
    $note = htmlspecialchars(rawurldecode($_POST['note']));
    $type = htmlspecialchars(rawurldecode($_POST['type']));

    if ($stmt = $mysqli->prepare("UPDATE device SET name=?,ipaddr=?,type=?,sernum=?,macaddr=?,telefon=?,podr=?,inv=?,note=? WHERE name=?")) {
        $stmt->bind_param("ssssssssss", $Name, $IP, $type,$serial, $MAC, $telNum, $subDiv, $inv, $note, $Name);
        $stmt->execute();
        var_dump($stmt);
        $stmt->close();
    }
} elseif (isset($_POST) && htmlspecialchars(rawurldecode($_POST["state"])) == "Создать") {
    $Name = htmlspecialchars(rawurldecode($_POST['name']));
    $IP = htmlspecialchars(rawurldecode($_POST['IP']) . "FU");
    $serial =  htmlspecialchars(rawurldecode($_POST['serial']));
    $MAC = htmlspecialchars(rawurldecode($_POST['MAC']));
    $telNum = htmlspecialchars(rawurldecode($_POST['telNum']));
    $subDiv = htmlspecialchars(rawurldecode($_POST['subDiv']));
    $inv = htmlspecialchars(rawurldecode($_POST['inv']));
    $note = htmlspecialchars(rawurldecode($_POST['note']));
    $type = htmlspecialchars(rawurldecode($_POST['type']));

    if ($stmt = $mysqli->prepare("INSERT INTO `device`(`id`, `name`, `ipaddr`, `type`, `sernum`, `macaddr`, `telefon`, `podr`, `inv`, `note`) VALUES ('', ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
        var_dump($stmt);
        var_dump($stmt);
        $stmt->bind_param("ssssssssss", $Name, $IP, $type, $serial, $MAC, $telNum, $subDiv, $inv, $note);
        $stmt->execute();
        var_dump($stmt);
        $stmt->close();
    }
}
// INSERT INTO `device`(`deviceID`, `deviceName`, `deviceIP`, `deviceTypeID`, `deviceSerial`, `deviceMAC`, `deviceTelNum`, `deviceSubDiv`, `deviceInv`, `deviceNote`) VALUES 
// ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10])

?>

