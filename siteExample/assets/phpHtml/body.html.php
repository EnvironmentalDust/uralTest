<body>
    <?php include("assets/phpHtml/attr.html.php"); ?>
    <div id="wrapper">
        <?php include("assets/phpHtml/header.html.php"); ?>
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
        <?php include("assets/phpHtml/footer.html.php"); ?>
    </div>
</body>