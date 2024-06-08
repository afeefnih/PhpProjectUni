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
    $VolumeMersawaSQL = "SELECT COUNT(*) AS totaltress, SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 1 AND Diameter>=5 AND Diameter<=15 AND blockX = 1 AND blockY = 1";
    $result = mysqli_query($dbc, $VolumeMersawaSQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreeMersawa1 = $row['totaltress'];
        $totalVolumeMersawa1 = $row['totalVolume'];
    }
    
    $VolumeKeruingSQL = "SELECT COUNT(*) AS totaltress, SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 2 AND Diameter>=5 AND Diameter<=15 AND blockX = 1 AND blockY = 1";
    $result = mysqli_query($dbc, $VolumeKeruingSQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreeKeruing1 = $row['totaltress'];
        $totalVolumeKeruing1 = $row['totalVolume'];
    }
    
    $VolumeDipMarketSQL = "SELECT COUNT(*) AS totaltress,SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 3 AND Diameter>=5 AND Diameter<=15 AND blockX = 1 AND blockY = 1";
    $result = mysqli_query($dbc, $VolumeDipMarketSQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreeDipMarket1 = $row['totaltress'];
        $totalVolumeDipMarket1 = $row['totalVolume'];
    }
    
    $VolumeDipNonMarketSQL = "SELECT COUNT(*) AS totaltress ,SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 4 AND Diameter>=5 AND Diameter<=15 AND blockX = 1 AND blockY = 1";
    $result = mysqli_query($dbc, $VolumeDipNonMarketSQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreeDipNonMarket1 = $row['totaltress'];
        $totalVolumeDipNonMarket1 = $row['totalVolume'];
    }
    
    $VolumeNonDipMarketSQL = "SELECT COUNT(*) AS totaltress ,SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 5 AND Diameter>=5 AND Diameter<=15 AND blockX = 1 AND blockY = 1";
    $result = mysqli_query($dbc, $VolumeNonDipMarketSQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreeNonDipMarket1 = $row['totaltress'];
        $totalVolumeNonDipMarket1 = $row['totalVolume'];
    }
    
    $VolumeNonDipNonMarketSQL = "SELECT COUNT(*) AS totaltress ,SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 6 AND Diameter>=5 AND Diameter<=15 AND blockX = 1 AND blockY = 1";
    $result = mysqli_query($dbc, $VolumeNonDipNonMarketSQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreeNonDipNonMarket1 = $row['totaltress'];
        $totalVolumeNonDipNonMarket1 = $row['totalVolume'];
    }
    
    $VolumeOthersSQL = "SELECT COUNT(*) AS totaltress ,SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 7 AND Diameter>=5 AND Diameter<=15 AND blockX = 1 AND blockY = 1";
    $result = mysqli_query($dbc, $VolumeOthersSQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreeOthers1 = $row['totaltress'];
        $totalVolumeOthers1 = $row['totalVolume'];
    }
    
    //Calculate total tree for Category 1
    $totalTreeCategory1 = $totalTreeMersawa1 + $totalTreeKeruing1 + $totalTreeDipMarket1 + $totalTreeDipNonMarket1 + $totalTreeNonDipMarket1 + $totalTreeNonDipNonMarket1 + $totalTreeOthers1;

    /*-------------------- method to calculate production volume Diameter >= 5 AND Diameter <= 15 --------------------*/
    function calculateProductionVolume($dbc, $group) {
        $query = "SELECT SUM(volume) AS totalVolume FROM regime55 
                  WHERE status_tree = 'cut' AND spgroup = $group 
                  AND Diameter >= 5 AND Diameter <= 15 
                  AND blockX = 1 AND blockY = 1";
        $result = mysqli_query($dbc, $query);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['totalVolume'];
        } else {
            return 0;
        }
    }
    
    $totalProductionVolumeGroup1 = calculateProductionVolume($dbc, 1);
    $totalProductionVolumeGroup2 = calculateProductionVolume($dbc, 2);
    $totalProductionVolumeGroup3 = calculateProductionVolume($dbc, 3);
    $totalProductionVolumeGroup4 = calculateProductionVolume($dbc, 4);
    $totalProductionVolumeGroup5 = calculateProductionVolume($dbc, 5);
    $totalProductionVolumeGroup6 = calculateProductionVolume($dbc, 6);
    $totalProductionVolumeGroup7 = calculateProductionVolume($dbc, 7);

    /*-------------------- method to calculate Total Damage(Damage Crown + Stem) Diameter >= 5 AND Diameter <= 15 --------------------*/
    function calculatTotalDamage515($dbc, $group) {
        $query = "SELECT SUM(damage_crown) AS totalDamageCrown, SUM(damage_stem) AS totalDamageStem FROM regime55 
                    WHERE spgroup = $group 
                    AND DiameterClass = 1
                    AND blockX = 1 AND blockY = 1";
        $result = mysqli_query($dbc, $query);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalDamage = $row['totalDamageCrown'] + $row['totalDamageStem'];
            return $totalDamage;
        } else {
            return 0;
        }
    }
    
    $totalDamage515Group1 = calculatTotalDamage515($dbc, 1);
    $totalDamage515Group2 = calculatTotalDamage515($dbc, 2);
    $totalDamage515Group3 = calculatTotalDamage515($dbc, 3);
    $totalDamage515Group4 = calculatTotalDamage515($dbc, 4);
    $totalDamage515Group5 = calculatTotalDamage515($dbc, 5);
    $totalDamage515Group6 = calculatTotalDamage515($dbc, 6);
    $totalDamage515Group7 = calculatTotalDamage515($dbc, 7);

    /*-------------------- method to calculate Growth30 volume AND ND Diameter30 >= 5 AND Diameter30 <= 15 --------------------*/
    function calculateGrowth30Volume515($dbc, $group) {
        $query = "SELECT SUM(Growth30) AS totalVolume FROM regime55 
                  WHERE spgroup = $group 
                  AND Diameter30 >= 5 AND Diameter30 <= 15 
                  AND blockX = 1 AND blockY = 1";
        $result = mysqli_query($dbc, $query);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['totalVolume'];
        } else {
            return 0;
        }
    }
    
    $totalGrowth30Volume515Group1 = calculateGrowth30Volume515($dbc, 1);
    $totalGrowth30Volume515Group2 = calculateGrowth30Volume515($dbc, 2);
    $totalGrowth30Volume515Group3 = calculateGrowth30Volume515($dbc, 3);
    $totalGrowth30Volume515Group4 = calculateGrowth30Volume515($dbc, 4);
    $totalGrowth30Volume515Group5 = calculateGrowth30Volume515($dbc, 5);
    $totalGrowth30Volume515Group6 = calculateGrowth30Volume515($dbc, 6);
    $totalGrowth30Volume515Group7 = calculateGrowth30Volume515($dbc, 7);

    /*-------------------- method to calculate Production30 volume AND ND Diameter30 >= 5 AND Diameter30 <= 15 --------------------*/
    function calculateProduction30Volume530($dbc, $group) {
        $query = "SELECT SUM(Production30) AS totalVolume FROM regime55 
                  WHERE spgroup = $group 
                  AND Diameter30 <= 5 AND Diameter30 >= 15 
                  AND blockX = 1 AND blockY = 1";
        $result = mysqli_query($dbc, $query);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['totalVolume'];
        } else {
            return 0;
        }
    }
    
    $totalProduction30Volume515Group1 = calculateProduction30Volume530($dbc, 1);
    $totalProduction30Volume515Group2 = calculateProduction30Volume530($dbc, 2);
    $totalProduction30Volume515Group3 = calculateProduction30Volume530($dbc, 3);
    $totalProduction30Volume515Group4 = calculateProduction30Volume530($dbc, 4);
    $totalProduction30Volume515Group5 = calculateProduction30Volume530($dbc, 5);
    $totalProduction30Volume515Group6 = calculateProduction30Volume530($dbc, 6);
    $totalProduction30Volume515Group7 = calculateProduction30Volume530($dbc, 7);
    


    /*-------------------- Categories 15 - 30 --------------------*/
    
    $CountTreesSpgroup1SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 1 AND Diameter>=15 AND Diameter<=30 AND blockX = 1 AND blockY = 1";
    $result = mysqli_query($dbc, $CountTreesSpgroup1SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup1 = $row['totalTrees'];
        $totalVolume1530Spgroup1 = $row['totalVolume'];
    }
    
    $CountTreesSpgroup2SQL = "SELECT COUNT(*) AS totalTrees,SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 2 AND Diameter>=15 AND Diameter<=30 AND blockX = 1 AND blockY = 1";
    $result = mysqli_query($dbc, $CountTreesSpgroup2SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup2 = $row['totalTrees'];
        $totalVolume1530Spgroup2 = $row['totalVolume'];

    }
    
    $CountTreesSpgroup3SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 3 AND Diameter>=15 AND Diameter<=30 AND blockX = 1 AND blockY = 1";
    $result = mysqli_query($dbc, $CountTreesSpgroup3SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup3 = $row['totalTrees'];
        $totalVolume1530Spgroup3 = $row['totalVolume'];
    }
    
    $CountTreesSpgroup4SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 4 AND Diameter>=15 AND Diameter<=30 AND blockX = 1 AND blockY = 1";
    $result = mysqli_query($dbc, $CountTreesSpgroup4SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup4 = $row['totalTrees'];
        $totalVolume1530Spgroup4 = $row['totalVolume'];
    }
    
    $CountTreesSpgroup5SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 5 AND Diameter>=15 AND Diameter<=30 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $CountTreesSpgroup5SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup5 = $row['totalTrees'];
        $totalVolume1530Spgroup5 = $row['totalVolume'];
    }
    
    $CountTreesSpgroup6SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 6 AND Diameter>=15 AND Diameter<=30 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $CountTreesSpgroup6SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup6 = $row['totalTrees'];
        $totalVolume1530Spgroup6 = $row['totalVolume'];
    }
    
    $CountTreesSpgroup7SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 7 AND Diameter>=15 AND Diameter<=30 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $CountTreesSpgroup7SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup7 = $row['totalTrees'];
        $totalVolume1530Spgroup7 = $row['totalVolume'];
    }
    
    //Calculate total tree for Category 2
    $totalTreeCategory2 = $totalTreesSpgroup1 + $totalTreesSpgroup2 + $totalTreesSpgroup3 + $totalTreesSpgroup4 + $totalTreesSpgroup5 + $totalTreesSpgroup6 + $totalTreesSpgroup7;

    /*-------------------- method to calculate production volume Diameter >= 15 AND Diameter <= 30  --------------------*/
    function calculateProduction1530Volume($dbc, $group) {
        $query = "SELECT SUM(volume) AS totalVolume FROM regime55 
                  WHERE status_tree = 'cut' AND spgroup = $group 
                  AND Diameter >= 15 AND Diameter <= 30 
                  AND blockX = 1 AND blockY = 1";
        $result = mysqli_query($dbc, $query);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['totalVolume'];
        } else {
            return 0;
        }
    }
    
    $totalProductionVolume1530Group1 = calculateProduction1530Volume($dbc, 1);
    $totalProductionVolume1530Group2 = calculateProduction1530Volume($dbc, 2);
    $totalProductionVolume1530Group3 = calculateProduction1530Volume($dbc, 3);
    $totalProductionVolume1530Group4 = calculateProduction1530Volume($dbc, 4);
    $totalProductionVolume1530Group5 = calculateProduction1530Volume($dbc, 5);
    $totalProductionVolume1530Group6 = calculateProduction1530Volume($dbc, 6);
    $totalProductionVolume1530Group7 = calculateProduction1530Volume($dbc, 7);

    /*-------------------- method to calculate Total Damage(Damage Crown + Stem) Diameter >= 15 AND Diameter <= 30 --------------------*/
    function calculatTotalDamage1530($dbc, $group) {
        $query = "SELECT SUM(damage_crown) AS totalDamageCrown, SUM(damage_stem) AS totalDamageStem FROM regime55 
                    WHERE spgroup = $group 
                    AND DiameterClass = 2
                    AND blockX = 1 AND blockY = 1";
        $result = mysqli_query($dbc, $query);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalDamage = $row['totalDamageCrown'] + $row['totalDamageStem'];
            return $totalDamage;
        } else {
            return 0;
        }
    }
    
    $totalDamage1530Group1 = calculatTotalDamage1530($dbc, 1);
    $totalDamage1530Group2 = calculatTotalDamage1530($dbc, 2);
    $totalDamage1530Group3 = calculatTotalDamage1530($dbc, 3);
    $totalDamage1530Group4 = calculatTotalDamage1530($dbc, 4);
    $totalDamage1530Group5 = calculatTotalDamage1530($dbc, 5);
    $totalDamage1530Group6 = calculatTotalDamage1530($dbc, 6);
    $totalDamage1530Group7 = calculatTotalDamage1530($dbc, 7);

    /*-------------------- method to calculate Growth30 volume AND Diameter30 >= 15 AND Diameter30 <= 30 --------------------*/
    function calculateGrowth30Volume1530($dbc, $group) {
        $query = "SELECT SUM(Growth30) AS totalVolume FROM regime55 
                  WHERE spgroup = $group 
                  AND Diameter30 >= 15 AND Diameter30 <= 30 
                  AND blockX = 1 AND blockY = 1";
        $result = mysqli_query($dbc, $query);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['totalVolume'];
        } else {
            return 0;
        }
    }
    
    $totalGrowth30Volume1530Group1 = calculateGrowth30Volume1530($dbc, 1);
    $totalGrowth30Volume1530Group2 = calculateGrowth30Volume1530($dbc, 2);
    $totalGrowth30Volume1530Group3 = calculateGrowth30Volume1530($dbc, 3);
    $totalGrowth30Volume1530Group4 = calculateGrowth30Volume1530($dbc, 4);
    $totalGrowth30Volume1530Group5 = calculateGrowth30Volume1530($dbc, 5);
    $totalGrowth30Volume1530Group6 = calculateGrowth30Volume1530($dbc, 6);
    $totalGrowth30Volume1530Group7 = calculateGrowth30Volume1530($dbc, 7);

    /*-------------------- method to calculate Production30 volume AND Diameter30 >= 15 AND Diameter30 <= 30 --------------------*/
    function calculateProduction30Volume1530($dbc, $group) {
        $query = "SELECT SUM(Production30) AS totalVolume FROM regime55 
                  WHERE spgroup = $group 
                  AND Diameter30 >= 15 AND Diameter30 <= 30 
                  AND blockX = 1 AND blockY = 1";
        $result = mysqli_query($dbc, $query);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['totalVolume'];
        } else {
            return 0;
        }
    }
    
    $totalProduction30Volume1530Group1 = calculateProduction30Volume1530($dbc, 1);
    $totalProduction30Volume1530Group2 = calculateProduction30Volume1530($dbc, 2);
    $totalProduction30Volume1530Group3 = calculateProduction30Volume1530($dbc, 3);
    $totalProduction30Volume1530Group4 = calculateProduction30Volume1530($dbc, 4);
    $totalProduction30Volume1530Group5 = calculateProduction30Volume1530($dbc, 5);
    $totalProduction30Volume1530Group6 = calculateProduction30Volume1530($dbc, 6);
    $totalProduction30Volume1530Group7 = calculateProduction30Volume1530($dbc, 7);
    

 
    /*-------------------- Categories 30 - 45 --------------------*/
    $ProductionTreesSpgroup1SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 1  AND Diameter>=30 AND Diameter<=45 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $ProductionTreesSpgroup1SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup1 = $row['totalTrees'];
        $totalVolume3045Spgroup1 = $row['totalVolume'];
    }
    
    $ProductionTreesSpgroup2SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 2 AND Diameter>=30 AND Diameter<=45 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $ProductionTreesSpgroup2SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup2 = $row['totalTrees'];
        $totalVolume3045Spgroup2 = $row['totalVolume'];
    }
    
    
    $ProductionTreesSpgroup3SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 3 AND Diameter>=30 AND Diameter<=45 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $ProductionTreesSpgroup3SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup3 = $row['totalTrees'];
        $totalVolume3045Spgroup3 = $row['totalVolume'];
    }
    
    $ProductionTreesSpgroup4SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 4 AND Diameter>=30 AND Diameter<=45 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $ProductionTreesSpgroup4SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup4 = $row['totalTrees'];
        $totalVolume3045Spgroup4 = $row['totalVolume'];
    }
    
    $ProductionTreesSpgroup5SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 5 AND Diameter>=30 AND Diameter<=45 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $ProductionTreesSpgroup5SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup5 = $row['totalTrees'];
        $totalVolume3045Spgroup5 = $row['totalVolume'];
    }
    
    $ProductionTreesSpgroup6SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 6 AND Diameter>=30 AND Diameter<=45 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $ProductionTreesSpgroup6SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup6 = $row['totalTrees'];
        $totalVolume3045Spgroup6 = $row['totalVolume'];
    }
    
    $ProductionTreesSpgroup7SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 7 AND Diameter>=30 AND Diameter<=45 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $ProductionTreesSpgroup7SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup7 = $row['totalTrees'];
        $totalVolume3045Spgroup7 = $row['totalVolume'];
    }
    
    //Calculate total tree for Category 3
    $totalTreeCategory3 = $totalTreesSpgroup1 +  $totalTreesSpgroup2 + $totalTreesSpgroup3 + $totalTreesSpgroup4 + $totalTreesSpgroup5 + $totalTreesSpgroup6 + $totalTreesSpgroup7;

    /*-------------------- method to calculate production volume Diameter >= 30 AND Diameter <= 45 --------------------*/
    function calculateProduction3045Volume($dbc, $group) {
        $query = "SELECT SUM(volume) AS totalVolume FROM regime55 
                  WHERE status_tree = 'cut' AND spgroup = $group 
                  AND Diameter >= 30 AND Diameter <= 45 
                  AND blockX = 1 AND blockY = 1";
        $result = mysqli_query($dbc, $query);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['totalVolume'];
        } else {
            return 0;
        }
    }
    
    $totalProductionVolume3045Group1 = calculateProduction3045Volume($dbc, 1);
    $totalProductionVolume3045Group2 = calculateProduction3045Volume($dbc, 2);
    $totalProductionVolume3045Group3 = calculateProduction3045Volume($dbc, 3);
    $totalProductionVolume3045Group4 = calculateProduction3045Volume($dbc, 4);
    $totalProductionVolume3045Group5 = calculateProduction3045Volume($dbc, 5);
    $totalProductionVolume3045Group6 = calculateProduction3045Volume($dbc, 6);
    $totalProductionVolume3045Group7 = calculateProduction3045Volume($dbc, 7);

    /*-------------------- method to calculate Total Damage(Damage Crown + Stem) Diameter >= 30 AND Diameter <= 45 --------------------*/
    function calculatTotalDamage3045($dbc, $group) {
        $query = "SELECT SUM(damage_crown) AS totalDamageCrown, SUM(damage_stem) AS totalDamageStem FROM regime55 
                    WHERE spgroup = $group 
                    AND DiameterClass = 3
                    AND blockX = 1 AND blockY = 1";
        $result = mysqli_query($dbc, $query);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalDamage = $row['totalDamageCrown'] + $row['totalDamageStem'];
            return $totalDamage;
        } else {
            return 0;
        }
    }
    
    $totalDamage4530Group1 = calculatTotalDamage3045($dbc, 1);
    $totalDamage4530Group2 = calculatTotalDamage3045($dbc, 2);
    $totalDamage4530Group3 = calculatTotalDamage3045($dbc, 3);
    $totalDamage4530Group4 = calculatTotalDamage3045($dbc, 4);
    $totalDamage4530Group5 = calculatTotalDamage3045($dbc, 5);
    $totalDamage4530Group6 = calculatTotalDamage3045($dbc, 6);
    $totalDamage4530Group7 = calculatTotalDamage3045($dbc, 7);

    /*-------------------- method to calculate Growth30 volume Diameter >= 30 AND Diameter <= 45  --------------------*/
    function calculateGrowth30Volume3045($dbc, $group) {
        $query = "SELECT SUM(Growth30) AS totalVolume FROM regime55 
                  WHERE spgroup = $group 
                  AND Diameter30 >= 30 AND Diameter30 <= 45 
                  AND blockX = 1 AND blockY = 1";
        $result = mysqli_query($dbc, $query);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['totalVolume'];
        } else {
            return 0;
        }
    }
    
    $totalGrowth30Volume3045Group1 = calculateGrowth30Volume3045($dbc, 1);
    $totalGrowth30Volume3045Group2 = calculateGrowth30Volume3045($dbc, 2);
    $totalGrowth30Volume3045Group3 = calculateGrowth30Volume3045($dbc, 3);
    $totalGrowth30Volume3045Group4 = calculateGrowth30Volume3045($dbc, 4);
    $totalGrowth30Volume3045Group5 = calculateGrowth30Volume3045($dbc, 5);
    $totalGrowth30Volume3045Group6 = calculateGrowth30Volume3045($dbc, 6);
    $totalGrowth30Volume3045Group7 = calculateGrowth30Volume3045($dbc, 7);

    /*-------------------- method to calculate Production30 volume AND ND Diameter30 >= 30 AND Diameter30 <= 45 --------------------*/
    function calculateProduction30Volume3045($dbc, $group) {
        $query = "SELECT SUM(Production30) AS totalVolume FROM regime55 
                  WHERE spgroup = $group 
                  AND Diameter30 >= 30 AND Diameter30 <= 45 
                  AND blockX = 1 AND blockY = 1";
        $result = mysqli_query($dbc, $query);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['totalVolume'];
        } else {
            return 0;
        }
    }

    $totalProduction30Volume3045Group1 = calculateProduction30Volume3045($dbc, 1);
    $totalProduction30Volume3045Group2 = calculateProduction30Volume3045($dbc, 2);
    $totalProduction30Volume3045Group3 = calculateProduction30Volume3045($dbc, 3);
    $totalProduction30Volume3045Group4 = calculateProduction30Volume3045($dbc, 4);
    $totalProduction30Volume3045Group5 = calculateProduction30Volume3045($dbc, 5);
    $totalProduction30Volume3045Group6 = calculateProduction30Volume3045($dbc, 6);
    $totalProduction30Volume3045Group7 = calculateProduction30Volume3045($dbc, 7);

    
    /*-------------------- Categories 45 - 60 --------------------*/
    $DamageCrownSpgroup1SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 1 AND Diameter>=45 AND Diameter<=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageCrownSpgroup1SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup1 = $row['totalTrees'];
        $totalVolume4560Spgroup1 = $row['totalVolume'];
    }
    
    $DamageCrownSpgroup2SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 2 AND Diameter>=45 AND Diameter<=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageCrownSpgroup2SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup2 = $row['totalTrees'];
        $totalVolume4560Spgroup2 = $row['totalVolume'];
    }
    
    $DamageCrownSpgroup3SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 3 AND Diameter>=45 AND Diameter<=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageCrownSpgroup3SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup3 = $row['totalTrees'];
        $totalVolume4560Spgroup3 = $row['totalVolume'];
    }
    
    $DamageCrownSpgroup4SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 4 AND Diameter>=45 AND Diameter<=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageCrownSpgroup4SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup4 = $row['totalTrees'];
        $totalVolume4560Spgroup4 = $row['totalVolume'];
    }
    
    $DamageCrownSpgroup5SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 5 AND Diameter>=45 AND Diameter<=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageCrownSpgroup5SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup5 = $row['totalTrees'];
        $totalVolume4560Spgroup5 = $row['totalVolume'];
    }
    
    $DamageCrownSpgroup6SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 6 AND Diameter>=45 AND Diameter<=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageCrownSpgroup6SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup6 = $row['totalTrees'];
        $totalVolume4560Spgroup6 = $row['totalVolume'];
    }
    
    $DamageCrownSpgroup7SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime55 WHERE spgroup = 7 AND Diameter>=45 AND Diameter<=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageCrownSpgroup7SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup7 = $row['totalTrees'];
        $totalVolume4560Spgroup7 = $row['totalVolume'];
    }
    
    //Calculate total tree for Category 4
    $totalTreeCategory4 = $totalTreesSpgroup1 + $totalTreesSpgroup2 + $totalTreesSpgroup3 + $totalTreesSpgroup4 + $totalTreesSpgroup5 + $totalTreesSpgroup6 + $totalTreesSpgroup7;
    
    /*-------------------- method to calculate production volume Diameter >= 45 AND Diameter <= 60 --------------------*/
    function calculateProduction4560Volume($dbc, $group) {
        $query = "SELECT SUM(volume) AS totalVolume FROM regime55 
                  WHERE status_tree = 'cut' AND spgroup = $group 
                  AND Diameter >= 45 AND Diameter <= 60 
                  AND blockX = 1 AND blockY = 1";
        $result = mysqli_query($dbc, $query);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['totalVolume'];
        } else {
            return 0;
        }
    }
    
    $totalProductionVolume4560Group1 = calculateProduction4560Volume($dbc, 1);
    $totalProductionVolume4560Group2 = calculateProduction4560Volume($dbc, 2);
    $totalProductionVolume4560Group3 = calculateProduction4560Volume($dbc, 3);
    $totalProductionVolume4560Group4 = calculateProduction4560Volume($dbc, 4);
    $totalProductionVolume4560Group5 = calculateProduction4560Volume($dbc, 5);
    $totalProductionVolume4560Group6 = calculateProduction4560Volume($dbc, 6);
    $totalProductionVolume4560Group7 = calculateProduction4560Volume($dbc, 7);

    /*-------------------- method to calculate Total Damage(Damage Crown + Stem) Diameter >= 45 AND Diameter <= 60 --------------------*/
    function calculatTotalDamage4560($dbc, $group) {
        $query = "SELECT SUM(damage_crown) AS totalDamageCrown, SUM(damage_stem) AS totalDamageStem FROM regime55 
                    WHERE spgroup = $group 
                    AND DiameterClass = 4
                    AND blockX = 1 AND blockY = 1";
        $result = mysqli_query($dbc, $query);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalDamage = $row['totalDamageCrown'] + $row['totalDamageStem'];
            return $totalDamage;
        } else {
            return 0;
        }
    }
    
    $totalDamage4560Group1 = calculatTotalDamage4560($dbc, 1);
    $totalDamage4560Group2 = calculatTotalDamage4560($dbc, 2);
    $totalDamage4560Group3 = calculatTotalDamage4560($dbc, 3);
    $totalDamage4560Group4 = calculatTotalDamage4560($dbc, 4);
    $totalDamage4560Group5 = calculatTotalDamage4560($dbc, 5);
    $totalDamage4560Group6 = calculatTotalDamage4560($dbc, 6);
    $totalDamage4560Group7 = calculatTotalDamage4560($dbc, 7);

    /*-------------------- method to calculate Growth30 volume Diameter30 >= 45 AND Diameter30 <= 60   --------------------*/
    function calculateGrowth30Volume4560($dbc, $group) {
        $query = "SELECT SUM(Growth30) AS totalVolume FROM regime55 
                  WHERE spgroup = $group 
                  AND Diameter30 >= 45 AND Diameter30 <= 60 
                  AND blockX = 1 AND blockY = 1";
        $result = mysqli_query($dbc, $query);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['totalVolume'];
        } else {
            return 0;
        }
    }
    
    $totalGrowth30Volume4560Group1 = calculateGrowth30Volume4560($dbc, 1);
    $totalGrowth30Volume4560Group2 = calculateGrowth30Volume4560($dbc, 2);
    $totalGrowth30Volume4560Group3 = calculateGrowth30Volume4560($dbc, 3);
    $totalGrowth30Volume4560Group4 = calculateGrowth30Volume4560($dbc, 4);
    $totalGrowth30Volume4560Group5 = calculateGrowth30Volume4560($dbc, 5);
    $totalGrowth30Volume4560Group6 = calculateGrowth30Volume4560($dbc, 6);
    $totalGrowth30Volume4560Group7 = calculateGrowth30Volume4560($dbc, 7);

    /*-------------------- method to calculate Production30 volume AND Diameter30 >= 45 AND Diameter30 <= 60 --------------------*/
    function calculateProduction30Volume4560($dbc, $group) {
        $query = "SELECT SUM(Production30) AS totalVolume FROM regime55 
                  WHERE spgroup = $group 
                  AND Diameter30 >= 45 AND Diameter30 <= 60 
                  AND blockX = 1 AND blockY = 1";
        $result = mysqli_query($dbc, $query);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['totalVolume'];
        } else {
            return 0;
        }
    }
    
    $totalProduction30Volume4560Group1 = calculateProduction30Volume4560($dbc, 1);
    $totalProduction30Volume4560Group2 = calculateProduction30Volume4560($dbc, 2);
    $totalProduction30Volume4560Group3 = calculateProduction30Volume4560($dbc, 3);
    $totalProduction30Volume4560Group4 = calculateProduction30Volume4560($dbc, 4);
    $totalProduction30Volume4560Group5 = calculateProduction30Volume4560($dbc, 5);
    $totalProduction30Volume4560Group6 = calculateProduction30Volume4560($dbc, 6);
    $totalProduction30Volume4560Group7 = calculateProduction30Volume4560($dbc, 7);
   
    /*-------------------- Categories 60+ --------------------*/
    $DamageStemSpgroup1SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime50 WHERE spgroup = 1 AND Diameter>=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageStemSpgroup1SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup1 = $row['totalTrees'];
        $totalVolume60Spgroup1 = $row['totalVolume'];
    }
    
    $DamageStemSpgroup2SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime50 WHERE spgroup = 2 AND Diameter>=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageStemSpgroup2SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup2 = $row['totalTrees'];
        $totalVolume60Spgroup2 = $row['totalVolume'];
    }
    
    $DamageStemSpgroup3SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime50 WHERE spgroup = 3 AND Diameter>=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageStemSpgroup3SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup3 = $row['totalTrees'];
        $totalVolume60Spgroup3 = $row['totalVolume'];
    }
    
    $DamageStemSpgroup4SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime50 WHERE spgroup = 4 AND Diameter>=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageStemSpgroup4SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup4 = $row['totalTrees'];
        $totalVolume60Spgroup4 = $row['totalVolume'];
    }
    
    $DamageStemSpgroup5SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime50 WHERE spgroup = 5 AND Diameter>=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageStemSpgroup5SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup5 = $row['totalTrees'];
        $totalVolume60Spgroup5 = $row['totalVolume'];
    }
    
    $DamageStemSpgroup6SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime50 WHERE spgroup = 6 AND Diameter>=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageStemSpgroup6SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup6 = $row['totalTrees'];
        $totalVolume60Spgroup6 = $row['totalVolume'];
    }
    
    $DamageStemSpgroup7SQL = "SELECT COUNT(*) AS totalTrees, SUM(volume) AS totalVolume FROM regime50 WHERE spgroup = 7 AND Diameter>=60 AND blockX = 1 AND blockY = 1";
    
    $result = mysqli_query($dbc, $DamageStemSpgroup7SQL);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalTreesSpgroup7 = $row['totalTrees'];
        $totalVolume60Spgroup7 = $row['totalVolume'];
    }
    
    //Calculate total tree for Category 5
    $totalTreeCategory5 = $totalTreesSpgroup1 + $totalTreesSpgroup2 + $totalTreesSpgroup3 + $totalTreesSpgroup4 + $totalTreesSpgroup5 + $totalTreesSpgroup6 + $totalTreesSpgroup7;

    /*-------------------- new method to calculate production volume for diameter>60 --------------------*/
    function calculateProduction60Volume($dbc, $group) {
        $query = "SELECT SUM(volume) AS totalVolume FROM regime55 
                  WHERE status_tree = 'cut' AND spgroup = $group 
                  AND Diameter >= 60
                  AND blockX = 1 AND blockY = 1";
        $result = mysqli_query($dbc, $query);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['totalVolume'];
        } else {
            return 0;
        }
    }
    
    $totalProductionVolume60Group1 = calculateProduction60Volume($dbc, 1);
    $totalProductionVolume60Group2 = calculateProduction60Volume($dbc, 2);
    $totalProductionVolume60Group3 = calculateProduction60Volume($dbc, 3);
    $totalProductionVolume60Group4 = calculateProduction60Volume($dbc, 4);
    $totalProductionVolume60Group5 = calculateProduction60Volume($dbc, 5);
    $totalProductionVolume60Group6 = calculateProduction60Volume($dbc, 6);
    $totalProductionVolume60Group7 = calculateProduction60Volume($dbc, 7);

    /*-------------------- method to calculate Total Damage(Damage Crown + Stem) Diameter >= 60 --------------------*/
    function calculatTotalDamage60($dbc, $group) {
        $query = "SELECT SUM(damage_crown) AS totalDamageCrown, SUM(damage_stem) AS totalDamageStem FROM regime55 
                    WHERE spgroup = $group 
                    AND DiameterClass = 5
                    AND blockX = 1 AND blockY = 1";
        $result = mysqli_query($dbc, $query);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalDamage = $row['totalDamageCrown'] + $row['totalDamageStem'];
            return $totalDamage;
        } else {
            return 0;
        }
    }
    
    $totalDamage60Group1 = calculatTotalDamage60($dbc, 1);
    $totalDamage60Group2 = calculatTotalDamage60($dbc, 2);
    $totalDamage60Group3 = calculatTotalDamage60($dbc, 3);
    $totalDamage60Group4 = calculatTotalDamage60($dbc, 4);
    $totalDamage60Group5 = calculatTotalDamage60($dbc, 5);
    $totalDamage60Group6 = calculatTotalDamage60($dbc, 6);
    $totalDamage60Group7 = calculatTotalDamage60($dbc, 7);

    /*-------------------- method to calculate Growth30 volume Diameter30 >= 60   --------------------*/
    function calculateGrowth30Volume60($dbc, $group) {
        $query = "SELECT SUM(Growth30) AS totalVolume FROM regime55 
                  WHERE spgroup = $group 
                  AND Diameter30 >= 60 
                  AND blockX = 1 AND blockY = 1";
        $result = mysqli_query($dbc, $query);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['totalVolume'];
        } else {
            return 0;
        }
    }
    
    $totalGrowth30Volume60Group1 = calculateGrowth30Volume60($dbc, 1);
    $totalGrowth30Volume60Group2 = calculateGrowth30Volume60($dbc, 2);
    $totalGrowth30Volume60Group3 = calculateGrowth30Volume60($dbc, 3);
    $totalGrowth30Volume60Group4 = calculateGrowth30Volume60($dbc, 4);
    $totalGrowth30Volume60Group5 = calculateGrowth30Volume60($dbc, 5);
    $totalGrowth30Volume60Group6 = calculateGrowth30Volume60($dbc, 6);
    $totalGrowth30Volume60Group7 = calculateGrowth30Volume60($dbc, 7);

    /*-------------------- method to calculate Production30 volume Diameter30 >= 60   --------------------*/
    function calculateProduction30Volume60($dbc, $group) {
        $query = "SELECT SUM(Production30) AS totalVolume FROM regime55 
                  WHERE spgroup = $group 
                  AND Diameter30 >= 60 
                  AND blockX = 1 AND blockY = 1";
        $result = mysqli_query($dbc, $query);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['totalVolume'];
        } else {
            return 0;
        }
    }
    
    $totalProduction30Volume60Group1 = calculateProduction30Volume60($dbc, 1);
    $totalProduction30Volume60Group2 = calculateProduction30Volume60($dbc, 2);
    $totalProduction30Volume60Group3 = calculateProduction30Volume60($dbc, 3);
    $totalProduction30Volume60Group4 = calculateProduction30Volume60($dbc, 4);
    $totalProduction30Volume60Group5 = calculateProduction30Volume60($dbc, 5);
    $totalProduction30Volume60Group6 = calculateProduction30Volume60($dbc, 6);
    $totalProduction30Volume60Group7 = calculateProduction30Volume60($dbc, 7);
    

    
    /*-------------------- Calculate Total Tree For Every Categories --------------------*/
    
    //Group 1
    //Calculate total tree Mersawa
    $totalAllTreeMersawa = $totalTreeMersawa1 + $totalTreesSpgroup1 + $totalTreesSpgroup1 + $totalTreesSpgroup1 + $totalTreesSpgroup1;
    // total volume for group1 
    $totalVolumeGroup1 = $totalVolumeMersawa1 + $totalVolume1530Spgroup1 + $totalVolume3045Spgroup1 + $totalVolume4560Spgroup1 + $totalVolume60Spgroup1;
    // total production volume for group1
    $totalProductionVolumeGroup1 = $totalProductionVolumeGroup1 + $totalProductionVolume1530Group1 + $totalProductionVolume3045Group1 + $totalProductionVolume4560Group1 + $totalProductionVolume60Group1;
    // total damage for group1  
    $totalDamageGroup1 = $totalDamage515Group1 + $totalDamage1530Group1 + $totalDamage4530Group1 + $totalDamage4560Group1 + $totalDamage60Group1;
    // total growth30 volume for group1
    $totalGrowth30VolumeGroup1 = $totalGrowth30Volume515Group1 + $totalGrowth30Volume1530Group1 + $totalGrowth30Volume3045Group1 + $totalGrowth30Volume4560Group1 + $totalGrowth30Volume60Group1;
    // total production30 volume for group1
    $totalProduction30VolumeGroup1 = $totalProduction30Volume515Group1 + $totalProduction30Volume1530Group1 + $totalProduction30Volume3045Group1 + $totalProduction30Volume4560Group1 + $totalProduction30Volume60Group1;

    //Group 2
    //Calculate total tree Keruing
    $totalAllTreeKeruing = $totalTreeKeruing1 + $totalTreesSpgroup2 + $totalTreesSpgroup2 + $totalTreesSpgroup2 + $totalTreesSpgroup2;
    // total volume for group2
    $totalVolumeGroup2 = $totalVolumeKeruing1 + $totalVolume1530Spgroup2 + $totalVolume3045Spgroup2 + $totalVolume4560Spgroup2 + $totalVolume60Spgroup2;
    // total production volume for group2
    $totalProductionVolumeGroup2 = $totalProductionVolumeGroup2 + $totalProductionVolume1530Group2 + $totalProductionVolume3045Group2 + $totalProductionVolume4560Group2 + $totalProductionVolume60Group2;
    // total damage for group2
    $totalDamageGroup2 = $totalDamage515Group2 + $totalDamage1530Group2 + $totalDamage4530Group2 + $totalDamage4560Group2 + $totalDamage60Group2;
    // total growth30 volume for group2 
    $totalGrowth30VolumeGroup2 = $totalGrowth30Volume515Group2 + $totalGrowth30Volume1530Group2 + $totalGrowth30Volume3045Group2 + $totalGrowth30Volume4560Group2 + $totalGrowth30Volume60Group2;
    // total production30 volume for group2
    $totalProduction30VolumeGroup2 = $totalProduction30Volume515Group2 + $totalProduction30Volume1530Group2 + $totalProduction30Volume3045Group2 + $totalProduction30Volume4560Group2 + $totalProduction30Volume60Group2;

    //Group 3
    //Calculate total tree Dip Marketable
    $totalAllTreeDipMarket = $totalTreeDipMarket1 + $totalTreesSpgroup3 + $totalTreesSpgroup3 + $totalTreesSpgroup3 + $totalTreesSpgroup3;
    // total volume for group3
    $totalVolumeGroup3 = $totalVolumeDipMarket1 + $totalVolume1530Spgroup3 + $totalVolume3045Spgroup3 + $totalVolume4560Spgroup3 + $totalVolume60Spgroup3;
    // total production volume for group3
    $totalProductionVolumeGroup3 = $totalProductionVolumeGroup3 + $totalProductionVolume1530Group3 + $totalProductionVolume3045Group3 + $totalProductionVolume4560Group3 + $totalProductionVolume60Group3;
    // total damage for group3
    $totalDamageGroup3 = $totalDamage515Group3 + $totalDamage1530Group3 + $totalDamage4530Group3 + $totalDamage4560Group3 + $totalDamage60Group3;
    // total growth30 volume for group3
    $totalGrowth30VolumeGroup3 = $totalGrowth30Volume515Group3 + $totalGrowth30Volume1530Group3 + $totalGrowth30Volume3045Group3 + $totalGrowth30Volume4560Group3 + $totalGrowth30Volume60Group3;
    // total production30 volume for group3
    $totalProduction30VolumeGroup3 = $totalProduction30Volume515Group3 + $totalProduction30Volume1530Group3 + $totalProduction30Volume3045Group3 + $totalProduction30Volume4560Group3 + $totalProduction30Volume60Group3;

    //Group 4
    //Calculate total tree Dip Non Market
    $totalAllTreeDipNonMarket = $totalTreeDipNonMarket1 + $totalTreesSpgroup4 + $totalTreesSpgroup4 + $totalTreesSpgroup4 + $totalTreesSpgroup4;
    // total volume for group4
    $totalVolumeGroup4 = $totalVolumeDipNonMarket1 + $totalVolume1530Spgroup4 + $totalVolume3045Spgroup4 + $totalVolume4560Spgroup4 + $totalVolume60Spgroup4;
    // total production volume for group4
    $totalProductionVolumeGroup4 = $totalProductionVolumeGroup4 + $totalProductionVolume1530Group4 + $totalProductionVolume3045Group4 + $totalProductionVolume4560Group4 + $totalProductionVolume60Group4;
    // total damage for group4
    $totalDamageGroup4 = $totalDamage515Group4 + $totalDamage1530Group4 + $totalDamage4530Group4 + $totalDamage4560Group4 + $totalDamage60Group4;
    // total growth30 volume for group4
    $totalGrowth30VolumeGroup4 = $totalGrowth30Volume515Group4 + $totalGrowth30Volume1530Group4 + $totalGrowth30Volume3045Group4 + $totalGrowth30Volume4560Group4 + $totalGrowth30Volume60Group4;
    // total production30 volume for group4
    $totalProduction30VolumeGroup4 = $totalProduction30Volume515Group4 + $totalProduction30Volume1530Group4 + $totalProduction30Volume3045Group4 + $totalProduction30Volume4560Group4 + $totalProduction30Volume60Group4;

    //Group 5
    //Calculate total tree Non Dip Market
    $totalAllTreeNonDipMarket = $totalTreeNonDipMarket1 + $totalTreesSpgroup5 + $totalTreesSpgroup5 + $totalTreesSpgroup5 + $totalTreesSpgroup5;
    // total volume for group5
    $totalVolumeGroup5 = $totalVolumeNonDipMarket1 + $totalVolume1530Spgroup5 + $totalVolume3045Spgroup5 + $totalVolume4560Spgroup5 + $totalVolume60Spgroup5;
    // total production volume for group5
    $totalProductionVolumeGroup5 = $totalProductionVolumeGroup5 + $totalProductionVolume1530Group5 + $totalProductionVolume3045Group5 + $totalProductionVolume4560Group5 + $totalProductionVolume60Group5;
    // total damage for group5
    $totalDamageGroup5 = $totalDamage515Group5 + $totalDamage1530Group5 + $totalDamage4530Group5 + $totalDamage4560Group5 + $totalDamage60Group5;
    // total growth30 volume for group5
    $totalGrowth30VolumeGroup5 = $totalGrowth30Volume515Group5 + $totalGrowth30Volume1530Group5 + $totalGrowth30Volume3045Group5 + $totalGrowth30Volume4560Group5 + $totalGrowth30Volume60Group5;
    // total production30 volume for group5
    $totalProduction30VolumeGroup5 = $totalProduction30Volume515Group5 + $totalProduction30Volume1530Group5 + $totalProduction30Volume3045Group5 + $totalProduction30Volume4560Group5 + $totalProduction30Volume60Group5;

    //Group 6
    //Calculate total tree Non Dip Non Market
    $totalAllTreeNonDipNonMarket = $totalTreeNonDipNonMarket1 + $totalTreesSpgroup6 + $totalTreesSpgroup6 + $totalTreesSpgroup6 + $totalTreesSpgroup6;
    // total volume for group6
    $totalVolumeGroup6 = $totalVolumeNonDipNonMarket1 + $totalVolume1530Spgroup6 + $totalVolume3045Spgroup6 + $totalVolume4560Spgroup6 + $totalVolume60Spgroup6;
    // total production volume for group6
    $totalProductionVolumeGroup6 = $totalProductionVolumeGroup6 + $totalProductionVolume1530Group6 + $totalProductionVolume3045Group6 + $totalProductionVolume4560Group6 + $totalProductionVolume60Group6;
    // total damage for group6
    $totalDamageGroup6 = $totalDamage515Group6 + $totalDamage1530Group6 + $totalDamage4530Group6 + $totalDamage4560Group6 + $totalDamage60Group6;
    // total growth30 volume for group6
    $totalGrowth30VolumeGroup6 = $totalGrowth30Volume515Group6 + $totalGrowth30Volume1530Group6 + $totalGrowth30Volume3045Group6 + $totalGrowth30Volume4560Group6 + $totalGrowth30Volume60Group6;
    // total production30 volume for group6
    $totalProduction30VolumeGroup6 = $totalProduction30Volume515Group6 + $totalProduction30Volume1530Group6 + $totalProduction30Volume3045Group6 + $totalProduction30Volume4560Group6 + $totalProduction30Volume60Group6;

    //Group 7
    //Calculate total tree Others
    $totalAllTreeOthers = $totalTreeOthers1 + $totalTreesSpgroup7 + $totalTreesSpgroup7 + $totalTreesSpgroup7 + $totalTreesSpgroup7;
    // total volume for group7
    $totalVolumeGroup7 = $totalVolumeOthers1 + $totalVolume1530Spgroup7 + $totalVolume3045Spgroup7 + $totalVolume4560Spgroup7 + $totalVolume60Spgroup7;
    // total production volume for group7
    $totalProductionVolumeGroup7 = $totalProductionVolumeGroup7 + $totalProductionVolume1530Group7 + $totalProductionVolume3045Group7 + $totalProductionVolume4560Group7 + $totalProductionVolume60Group7;
    // total damage for group7
    $totalDamageGroup7 = $totalDamage515Group7 + $totalDamage1530Group7 + $totalDamage4530Group7 + $totalDamage4560Group7 + $totalDamage60Group7;
    // total growth30 volume for group7
    $totalGrowth30VolumeGroup7 = $totalGrowth30Volume515Group7 + $totalGrowth30Volume1530Group7 + $totalGrowth30Volume3045Group7 + $totalGrowth30Volume4560Group7 + $totalGrowth30Volume60Group7;
    // total production30 volume for group7
    $totalProduction30VolumeGroup7 = $totalProduction30Volume515Group7 + $totalProduction30Volume1530Group7 + $totalProduction30Volume3045Group7 + $totalProduction30Volume4560Group7 + $totalProduction30Volume60Group7;

    //Total all tree
    $totalAllTree = $totalTreeCategory1 + $totalTreeCategory2 + $totalTreeCategory3 + $totalTreeCategory4 + $totalTreeCategory5;
 
    ?>
</head>
<body>
    <div class="container">
        <header>
            <h1>Stand Table 55</h1>
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
            <td> Quantity Group 1 </td>
            <td> <?php echo $totalTreeMersawa1; ?> </td>
            <td> <?php echo $totalTreesSpgroup1; ?> </td>
            <td> <?php echo $totalTreesSpgroup1; ?> </td>
            <td> <?php echo $totalTreesSpgroup1; ?> </td>
            <td> <?php echo $totalTreesSpgroup1; ?> </td>
            <td> <?php echo $totalAllTreeMersawa; ?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Volume Group 1</td>
            <td><?php echo number_format($totalVolumeMersawa1,2); ?> </td>
            <td><?php echo number_format($totalVolume1530Spgroup1,2);?> </td>
            <td><?php echo number_format($totalVolume3045Spgroup1,2);?> </td>
            <td><?php echo number_format($totalVolume4560Spgroup1,2);?> </td>
            <td><?php echo number_format($totalVolume60Spgroup1,2);?> </td>
            <td><?php echo number_format($totalVolumeGroup1,2);?> </td> 
        </tr>

        <tr>
            <td></td>
            <td>Production Group 1</td>
            <td><?php echo number_format($totalProductionVolumeGroup1,2); ?> </td>
            <td><?php echo number_format($totalProductionVolume1530Group1,2);?> </td>
            <td><?php echo number_format($totalProductionVolume3045Group1,2);?> </td>
            <td><?php echo number_format($totalProductionVolume4560Group1,2);?> </td>
            <td><?php echo number_format($totalProductionVolume60Group1,2);?> </td>
            <td><?php echo number_format($totalProductionVolumeGroup1,2);?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Damage Group 1</td>
            <td><?php echo $totalDamage515Group1;?> </td>
            <td><?php echo $totalDamage1530Group1;?> </td>
            <td><?php echo $totalDamage4530Group1;?> </td>
            <td><?php echo $totalDamage4560Group1;?> </td>
            <td><?php echo $totalDamage60Group1;?> </td>
            <td><?php echo $totalDamageGroup1;?> </td>

        </tr>

        <tr>
            <td></td>
            <td>Growth30 Group 1</td>
            <td><?php echo number_format($totalGrowth30Volume515Group1,2); ?> </td>
            <td><?php echo number_format($totalGrowth30Volume1530Group1,2);?> </td>
            <td><?php echo number_format($totalGrowth30Volume3045Group1,2);?> </td>
            <td><?php echo number_format($totalGrowth30Volume4560Group1,2);?> </td>
            <td><?php echo number_format($totalGrowth30Volume60Group1,2);?> </td>
            <td><?php echo number_format($totalGrowth30VolumeGroup1,2);?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Production30 Group 1</td>
            <td><?php echo number_format($totalProduction30Volume515Group1,2); ?> </td>
            <td><?php echo number_format($totalProduction30Volume1530Group1,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume3045Group1,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume4560Group1,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume60Group1,2);?> </td>
            <td><?php echo number_format($totalProduction30VolumeGroup1,2);?> </td>
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
            <td></td>
            <td>Volume Group 2</td>
            <td> <?php echo number_format($totalVolumeKeruing1,2); ?> </td>
            <td> <?php echo number_format($totalVolume1530Spgroup2,2); ?> </td>
            <td> <?php echo number_format($totalVolume3045Spgroup2,2); ?> </td>
            <td> <?php echo number_format($totalVolume4560Spgroup2,2); ?> </td>
            <td> <?php echo number_format($totalVolume60Spgroup2,2); ?> </td>
            <td> <?php echo number_format($totalVolumeGroup2,2); ?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Production Group 2</td>
            <td><?php echo number_format($totalProductionVolumeGroup2,2); ?> </td>
            <td><?php echo number_format($totalProductionVolume1530Group2,2);?> </td>
            <td><?php echo number_format($totalProductionVolume3045Group2,2);?> </td>
            <td><?php echo number_format($totalProductionVolume4560Group2,2);?> </td>
            <td><?php echo number_format($totalProductionVolume60Group2,2);?> </td>
            <td><?php echo number_format($totalProductionVolumeGroup2,2);?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Damage Group 2</td>
            <td><?php echo $totalDamage515Group2; ?> </td>
            <td><?php echo $totalDamage1530Group2;?> </td>
            <td><?php echo $totalDamage4530Group2;?> </td>
            <td><?php echo $totalDamage4560Group2;?> </td>
            <td><?php echo $totalDamage60Group2;?> </td>
            <td><?php echo $totalDamageGroup2;?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Growth30 Group 2</td>
            <td><?php echo number_format($totalGrowth30Volume515Group2,2); ?> </td>
            <td><?php echo number_format($totalGrowth30Volume1530Group2,2);?> </td>
            <td><?php echo number_format($totalGrowth30Volume3045Group2,2);?> </td>
            <td><?php echo number_format($totalGrowth30Volume4560Group2,2);?> </td>
            <td><?php echo number_format($totalGrowth30Volume60Group2,2);?> </td>
            <td><?php echo number_format($totalGrowth30VolumeGroup2,2);?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Production30 Group 2</td>
            <td><?php echo number_format($totalProduction30Volume515Group2,2); ?> </td>
            <td><?php echo number_format($totalProduction30Volume1530Group2,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume3045Group2,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume4560Group2,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume60Group2,2);?> </td>
            <td><?php echo number_format($totalProduction30VolumeGroup2,2);?> </td>
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
            <td></td>
            <td>Volume Group 3</td>
            <td> <?php echo number_format($totalVolumeDipMarket1,2); ?> </td>
            <td> <?php echo number_format($totalVolume1530Spgroup3,2); ?> </td>
            <td> <?php echo number_format($totalVolume3045Spgroup3,2); ?> </td>
            <td> <?php echo number_format($totalVolume4560Spgroup3,2); ?> </td>
            <td> <?php echo number_format($totalVolume60Spgroup3,2); ?> </td>
            <td> <?php echo number_format($totalVolumeGroup3,2); ?> </td>   
        </tr>

        <tr>
            <td></td>
            <td>Production Group 3</td>
            <td><?php echo number_format($totalProductionVolumeGroup3,2); ?> </td>
            <td><?php echo number_format($totalProductionVolume1530Group2,2);?> </td>
            <td><?php echo number_format($totalProductionVolume3045Group3,2);?> </td>
            <td><?php echo number_format($totalProductionVolume4560Group3,2);?> </td>
            <td><?php echo number_format($totalProductionVolume60Group3,2);?> </td>
            <td><?php echo number_format($totalProductionVolumeGroup3,2);?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Damage Group 3</td>
            <td><?php echo $totalDamage515Group3; ?> </td>
            <td><?php echo $totalDamage1530Group3;?> </td>
            <td><?php echo $totalDamage4530Group3;?> </td>
            <td><?php echo $totalDamage4560Group3;?> </td>
            <td><?php echo $totalDamage60Group3;?> </td>
            <td><?php echo $totalDamageGroup3;?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Growth30 Group 3</td>
            <td><?php echo number_format($totalGrowth30Volume515Group3,2); ?> </td>
            <td><?php echo number_format($totalGrowth30Volume1530Group3,2);?> </td>
            <td><?php echo number_format($totalGrowth30Volume3045Group3,2);?> </td>
            <td><?php echo number_format($totalGrowth30Volume4560Group3,2);?> </td>
            <td><?php echo number_format($totalGrowth30Volume60Group3,2);?> </td>
            <td><?php echo number_format($totalGrowth30VolumeGroup3,2);?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Production30 Group 3</td>
            <td><?php echo number_format($totalProduction30Volume515Group3,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume1530Group3,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume3045Group3,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume4560Group3,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume60Group3,2);?> </td>
            <td><?php echo number_format($totalProduction30VolumeGroup3,2);?> </td>
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
            <td></td>
            <td>Volume Group 4</td>
            <td> <?php echo number_format($totalVolumeDipNonMarket1,2); ?> </td>
            <td> <?php echo number_format($totalVolume1530Spgroup4,2); ?> </td>
            <td> <?php echo number_format($totalVolume3045Spgroup4,2); ?> </td>
            <td> <?php echo number_format($totalVolume4560Spgroup4,2); ?> </td>
            <td> <?php echo number_format($totalVolume60Spgroup4,2); ?> </td>
            <td> <?php echo number_format($totalVolumeGroup4,2); ?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Production Group 4</td>
            <td><?php echo number_format($totalProductionVolumeGroup4,2); ?> </td>
            <td><?php echo number_format($totalProductionVolume1530Group4,2);?> </td>
            <td><?php echo number_format($totalProductionVolume3045Group4,2);?> </td>
            <td><?php echo number_format($totalProductionVolume4560Group4,2);?> </td>
            <td><?php echo number_format($totalProductionVolume60Group4,2);?> </td>
            <td><?php echo number_format($totalProductionVolumeGroup4,2);?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Damage Group 4</td>
            <td><?php echo $totalDamage515Group4; ?> </td>
            <td><?php echo $totalDamage1530Group4;?> </td>
            <td><?php echo $totalDamage4530Group4;?> </td>
            <td><?php echo $totalDamage4560Group4;?> </td>
            <td><?php echo $totalDamage60Group4;?> </td>
            <td><?php echo $totalDamageGroup4;?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Growth30 Group 4</td>
            <td><?php echo number_format($totalGrowth30Volume515Group4,2); ?> </td>
            <td><?php echo number_format($totalGrowth30Volume1530Group4,2);?> </td>
            <td><?php echo number_format($totalGrowth30Volume3045Group4,2);?> </td>
            <td><?php echo number_format($totalGrowth30Volume4560Group4,2);?> </td>
            <td><?php echo number_format($totalGrowth30Volume60Group4,2);?> </td>
            <td><?php echo number_format($totalGrowth30VolumeGroup4,2);?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Production30 Group 4</td>
            <td><?php echo number_format($totalProduction30Volume515Group4,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume1530Group4,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume3045Group4,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume4560Group4,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume60Group4,2);?> </td>
            <td><?php echo number_format($totalProduction30VolumeGroup4,2);?> </td>
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
            <td></td>
            <td>Volume Group 5</td>
            <td> <?php echo number_format($totalVolumeNonDipMarket1,2); ?> </td>
            <td> <?php echo number_format($totalVolume1530Spgroup5,2); ?> </td>
            <td> <?php echo number_format($totalVolume3045Spgroup5,2); ?> </td>
            <td> <?php echo number_format($totalVolume4560Spgroup5,2); ?> </td>
            <td> <?php echo number_format($totalVolume60Spgroup5,2); ?> </td>
            <td> <?php echo number_format($totalVolumeGroup5,2); ?> </td>   
        </tr>

        <tr>
            <td></td>
            <td>Production Group 5</td>
            <td><?php echo number_format($totalProductionVolumeGroup5,2); ?> </td>
            <td><?php echo number_format($totalProductionVolume1530Group5,2);?> </td>
            <td><?php echo number_format($totalProductionVolume3045Group5,2);?> </td>
            <td><?php echo number_format($totalProductionVolume4560Group5,2);?> </td>
            <td><?php echo number_format($totalProductionVolume60Group5,2);?> </td>
            <td><?php echo number_format($totalProductionVolumeGroup5,2);?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Damage Group 5</td>
            <td><?php echo $totalDamage515Group5; ?> </td>
            <td><?php echo $totalDamage1530Group5;?> </td>
            <td><?php echo $totalDamage4530Group5;?> </td>
            <td><?php echo $totalDamage4560Group5;?> </td>
            <td><?php echo $totalDamage60Group5;?> </td>
            <td><?php echo $totalDamageGroup5;?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Growth30 Group 5</td>
            <td><?php echo number_format($totalGrowth30Volume515Group5,2); ?> </td>
            <td><?php echo number_format($totalGrowth30Volume1530Group5,2);?> </td>
            <td><?php echo number_format($totalGrowth30Volume3045Group5,2);?> </td>
            <td><?php echo number_format($totalGrowth30Volume4560Group5,2);?> </td>
            <td><?php echo number_format($totalGrowth30Volume60Group5,2);?> </td>
            <td><?php echo number_format($totalGrowth30VolumeGroup5,2);?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Production30 Group 5</td>
            <td><?php echo number_format($totalProduction30Volume515Group5,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume1530Group5,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume3045Group5,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume4560Group5,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume60Group5,2);?> </td>
            <td><?php echo number_format($totalProduction30VolumeGroup5,2);?> </td>
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

        <tr>
            <td></td>
            <td>Volume Group 6</td>
            <td> <?php echo number_format( $totalVolumeNonDipNonMarket1, 2); ?> </td>
            <td> <?php echo number_format($totalVolume1530Spgroup6, 2); ?> </td>
            <td> <?php echo number_format($totalVolume3045Spgroup6, 2); ?> </td>
            <td> <?php echo number_format($totalVolume4560Spgroup6, 2); ?> </td>
            <td> <?php echo number_format($totalVolume60Spgroup6, 2); ?> </td>
            <td> <?php echo number_format($totalVolumeGroup6, 2); ?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Production Group 6</td>
            <td> <?php echo number_format($totalProductionVolumeGroup6,2); ?> </td>
            <td><?php echo number_format($totalProductionVolume1530Group6,2);?> </td>
            <td><?php echo number_format($totalProductionVolume3045Group6,2);?> </td>
            <td><?php echo number_format($totalProductionVolume4560Group6,2);?> </td>
            <td><?php echo number_format($totalProductionVolume60Group6,2);?> </td>
            <td><?php echo number_format($totalProductionVolumeGroup6,2);?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Damage Group 6</td>
            <td><?php echo $totalDamage515Group6; ?> </td>
            <td><?php echo $totalDamage1530Group6;?> </td>
            <td><?php echo $totalDamage4530Group6;?> </td>
            <td><?php echo $totalDamage4560Group6;?> </td>
            <td><?php echo $totalDamage60Group6;?> </td>
            <td><?php echo $totalDamageGroup6;?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Growth30 Group 6</td>
            <td><?php echo number_format($totalGrowth30Volume515Group6,2); ?> </td>
            <td><?php echo number_format($totalGrowth30Volume1530Group6,2);?> </td>
            <td><?php echo number_format($totalGrowth30Volume3045Group6,2);?> </td>
            <td><?php echo number_format($totalGrowth30Volume4560Group6,2);?> </td>
            <td><?php echo number_format($totalGrowth30Volume60Group6,2);?> </td>
            <td><?php echo number_format($totalGrowth30VolumeGroup6,2);?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Production30 Group 6</td>
            <td><?php echo number_format($totalProduction30Volume515Group6,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume1530Group6,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume3045Group6,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume4560Group6,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume60Group6,2);?> </td>
            <td><?php echo number_format($totalProduction30VolumeGroup6,2);?> </td>
        </tr>

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
            <td></td>
            <td >Volume Group 7</td> 
            <td> <?php echo number_format( $totalVolumeOthers1,2); ?> </td>
            <td> <?php echo number_format($totalVolume1530Spgroup7,2); ?> </td>
            <td> <?php echo number_format($totalVolume3045Spgroup7,2); ?> </td>
            <td> <?php echo number_format($totalVolume4560Spgroup7,2); ?> </td>
            <td> <?php echo number_format($totalVolume60Spgroup7,2); ?> </td>
            <td> <?php echo number_format($totalVolumeGroup7,2); ?> </td>    
        </tr>

        <tr>
            <td></td>
            <td>Production Group 7</td>
            <td><?php echo number_format($totalProductionVolumeGroup7,2); ?> </td>
            <td><?php echo number_format($totalProductionVolume1530Group7,2);?> </td>
            <td><?php echo number_format($totalProductionVolume3045Group7,2);?> </td>
            <td><?php echo number_format($totalProductionVolume4560Group7,2);?> </td>
            <td><?php echo number_format($totalProductionVolume60Group7,2);?> </td>
            <td><?php echo number_format($totalProductionVolumeGroup7,2);?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Damage Group 7</td>
            <td><?php echo $totalDamage515Group7;?> </td>
            <td><?php echo $totalDamage1530Group7;?> </td>
            <td><?php echo $totalDamage4530Group7; ?> </td>
            <td><?php echo $totalDamage4560Group7;?> </td>
            <td><?php echo $totalDamage60Group7;?> </td>
            <td><?php echo $totalDamageGroup7;?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Growth30 Group 7</td>
            <td><?php echo number_format($totalGrowth30Volume515Group7,2); ?> </td>
            <td><?php echo number_format($totalGrowth30Volume1530Group7,2);?> </td>
            <td><?php echo number_format($totalGrowth30Volume3045Group7,2);?> </td>
            <td><?php echo number_format($totalGrowth30Volume4560Group7,2);?> </td>
            <td><?php echo number_format($totalGrowth30Volume60Group7,2);?> </td>
            <td><?php echo number_format($totalGrowth30VolumeGroup7,2);?> </td>
        </tr>

        <tr>
            <td></td>
            <td>Production30 Group 7</td>
            <td><?php echo number_format($totalProduction30Volume515Group7,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume1530Group7,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume3045Group7,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume4560Group7,2);?> </td>
            <td><?php echo number_format($totalProduction30Volume60Group7,2);?> </td>
            <td><?php echo number_format($totalProduction30VolumeGroup7,2);?> </td>
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
