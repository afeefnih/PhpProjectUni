<?php include '../forest/header.html';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stand Table</title>
    

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
    <link rel="stylesheet" href="../forest/styles.css">
</head>
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
    $VolumeMersawaSQL = "SELECT COUNT(*) AS totaltress, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 1 AND Diameter>=5 AND Diameter<=15 AND blockX = 1 AND blockY = 1";
    $result = mysqli_query($dbc, $VolumeMersawaSQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreeMersawa1 = $row['totaltress'];
        $totalVolumeMersawa1 = $row['totalVolume'];
    }
    
    $VolumeKeruingSQL = "SELECT COUNT(*) AS totaltress, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 2 AND Diameter>=5 AND Diameter<=15 AND blockX = 1 AND blockY = 1";
    $result = mysqli_query($dbc, $VolumeKeruingSQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreeKeruing1 = $row['totaltress'];
        $totalVolumeKeruing1 = $row['totalVolume'];
    }
    
    $VolumeDipMarketSQL = "SELECT COUNT(*) AS totaltress,SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 3 AND Diameter>=5 AND Diameter<=15 AND blockX = 1 AND blockY = 1";
    $result = mysqli_query($dbc, $VolumeDipMarketSQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreeDipMarket1 = $row['totaltress'];
        $totalVolumeDipMarket1 = $row['totalVolume'];
    }
    
    $VolumeDipNonMarketSQL = "SELECT COUNT(*) AS totaltress ,SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 4 AND Diameter>=5 AND Diameter<=15 AND blockX = 1 AND blockY = 1";
    $result = mysqli_query($dbc, $VolumeDipNonMarketSQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreeDipNonMarket1 = $row['totaltress'];
        $totalVolumeDipNonMarket1 = $row['totalVolume'];
    }
    
    $VolumeNonDipMarketSQL = "SELECT COUNT(*) AS totaltress ,SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 5 AND Diameter>=5 AND Diameter<=15 AND blockX = 1 AND blockY = 1";
    $result = mysqli_query($dbc, $VolumeNonDipMarketSQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreeNonDipMarket1 = $row['totaltress'];
        $totalVolumeNonDipMarket1 = $row['totalVolume'];
    }
    
    $VolumeNonDipNonMarketSQL = "SELECT COUNT(*) AS totaltress ,SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 6 AND Diameter>=5 AND Diameter<=15 AND blockX = 1 AND blockY = 1";
    $result = mysqli_query($dbc, $VolumeNonDipNonMarketSQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreeNonDipNonMarket1 = $row['totaltress'];
        $totalVolumeNonDipNonMarket1 = $row['totalVolume'];
    }
    
    $VolumeOthersSQL = "SELECT COUNT(*) AS totaltress ,SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 7 AND Diameter>=5 AND Diameter<=15 AND blockX = 1 AND blockY = 1";
    $result = mysqli_query($dbc, $VolumeOthersSQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreeOthers1 = $row['totaltress'];
        $totalVolumeOthers1 = $row['totalVolume'];
    }
    
    //Calculate total tree for Category 1
    $totalTreeCategory1 = $totalTreeMersawa1 + $totalTreeKeruing1 + $totalTreeDipMarket1 + $totalTreeDipNonMarket1 + $totalTreeNonDipMarket1 + $totalTreeNonDipNonMarket1 + $totalTreeOthers1;
    
    /*-------------------- Categories 15 - 30 --------------------*/
    
    $CountTreesSpgroup1SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 1 AND Diameter>=15 AND Diameter<=30 AND blockX = 1 AND blockY = 1";
    $result = mysqli_query($dbc, $CountTreesSpgroup1SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup1 = $row['totalTrees'];
        $totalVolume1530Spgroup1 = $row['totalVolume'];
    }
    
    $CountTreesSpgroup2SQL = "SELECT COUNT(*) AS totalTrees,SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 2 AND Diameter>=15 AND Diameter<=30 AND blockX = 1 AND blockY = 1";
    $result = mysqli_query($dbc, $CountTreesSpgroup2SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup2 = $row['totalTrees'];
        $totalVolume1530Spgroup2 = $row['totalVolume'];

    }
    
    $CountTreesSpgroup3SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 3 AND Diameter>=15 AND Diameter<=30 AND blockX = 1 AND blockY = 1";
    $result = mysqli_query($dbc, $CountTreesSpgroup3SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup3 = $row['totalTrees'];
        $totalVolume1530Spgroup3 = $row['totalVolume'];
    }
    
    $CountTreesSpgroup4SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 4 AND Diameter>=15 AND Diameter<=30 AND blockX = 1 AND blockY = 1";
    $result = mysqli_query($dbc, $CountTreesSpgroup4SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup4 = $row['totalTrees'];
        $totalVolume1530Spgroup4 = $row['totalVolume'];
    }
    
    $CountTreesSpgroup5SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 5 AND Diameter>=15 AND Diameter<=30 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $CountTreesSpgroup5SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup5 = $row['totalTrees'];
        $totalVolume1530Spgroup5 = $row['totalVolume'];
    }
    
    $CountTreesSpgroup6SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 6 AND Diameter>=15 AND Diameter<=30 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $CountTreesSpgroup6SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup6 = $row['totalTrees'];
        $totalVolume1530Spgroup6 = $row['totalVolume'];
    }
    
    $CountTreesSpgroup7SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 7 AND Diameter>=15 AND Diameter<=30 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $CountTreesSpgroup7SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup7 = $row['totalTrees'];
        $totalVolume1530Spgroup7 = $row['totalVolume'];
    }
    
    //Calculate total tree for Category 2
    $totalTreeCategory2 = $totalTreesSpgroup1 + $totalTreesSpgroup2 + $totalTreesSpgroup3 + $totalTreesSpgroup4 + $totalTreesSpgroup5 + $totalTreesSpgroup6 + $totalTreesSpgroup7;
    
    
    /*-------------------- Categories 30 - 45 --------------------*/
    $ProductionTreesSpgroup1SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 1  AND Diameter>=30 AND Diameter<=45 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $ProductionTreesSpgroup1SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup1 = $row['totalTrees'];
        $totalVolume3045Spgroup1 = $row['totalVolume'];
    }
    
    $ProductionTreesSpgroup2SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 2 AND Diameter>=30 AND Diameter<=45 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $ProductionTreesSpgroup2SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup2 = $row['totalTrees'];
        $totalVolume3045Spgroup2 = $row['totalVolume'];
    }
    
    
    $ProductionTreesSpgroup3SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 3 AND Diameter>=30 AND Diameter<=45 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $ProductionTreesSpgroup3SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup3 = $row['totalTrees'];
        $totalVolume3045Spgroup3 = $row['totalVolume'];
    }
    
    $ProductionTreesSpgroup4SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 4 AND Diameter>=30 AND Diameter<=45 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $ProductionTreesSpgroup4SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup4 = $row['totalTrees'];
        $totalVolume3045Spgroup4 = $row['totalVolume'];
    }
    
    $ProductionTreesSpgroup5SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 5 AND Diameter>=30 AND Diameter<=45 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $ProductionTreesSpgroup5SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup5 = $row['totalTrees'];
        $totalVolume3045Spgroup5 = $row['totalVolume'];
    }
    
    $ProductionTreesSpgroup6SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 6 AND Diameter>=30 AND Diameter<=45 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $ProductionTreesSpgroup6SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup6 = $row['totalTrees'];
        $totalVolume3045Spgroup6 = $row['totalVolume'];
    }
    
    $ProductionTreesSpgroup7SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 7 AND Diameter>=30 AND Diameter<=45 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $ProductionTreesSpgroup7SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup7 = $row['totalTrees'];
        $totalVolume3045Spgroup7 = $row['totalVolume'];
    }
    
    //Calculate total tree for Category 3
    $totalTreeCategory3 = $totalTreesSpgroup1 +  $totalTreesSpgroup2 + $totalTreesSpgroup3 + $totalTreesSpgroup4 + $totalTreesSpgroup5 + $totalTreesSpgroup6 + $totalTreesSpgroup7;
    
    /*-------------------- Categories 45 - 60 --------------------*/
    $DamageCrownSpgroup1SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 1 AND Diameter>=45 AND Diameter<=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageCrownSpgroup1SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup1 = $row['totalTrees'];
        $totalVolume4560Spgroup1 = $row['totalVolume'];
    }
    
    $DamageCrownSpgroup2SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 2 AND Diameter>=45 AND Diameter<=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageCrownSpgroup2SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup2 = $row['totalTrees'];
        $totalVolume4560Spgroup2 = $row['totalVolume'];
    }
    
    $DamageCrownSpgroup3SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 3 AND Diameter>=45 AND Diameter<=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageCrownSpgroup3SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup3 = $row['totalTrees'];
        $totalVolume4560Spgroup3 = $row['totalVolume'];
    }
    
    $DamageCrownSpgroup4SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 4 AND Diameter>=45 AND Diameter<=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageCrownSpgroup4SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup4 = $row['totalTrees'];
        $totalVolume4560Spgroup4 = $row['totalVolume'];
    }
    
    $DamageCrownSpgroup5SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 5 AND Diameter>=45 AND Diameter<=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageCrownSpgroup5SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup5 = $row['totalTrees'];
        $totalVolume4560Spgroup5 = $row['totalVolume'];
    }
    
    $DamageCrownSpgroup6SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 6 AND Diameter>=45 AND Diameter<=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageCrownSpgroup6SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup6 = $row['totalTrees'];
        $totalVolume4560Spgroup6 = $row['totalVolume'];
    }
    
    $DamageCrownSpgroup7SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 7 AND Diameter>=45 AND Diameter<=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageCrownSpgroup7SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup7 = $row['totalTrees'];
        $totalVolume4560Spgroup7 = $row['totalVolume'];
    }
    
    //Calculate total tree for Category 4
    $totalTreeCategory4 = $totalTreesSpgroup1 + $totalTreesSpgroup2 + $totalTreesSpgroup3 + $totalTreesSpgroup4 + $totalTreesSpgroup5 + $totalTreesSpgroup6 + $totalTreesSpgroup7;
    
    
    /*-------------------- Categories 60+ --------------------*/
    $DamageStemSpgroup1SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 1 AND Diameter>=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageStemSpgroup1SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup1 = $row['totalTrees'];
        $totalVolume60Spgroup1 = $row['totalVolume'];
    }
    
    $DamageStemSpgroup2SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 2 AND Diameter>=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageStemSpgroup2SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup2 = $row['totalTrees'];
        $totalVolume60Spgroup2 = $row['totalVolume'];
    }
    
    $DamageStemSpgroup3SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 3 AND Diameter>=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageStemSpgroup3SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup3 = $row['totalTrees'];
        $totalVolume60Spgroup3 = $row['totalVolume'];
    }
    
    $DamageStemSpgroup4SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 4 AND Diameter>=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageStemSpgroup4SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup4 = $row['totalTrees'];
        $totalVolume60Spgroup4 = $row['totalVolume'];
    }
    
    $DamageStemSpgroup5SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 5 AND Diameter>=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageStemSpgroup5SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup5 = $row['totalTrees'];
        $totalVolume60Spgroup5 = $row['totalVolume'];
    }
    
    $DamageStemSpgroup6SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 6 AND Diameter>=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageStemSpgroup6SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup6 = $row['totalTrees'];
        $totalVolume60Spgroup6 = $row['totalVolume'];
    }
    
    $DamageStemSpgroup7SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 7 AND Diameter>=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageStemSpgroup7SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup7 = $row['totalTrees'];
        $totalVolume60Spgroup7 = $row['totalVolume'];
    }
    
    //Calculate total tree for Category 5
    $totalTreeCategory5 = $totalTreesSpgroup1 + $totalTreesSpgroup2 + $totalTreesSpgroup3 + $totalTreesSpgroup4 + $totalTreesSpgroup5 + $totalTreesSpgroup6 + $totalTreesSpgroup7;
    
    /*-------------------- Calculate Total Tree For Every Categories --------------------*/
    
    //Calculate total tree Mersawa
    $totalAllTreeMersawa = $totalTreeMersawa1 + $totalTreesSpgroup1 + $totalTreesSpgroup1 + $totalTreesSpgroup1 + $totalTreesSpgroup1;
    
    //Calculate total tree Keruing
    $totalAllTreeKeruing = $totalTreeKeruing1 + $totalTreesSpgroup2 + $totalTreesSpgroup2 + $totalTreesSpgroup2 + $totalTreesSpgroup2;
    
    //Calculate total tree Dip Marketable
    $totalAllTreeDipMarket = $totalTreeDipMarket1 + $totalTreesSpgroup3 + $totalTreesSpgroup3 + $totalTreesSpgroup3 + $totalTreesSpgroup3;
    
    //Calculate total tree Dip non Market
    $totalAllTreeDipNonMarket = $totalTreeDipNonMarket1 + $totalTreesSpgroup4 + $totalTreesSpgroup4 + $totalTreesSpgroup4 + $totalTreesSpgroup4;
    
    //Calculate total tree Non Dip Market
    $totalAllTreeNonDipMarket = $totalTreeNonDipMarket1 + $totalTreesSpgroup5 + $totalTreesSpgroup5 + $totalTreesSpgroup5 + $totalTreesSpgroup5;
    
    //Calculate total tree Non Dip Non Market
    $totalAllTreeNonDipNonMarket = $totalTreeNonDipNonMarket1 + $totalTreesSpgroup6 + $totalTreesSpgroup6 + $totalTreesSpgroup6 + $totalTreesSpgroup6;
    
    //Calculate total tree Others
    $totalAllTreeOthers = $totalTreeOthers1 + $totalTreesSpgroup7 + $totalTreesSpgroup7 + $totalTreesSpgroup7 + $totalTreesSpgroup7;
    
    //Total all tree
    $totalAllTree = $totalTreeCategory1 + $totalTreeCategory2 + $totalTreeCategory3 + $totalTreeCategory4 + $totalTreeCategory5;
    
    // total volume for group1 
    $totalVolumeGroup1 = $totalVolumeMersawa1 + $totalVolume1530Spgroup1 + $totalVolume3045Spgroup1 + $totalVolume4560Spgroup1 + $totalVolume60Spgroup1;

    // total volume for group2
    $totalVolumeGroup2 = $totalVolumeKeruing1 + $totalVolume1530Spgroup2 + $totalVolume3045Spgroup2 + $totalVolume4560Spgroup2 + $totalVolume60Spgroup2;

    // total volume for group3
    $totalVolumeGroup3 = $totalVolumeDipMarket1 + $totalVolume1530Spgroup3 + $totalVolume3045Spgroup3 + $totalVolume4560Spgroup3 + $totalVolume60Spgroup3;

    // total volume for group4
    $totalVolumeGroup4 = $totalVolumeDipNonMarket1 + $totalVolume1530Spgroup4 + $totalVolume3045Spgroup4 + $totalVolume4560Spgroup4 + $totalVolume60Spgroup4;

    // total volume for group5
    $totalVolumeGroup5 = $totalVolumeNonDipMarket1 + $totalVolume1530Spgroup5 + $totalVolume3045Spgroup5 + $totalVolume4560Spgroup5 + $totalVolume60Spgroup5;

    // total volume for group6
    $totalVolumeGroup6 = $totalVolumeNonDipNonMarket1 + $totalVolume1530Spgroup6 + $totalVolume3045Spgroup6 + $totalVolume4560Spgroup6 + $totalVolume60Spgroup6;

    // total volume for group7
    $totalVolumeGroup7 = $totalVolumeOthers1 + $totalVolume1530Spgroup7 + $totalVolume3045Spgroup7 + $totalVolume4560Spgroup7 + $totalVolume60Spgroup7;

    ?>
</head>
<body>
    <div class="container">
        <header>
            <h1>Stand Table 45</h1>
        </header>
        <main>
        <table border="1" width="100%">
        <tr>
            <th>
                Species Name
            </th>
            <th>
                Species Group
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
            <td> <?php echo $totalTreesSpgroup1; ?> </td>
            <td> <?php echo $totalTreesSpgroup1; ?> </td>
            <td> <?php echo $totalTreesSpgroup1; ?> </td>
            <td> <?php echo $totalAllTreeMersawa; ?> </td>
        </tr>

        <tr>
            <td>Volume Group 1</td>
            <td ></td>
            <td> <?php echo number_format($totalVolumeMersawa1,2); ?> </td>
            <td><?php echo number_format($totalVolume1530Spgroup1,2);?> </td>
            <td><?php echo number_format($totalVolume3045Spgroup1,2);?> </td>
            <td><?php echo number_format($totalVolume4560Spgroup1,2);?> </td>
            <td><?php echo number_format($totalVolume60Spgroup1,2);?> </td>
            <td>  <?php echo number_format($totalVolumeGroup1,2);?> </td>
        
        </tr>

        <tr>
            <td> Keruing </td>
            <td> Group 2 </td>
            <td> <?php echo $totalTreeKeruing1; ?> </td>
            <td> <?php echo $totalTreesSpgroup2; ?> </td>
            <td> <?php echo $totalTreesSpgroup2; ?> </td>
            <td> <?php echo $totalTreesSpgroup2; ?> </td>
            <td> <?php echo $totalTreesSpgroup2; ?> </td>
            <td> <?php echo $totalAllTreeKeruing; ?> </td>
        </tr>
        <tr>
            <td>Volume Group 2</td>
            <td ></td>
        
            <td> <?php echo number_format($totalVolumeKeruing1,2); ?> </td>
            <td> <?php echo number_format($totalVolume1530Spgroup2,2); ?> </td>
            <td> <?php echo number_format($totalVolume3045Spgroup2,2); ?> </td>
            <td> <?php echo number_format($totalVolume4560Spgroup2,2); ?> </td>
            <td> <?php echo number_format($totalVolume60Spgroup2,2); ?> </td>
            <td> <?php echo number_format($totalVolumeGroup2,2); ?> </td>

           
        </tr>
        <tr>
            <td> Dip Marketable </td>
            <td> Group 3 </td>
            <td> <?php echo $totalTreeDipMarket1; ?> </td>
            <td> <?php echo $totalTreesSpgroup3; ?> </td>
            <td> <?php echo $totalTreesSpgroup3; ?> </td>
            <td> <?php echo $totalTreesSpgroup3; ?> </td>
            <td> <?php echo $totalTreesSpgroup3; ?> </td>
            <td> <?php echo $totalAllTreeDipMarket; ?> </td>
        </tr>
        <tr>
            <td>Volume Group 3</td>
            <td ></td>
           
            <td> <?php echo number_format($totalVolumeDipMarket1,2); ?> </td>
            <td> <?php echo number_format($totalVolume1530Spgroup3,2); ?> </td>
            <td> <?php echo number_format($totalVolume3045Spgroup3,2); ?> </td>
            <td> <?php echo number_format($totalVolume4560Spgroup3,2); ?> </td>
            <td> <?php echo number_format($totalVolume60Spgroup3,2); ?> </td>
            <td> <?php echo number_format($totalVolumeGroup3,2); ?> </td>
            
        </tr>
        <tr>
            <td> Dip non Market </td>
            <td> Group 4 </td>
            <td> <?php echo $totalTreeDipNonMarket1; ?> </td>
            <td> <?php echo $totalTreesSpgroup4; ?> </td>
            <td> <?php echo $totalTreesSpgroup4; ?> </td>
            <td> <?php echo $totalTreesSpgroup4; ?> </td>
            <td> <?php echo $totalTreesSpgroup4; ?> </td>
            <td> <?php echo $totalAllTreeDipNonMarket; ?> </td>
        </tr>
        <tr>
            <td>Volume Group 4</td>
            <td ></td>
            
            <td> <?php echo number_format($totalVolumeDipNonMarket1,2); ?> </td>
            <td> <?php echo number_format($totalVolume1530Spgroup4,2); ?> </td>
            <td> <?php echo number_format($totalVolume3045Spgroup4,2); ?> </td>
            <td> <?php echo number_format($totalVolume4560Spgroup4,2); ?> </td>
            <td> <?php echo number_format($totalVolume60Spgroup4,2); ?> </td>
            <td> <?php echo number_format($totalVolumeGroup4,2); ?> </td>

            
            
        </tr>
        <tr>
            <td> Non Dip Market </td>
            <td> Group 5 </td>
            <td> <?php echo $totalTreeNonDipMarket1; ?> </td>
            <td> <?php echo $totalTreesSpgroup5; ?> </td>
            <td> <?php echo $totalTreesSpgroup5; ?> </td>
            <td> <?php echo $totalTreesSpgroup5; ?> </td>
            <td> <?php echo $totalTreesSpgroup5; ?> </td>
            <td> <?php echo $totalAllTreeNonDipMarket; ?> </td>
        </tr>
        <tr>
            <td>Volume Group 5</td>
            <td ></td>
           
            <td> <?php echo number_format($totalVolumeNonDipMarket1,2); ?> </td>
            <td> <?php echo number_format($totalVolume1530Spgroup5,2); ?> </td>
            <td> <?php echo number_format($totalVolume3045Spgroup5,2); ?> </td>
            <td> <?php echo number_format($totalVolume4560Spgroup5,2); ?> </td>
            <td> <?php echo number_format($totalVolume60Spgroup5,2); ?> </td>
            <td> <?php echo number_format($totalVolumeGroup5,2); ?> </td>
           
        </tr>
        <tr>
            <td> Non Dip Non Market </td>
            <td> Group 6 </td>
            <td> <?php echo $totalTreeNonDipNonMarket1; ?> </td>
            <td> <?php echo $totalTreesSpgroup6; ?> </td>
            <td> <?php echo $totalTreesSpgroup6; ?> </td>
            <td> <?php echo $totalTreesSpgroup6; ?> </td>
            <td> <?php echo $totalTreesSpgroup6; ?> </td>
            <td> <?php echo $totalAllTreeNonDipNonMarket; ?> </td>
        </tr>

        <tr></tr>
            <td>Volume Group 6</td>
            <td ></td>
            
            <td> <?php echo number_format( $totalVolumeNonDipNonMarket1, 2); ?> </td>
            <td> <?php echo number_format($totalVolume1530Spgroup6, 2); ?> </td>
            <td> <?php echo number_format($totalVolume3045Spgroup6, 2); ?> </td>
            <td> <?php echo number_format($totalVolume4560Spgroup6, 2); ?> </td>
            <td> <?php echo number_format($totalVolume60Spgroup6, 2); ?> </td>
            <td> <?php echo number_format($totalVolumeGroup6, 2); ?> </td>
            

        
        <tr>
            <td> Others </td>
            <td> Group 7 </td>
            <td> <?php echo $totalTreeOthers1; ?> </td>
            <td> <?php echo $totalTreesSpgroup7; ?> </td>
            <td> <?php echo $totalTreesSpgroup7; ?> </td>
            <td> <?php echo $totalTreesSpgroup7; ?> </td>
            <td> <?php echo $totalTreesSpgroup7; ?> </td>
            <td> <?php echo $totalAllTreeOthers; ?> </td>
        </tr>

        <tr>
            <td>Volume Group 7</td>
            <td ></td>
            
            <td> <?php echo number_format( $totalVolumeOthers1,2); ?> </td>
            <td> <?php echo number_format($totalVolume1530Spgroup7,2); ?> </td>
            <td> <?php echo number_format($totalVolume3045Spgroup7,2); ?> </td>
            <td> <?php echo number_format($totalVolume4560Spgroup7,2); ?> </td>
            <td> <?php echo number_format($totalVolume60Spgroup7,2); ?> </td>
            <td> <?php echo number_format($totalVolumeGroup7,2); ?> </td>
            
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
