<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stand Table</title>
        <?php include 'header.html';?>
    <style>
        <?php include 'styles.css'; ?>
    </style>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            color: #333;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            min-height: 60vh;
        }
        header, footer {
            background-color: #4CAF50;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        main {
            flex: 1;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        h1 {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            color: black;
            background-color: #6BBF59;
            text-align: center;
        }
        tr:hover {
            background-color: #f5f5f5;
        }

    </style>
    <?php

    DEFINE ('DB_USER', 'root');
    DEFINE ('DB_PASSWORD', '');
    DEFINE ('DB_HOST', 'localhost');
    DEFINE ('DB_NAME', 'tree');
    
    // Make the connection:
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error());
    
    // Set the encoding...
    mysqli_set_charset($dbc, 'utf8');
    
    
    /*-------------------- Categories 5 - 15 --------------------*/
    $VolumeMersawaSQL = "SELECT COUNT(*) AS totalVolume FROM newforestori WHERE spgroup = 1 AND Diameter>=5 AND Diameter<=15";
    $result = mysqli_query($dbc, $VolumeMersawaSQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreeMersawa1 = $row['totalVolume'];
    }
    
    $VolumeKeruingSQL = "SELECT COUNT(*) AS totalVolume FROM newforestori WHERE spgroup = 2 AND Diameter>=5 AND Diameter<=15";
    $result = mysqli_query($dbc, $VolumeKeruingSQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreeKeruing1 = $row['totalVolume'];
    }
    
    $VolumeDipMarketSQL = "SELECT COUNT(*) AS totalVolume FROM newforestori WHERE spgroup = 3 AND Diameter>=5 AND Diameter<=15";
    $result = mysqli_query($dbc, $VolumeDipMarketSQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreeDipMarket1 = $row['totalVolume'];
    }
    
    $VolumeDipNonMarketSQL = "SELECT COUNT(*) AS totalVolume FROM newforestori WHERE spgroup = 4 AND Diameter>=5 AND Diameter<=15";
    $result = mysqli_query($dbc, $VolumeDipNonMarketSQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreeDipNonMarket1 = $row['totalVolume'];
    }
    
    $VolumeNonDipMarketSQL = "SELECT COUNT(*) AS totalVolume FROM newforestori WHERE spgroup = 5 AND Diameter>=5 AND Diameter<=15";
    $result = mysqli_query($dbc, $VolumeNonDipMarketSQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreeNonDipMarket1 = $row['totalVolume'];
    }
    
    $VolumeNonDipNonMarketSQL = "SELECT COUNT(*) AS totalVolume FROM newforestori WHERE spgroup = 6 AND Diameter>=5 AND Diameter<=15";
    $result = mysqli_query($dbc, $VolumeNonDipNonMarketSQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreeNonDipNonMarket1 = $row['totalVolume'];
    }
    
    $VolumeOthersSQL = "SELECT COUNT(*) AS totalVolume FROM newforestori WHERE spgroup = 7 AND Diameter>=5 AND Diameter<=15";
    $result = mysqli_query($dbc, $VolumeOthersSQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreeOthers1 = $row['totalVolume'];
    }
    
    //Calculate total tree for Category 1
    $totalTreeCategory1 = $totalTreeMersawa1 + $totalTreeKeruing1 + $totalTreeDipMarket1 + $totalTreeDipNonMarket1 + $totalTreeNonDipMarket1 + $totalTreeNonDipNonMarket1 + $totalTreeOthers1;
    
    /*-------------------- Categories 15 - 30 --------------------*/
    
    $CountTreesSpgroup1SQL = "SELECT COUNT(*) AS totalTrees FROM newforestori WHERE spgroup = 1 AND Diameter>=15 AND Diameter<=30";
    $result = mysqli_query($dbc, $CountTreesSpgroup1SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup1 = $row['totalTrees'];
    }
    
    $CountTreesSpgroup2SQL = "SELECT COUNT(*) AS totalTrees FROM newforestori WHERE spgroup = 2 AND Diameter>=15 AND Diameter<=30";
    $result = mysqli_query($dbc, $CountTreesSpgroup2SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup2 = $row['totalTrees'];
    }
    
    $CountTreesSpgroup3SQL = "SELECT COUNT(*) AS totalTrees FROM newforestori WHERE spgroup = 3 AND Diameter>=15 AND Diameter<=30";
    $result = mysqli_query($dbc, $CountTreesSpgroup3SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup3 = $row['totalTrees'];
    }
    
    $CountTreesSpgroup4SQL = "SELECT COUNT(*) AS totalTrees FROM newforestori WHERE spgroup = 4 AND Diameter>=15 AND Diameter<=30";
    $result = mysqli_query($dbc, $CountTreesSpgroup4SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup4 = $row['totalTrees'];
    }
    
    $CountTreesSpgroup5SQL = "SELECT COUNT(*) AS totalTrees FROM newforestori WHERE spgroup = 5 AND Diameter>=15 AND Diameter<=30";
    
    $result = mysqli_query($dbc, $CountTreesSpgroup5SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup5 = $row['totalTrees'];
    }
    
    $CountTreesSpgroup6SQL = "SELECT COUNT(*) AS totalTrees FROM newforestori WHERE spgroup = 6 AND Diameter>=15 AND Diameter<=30";
    
    $result = mysqli_query($dbc, $CountTreesSpgroup6SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup6 = $row['totalTrees'];
    }
    
    $CountTreesSpgroup7SQL = "SELECT COUNT(*) AS totalTrees FROM newforestori WHERE spgroup = 7 AND Diameter>=15 AND Diameter<=30";
    
    $result = mysqli_query($dbc, $CountTreesSpgroup7SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup7 = $row['totalTrees'];
    }
    
    //Calculate total tree for Category 2
    $totalTreeCategory2 = $totalTreesSpgroup1 + $totalTreesSpgroup2 + $totalTreesSpgroup3 + $totalTreesSpgroup4 + $totalTreesSpgroup5 + $totalTreesSpgroup6 + $totalTreesSpgroup7;
    
    
    /*-------------------- Categories 30 - 45 --------------------*/
    $ProductionTreesSpgroup1SQL = "SELECT COUNT(*) AS totalProduction FROM newforestori WHERE spgroup = 1  AND Diameter>=30 AND Diameter<=45";
    
    $result = mysqli_query($dbc, $ProductionTreesSpgroup1SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalProductionSpgroup1 = $row['totalProduction'];
    }
    
    $ProductionTreesSpgroup2SQL = "SELECT COUNT(*) AS totalProduction FROM newforestori WHERE spgroup = 2 AND Diameter>=30 AND Diameter<=45";
    
    $result = mysqli_query($dbc, $ProductionTreesSpgroup2SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalProductionSpgroup2 = $row['totalProduction'];
    }
    
    
    $ProductionTreesSpgroup3SQL = "SELECT COUNT(*) AS totalProduction FROM newforestori WHERE spgroup = 3 AND Diameter>=30 AND Diameter<=45";
    
    $result = mysqli_query($dbc, $ProductionTreesSpgroup3SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalProductionSpgroup3 = $row['totalProduction'];
    }
    
    $ProductionTreesSpgroup4SQL = "SELECT COUNT(*) AS totalProduction FROM newforestori WHERE spgroup = 4 AND Diameter>=30 AND Diameter<=45";
    
    $result = mysqli_query($dbc, $ProductionTreesSpgroup4SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalProductionSpgroup4 = $row['totalProduction'];
    }
    
    $ProductionTreesSpgroup5SQL = "SELECT COUNT(*) AS totalProduction FROM newforestori WHERE spgroup = 5 AND Diameter>=30 AND Diameter<=45";
    
    $result = mysqli_query($dbc, $ProductionTreesSpgroup5SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalProductionSpgroup5 = $row['totalProduction'];
    }
    
    $ProductionTreesSpgroup6SQL = "SELECT COUNT(*) AS totalProduction FROM newforestori WHERE spgroup = 6 AND Diameter>=30 AND Diameter<=45";
    
    $result = mysqli_query($dbc, $ProductionTreesSpgroup6SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalProductionSpgroup6 = $row['totalProduction'];
    }
    
    $ProductionTreesSpgroup7SQL = "SELECT COUNT(*) AS totalProduction FROM newforestori WHERE spgroup = 7 AND Diameter>=30 AND Diameter<=45";
    
    $result = mysqli_query($dbc, $ProductionTreesSpgroup7SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalProductionSpgroup7 = $row['totalProduction'];
    }
    
    //Calculate total tree for Category 3
    $totalTreeCategory3 = $totalProductionSpgroup1 +  $totalProductionSpgroup2 + $totalProductionSpgroup3 + $totalProductionSpgroup4 + $totalProductionSpgroup5 + $totalProductionSpgroup6 + $totalProductionSpgroup7;
    
    /*-------------------- Categories 45 - 60 --------------------*/
    $DamageCrownSpgroup1SQL = "SELECT COUNT(*) AS totalDamageCrown FROM newforestori WHERE spgroup = 1 AND Diameter>=45 AND Diameter<=60";
    
    $result = mysqli_query($dbc, $DamageCrownSpgroup1SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalDamageCrownSpgroup1 = $row['totalDamageCrown'];
    }
    
    $DamageCrownSpgroup2SQL = "SELECT COUNT(*) AS totalDamageCrown FROM newforestori WHERE spgroup = 2 AND Diameter>=45 AND Diameter<=60";
    
    $result = mysqli_query($dbc, $DamageCrownSpgroup2SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalDamageCrownSpgroup2 = $row['totalDamageCrown'];
    }
    
    $DamageCrownSpgroup3SQL = "SELECT COUNT(*) AS totalDamageCrown FROM newforestori WHERE spgroup = 3 AND Diameter>=45 AND Diameter<=60";
    
    $result = mysqli_query($dbc, $DamageCrownSpgroup3SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalDamageCrownSpgroup3 = $row['totalDamageCrown'];
    }
    
    $DamageCrownSpgroup4SQL = "SELECT COUNT(*) AS totalDamageCrown FROM newforestori WHERE spgroup = 4 AND Diameter>=45 AND Diameter<=60";
    
    $result = mysqli_query($dbc, $DamageCrownSpgroup4SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalDamageCrownSpgroup4 = $row['totalDamageCrown'];
    }
    
    $DamageCrownSpgroup5SQL = "SELECT COUNT(*) AS totalDamageCrown FROM newforestori WHERE spgroup = 5 AND Diameter>=45 AND Diameter<=60";
    
    $result = mysqli_query($dbc, $DamageCrownSpgroup5SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalDamageCrownSpgroup5 = $row['totalDamageCrown'];
    }
    
    $DamageCrownSpgroup6SQL = "SELECT COUNT(*) AS totalDamageCrown FROM newforestori WHERE spgroup = 6 AND Diameter>=45 AND Diameter<=60";
    
    $result = mysqli_query($dbc, $DamageCrownSpgroup6SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalDamageCrownSpgroup6 = $row['totalDamageCrown'];
    }
    
    $DamageCrownSpgroup7SQL = "SELECT COUNT(*) AS totalDamageCrown FROM newforestori WHERE spgroup = 7 AND Diameter>=45 AND Diameter<=60";
    
    $result = mysqli_query($dbc, $DamageCrownSpgroup7SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalDamageCrownSpgroup7 = $row['totalDamageCrown'];
    }
    
    //Calculate total tree for Category 4
    $totalTreeCategory4 = $totalDamageCrownSpgroup1 + $totalDamageCrownSpgroup2 + $totalDamageCrownSpgroup3 + $totalDamageCrownSpgroup4 + $totalDamageCrownSpgroup5 + $totalDamageCrownSpgroup6 + $totalDamageCrownSpgroup7;
    
    
    /*-------------------- Categories 60+ --------------------*/
    $DamageStemSpgroup1SQL = "SELECT COUNT(*) AS totalDamageStem FROM newforestori WHERE spgroup = 1 AND Diameter>=60";
    
    $result = mysqli_query($dbc, $DamageStemSpgroup1SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalDamageStemSpgroup1 = $row['totalDamageStem'];
    }
    
    $DamageStemSpgroup2SQL = "SELECT COUNT(*) AS totalDamageStem FROM newforestori WHERE spgroup = 2 AND Diameter>=60";
    
    $result = mysqli_query($dbc, $DamageStemSpgroup2SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalDamageStemSpgroup2 = $row['totalDamageStem'];
    }
    
    $DamageStemSpgroup3SQL = "SELECT COUNT(*) AS totalDamageStem FROM newforestori WHERE spgroup = 3 AND Diameter>=60";
    
    $result = mysqli_query($dbc, $DamageStemSpgroup3SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalDamageStemSpgroup3 = $row['totalDamageStem'];
    }
    
    $DamageStemSpgroup4SQL = "SELECT COUNT(*) AS totalDamageStem FROM newforestori WHERE spgroup = 4 AND Diameter>=60";
    
    $result = mysqli_query($dbc, $DamageStemSpgroup4SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalDamageStemSpgroup4 = $row['totalDamageStem'];
    }
    
    $DamageStemSpgroup5SQL = "SELECT COUNT(*) AS totalDamageStem FROM newforestori WHERE spgroup = 5 AND Diameter>=60";
    
    $result = mysqli_query($dbc, $DamageStemSpgroup5SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalDamageStemSpgroup5 = $row['totalDamageStem'];
    }
    
    $DamageStemSpgroup6SQL = "SELECT COUNT(*) AS totalDamageStem FROM newforestori WHERE spgroup = 6 AND Diameter>=60";
    
    $result = mysqli_query($dbc, $DamageStemSpgroup6SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalDamageStemSpgroup6 = $row['totalDamageStem'];
    }
    
    $DamageStemSpgroup7SQL = "SELECT COUNT(*) AS totalDamageStem FROM newforestori WHERE spgroup = 7 AND Diameter>=60";
    
    $result = mysqli_query($dbc, $DamageStemSpgroup7SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalDamageStemSpgroup7 = $row['totalDamageStem'];
    }
    
    //Calculate total tree for Category 5
    $totalTreeCategory5 = $totalDamageStemSpgroup1 + $totalDamageStemSpgroup2 + $totalDamageStemSpgroup3 + $totalDamageStemSpgroup4 + $totalDamageStemSpgroup5 + $totalDamageStemSpgroup6 + $totalDamageStemSpgroup7;
    
    /*-------------------- Calculate Total Tree For Every Categories --------------------*/
    
    //Calculate total tree Mersawa
    $totalAllTreeMersawa = $totalTreeMersawa1 + $totalTreesSpgroup1 + $totalProductionSpgroup1 + $totalDamageCrownSpgroup1 + $totalDamageStemSpgroup1;
    
    //Calculate total tree Keruing
    $totalAllTreeKeruing = $totalTreeKeruing1 + $totalTreesSpgroup2 + $totalProductionSpgroup2 + $totalDamageCrownSpgroup2 + $totalDamageStemSpgroup2;
    
    //Calculate total tree Dip Marketable
    $totalAllTreeDipMarket = $totalTreeDipMarket1 + $totalTreesSpgroup3 + $totalProductionSpgroup3 + $totalDamageCrownSpgroup3 + $totalDamageStemSpgroup3;
    
    //Calculate total tree Dip non Market
    $totalAllTreeDipNonMarket = $totalTreeDipNonMarket1 + $totalTreesSpgroup4 + $totalProductionSpgroup4 + $totalDamageCrownSpgroup4 + $totalDamageStemSpgroup4;
    
    //Calculate total tree Non Dip Market
    $totalAllTreeNonDipMarket = $totalTreeNonDipMarket1 + $totalTreesSpgroup5 + $totalProductionSpgroup5 + $totalDamageCrownSpgroup5 + $totalDamageStemSpgroup5;
    
    //Calculate total tree Non Dip Non Market
    $totalAllTreeNonDipNonMarket = $totalTreeNonDipNonMarket1 + $totalTreesSpgroup6 + $totalProductionSpgroup6 + $totalDamageCrownSpgroup6 + $totalDamageStemSpgroup6;
    
    //Calculate total tree Others
    $totalAllTreeOthers = $totalTreeOthers1 + $totalTreesSpgroup7 + $totalProductionSpgroup7 + $totalDamageCrownSpgroup7 + $totalDamageStemSpgroup7;
    
    //Total all tree
    $totalAllTree = $totalTreeCategory1 + $totalTreeCategory2 + $totalTreeCategory3 + $totalTreeCategory4 + $totalTreeCategory5;
    

    ?>
</head>
<body>
    <div class="container">
        <header>
            <h1>Stand Table</h1>
        </header>
        <main>
        <table border="1" width="100%">
        <tr>
            <th>
                Species Group
            </th>
            <th>
                Species Name
            </th>
            <th>
                5 - 15
            </th>
            <th>
                15 - 30
            </th>
            <th>
                30 - 45 
            </th>
            <th>
                45 - 60
            </th>
            <th>
                60+
            </th>
            <th>
                Total
            </th>
        </tr>

        <tr>
            <td> Mersawa </td>
            <td> Group 1 </td>
            <td> <?php echo $totalTreeMersawa1; ?> </td>
            <td> <?php echo $totalTreesSpgroup1; ?> </td>
            <td> <?php echo $totalProductionSpgroup1; ?> </td>
            <td> <?php echo $totalDamageCrownSpgroup1; ?> </td>
            <td> <?php echo $totalDamageStemSpgroup1; ?> </td>
            <td> <?php echo $totalAllTreeMersawa; ?> </td>
        </tr>

        <tr>
            <td> Keruing </td>
            <td> Group 2 </td>
            <td> <?php echo $totalTreeKeruing1; ?> </td>
            <td> <?php echo $totalTreesSpgroup2; ?> </td>
            <td> <?php echo $totalProductionSpgroup2; ?> </td>
            <td> <?php echo $totalDamageCrownSpgroup2; ?> </td>
            <td> <?php echo $totalDamageStemSpgroup2; ?> </td>
            <td> <?php echo $totalAllTreeKeruing; ?> </td>
        </tr>
        <tr>
            <td> Dip Marketable </td>
            <td> Group 3 </td>
            <td> <?php echo $totalTreeDipMarket1; ?> </td>
            <td> <?php echo $totalTreesSpgroup3; ?> </td>
            <td> <?php echo $totalProductionSpgroup3; ?> </td>
            <td> <?php echo $totalDamageCrownSpgroup3; ?> </td>
            <td> <?php echo $totalDamageStemSpgroup3; ?> </td>
            <td> <?php echo $totalAllTreeDipMarket; ?> </td>
        </tr>
        <tr>
            <td> Dip non Market </td>
            <td> Group 4 </td>
            <td> <?php echo $totalTreeDipNonMarket1; ?> </td>
            <td> <?php echo $totalTreesSpgroup4; ?> </td>
            <td> <?php echo $totalProductionSpgroup4; ?> </td>
            <td> <?php echo $totalDamageCrownSpgroup4; ?> </td>
            <td> <?php echo $totalDamageStemSpgroup4; ?> </td>
            <td> <?php echo $totalAllTreeDipNonMarket; ?> </td>
        </tr>
        <tr>
            <td> Non Dip Market </td>
            <td> Group 5 </td>
            <td> <?php echo $totalTreeNonDipMarket1; ?> </td>
            <td> <?php echo $totalTreesSpgroup5; ?> </td>
            <td> <?php echo $totalProductionSpgroup5; ?> </td>
            <td> <?php echo $totalDamageCrownSpgroup5; ?> </td>
            <td> <?php echo $totalDamageStemSpgroup5; ?> </td>
            <td> <?php echo $totalAllTreeNonDipMarket; ?> </td>
        </tr>
        <tr>
            <td> Non Dip Non Market </td>
            <td> Group 6 </td>
            <td> <?php echo $totalTreeNonDipNonMarket1; ?> </td>
            <td> <?php echo $totalTreesSpgroup6; ?> </td>
            <td> <?php echo $totalProductionSpgroup6; ?> </td>
            <td> <?php echo $totalDamageCrownSpgroup6; ?> </td>
            <td> <?php echo $totalDamageStemSpgroup6; ?> </td>
            <td> <?php echo $totalAllTreeNonDipNonMarket; ?> </td>
        </tr>
        <tr>
            <td> Others </td>
            <td> Group 7 </td>
            <td> <?php echo $totalTreeOthers1; ?> </td>
            <td> <?php echo $totalTreesSpgroup7; ?> </td>
            <td> <?php echo $totalProductionSpgroup7; ?> </td>
            <td> <?php echo $totalDamageCrownSpgroup7; ?> </td>
            <td> <?php echo $totalDamageStemSpgroup7; ?> </td>
            <td> <?php echo $totalAllTreeOthers; ?> </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td> <?php echo $totalTreeCategory1; ?> </td>
            <td> <?php echo $totalTreeCategory2; ?> </td>
            <td> <?php echo $totalTreeCategory3; ?> </td>
            <td> <?php echo $totalTreeCategory4; ?> </td>
            <td> <?php echo $totalTreeCategory5; ?> </td>
            <td> <?php echo $totalAllTree; ?> </td>
        </tr>
    </table>
        </main>
    </div>
</body>
</html>
