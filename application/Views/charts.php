<html>
    <head>
        <script type="text/javascript" src="../../js/highcharts.js"></script>
        <script type="text/javascript" src="../../js/exporting.js"></script>
    </head>
    <body>
        <div class="boxLarge top">
            <h3 class="header">Price History</h3>
            <div class="content top" id="graph">
                <?php if(isset($charts)) echo $charts;  ?>
            </div>
        </div>
    </body>
</html>