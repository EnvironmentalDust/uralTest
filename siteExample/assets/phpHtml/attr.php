<div id="attr">
    <p id="type">
        Тип устройства: <textarea id="type" cols="22" rows="1" <?php if (!isset($_SESSION)) { print_r("disabled"); } ?>></textarea>
    </p>
    <p id="name">
        Имя устройства: <textarea id="name" cols="22" rows="1" <?php if (!isset($_SESSION)) { print_r("disabled"); } ?>></textarea>
    </p>
    <p id="serial">
        Серийный номер: <textarea id="serial" cols="22" rows="1" <?php if (!isset($_SESSION)) { print_r("disabled"); } ?>></textarea>
    </p>
    <p id="IP">
        IP: <textarea id="IP" cols="22" rows="1" <?php if (!isset($_SESSION)) { print_r("disabled"); } ?>></textarea>
    </p>
    <p id="MAC">
        MAC: <textarea id="MAC" cols="22" rows="1" <?php if (!isset($_SESSION)) { print_r("disabled"); } ?>></textarea>
    </p>
    <p id="inventory">
        Инвентарный номер: <textarea id="inventory" cols="22" rows="1" <?php if (!isset($_SESSION)) { print_r("disabled"); } ?>></textarea>
    </p>
    <p id="telnum">
        Телефон: <textarea id="telnum" cols="22" rows="1" <?php if (!isset($_SESSION)) { print_r("disabled"); } ?>></textarea>
    </p>
    <p id="subdiv">
        Номер подразделения: <textarea id="subdiv" cols="22" rows="1" <?php if (!isset($_SESSION)) { print_r("disabled"); } ?>></textarea>
    </p>
    <p id="note">
        Примечание: <textarea id="note" cols="22" rows="5" <?php if (!isset($_SESSION)) { print_r("disabled"); } ?>></textarea>
    </p>
    <?php 
        if (isset($_SESSION)) 
        {
            include("assets/phpHtml/change.php");
        }
    ?>
</div>