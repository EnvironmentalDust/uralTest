<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- <script type="text/javascript" src="assets/js/jQuery.js"></script> -->
    <!-- load the d3.js library -->
    <script src="assets/js/d3.min.js"></script>
    <title>URALaz</title>
</head>
<meta charset="utf-8">
<body>
    <?php include("assets/phpHtml/attr.php"); ?>
    <div id="wrapper">
        <?php include("assets/phpHtml/header.php"); ?>
    	<!-- load map and js for graph changing -->
        <div id="map">
        	<?php echo file_get_contents("assets/svg/trueMap.svg") ?>
        	<script type="text/javascript" src="assets/js/func.js"></script>  
        	<script type="text/javascript" src="assets/js/script.js"></script>  
        </div>
        <!-- load js file and create graph -->
        <div id="graph">
            <svg></svg>
        	<script type="text/javascript" src="assets/js/graph.js"></script>
        </div>
        <?php include("assets/phpHtml/footer.php"); ?>
    </div>

</body>