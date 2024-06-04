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


/*-------------------------------  Volume ---------------------------------------*/
$VolumeMersawaSQL = "SELECT SUM(volume) AS totalVolume FROM regime65 WHERE spgroup = 1";
$result = mysqli_query($dbc, $VolumeMersawaSQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalVolumeMersawa = $row['totalVolume'];
} else {
    $totalVolumeMersawa = 0; // Handle the case where there are no rows returned
}

$VolumeKeruingSQL = "SELECT SUM(volume) AS totalVolume FROM regime65 WHERE spgroup = 2";
$result = mysqli_query($dbc, $VolumeKeruingSQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalVolumeKeruing = $row['totalVolume'];
} else {
    $totalVolumeKeruing = 0; // Handle the case where there are no rows returned
}

$VolumeDipMarketSQL = "SELECT SUM(volume) AS totalVolume FROM regime65 WHERE spgroup = 3";
$result = mysqli_query($dbc, $VolumeDipMarketSQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalVolumeDipMarket = $row['totalVolume'];
} else {
    $totalVolumeDipMarket = 0; // Handle the case where there are no rows returned
}

$VolumeDipNonMarketSQL = "SELECT SUM(volume) AS totalVolume FROM regime65 WHERE spgroup = 4";
$result = mysqli_query($dbc, $VolumeDipNonMarketSQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalVolumeDipNonMarket = $row['totalVolume'];
} else {
    $totalVolumeDipNonMarket = 0; // Handle the case where there are no rows returned
}

$VolumeNonDipMarketSQL = "SELECT SUM(volume) AS totalVolume FROM regime65 WHERE spgroup = 5";
$result = mysqli_query($dbc, $VolumeNonDipMarketSQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalVolumeNonDipMarket = $row['totalVolume'];
} else {
    $totalVolumeNonDipMarket = 0; // Handle the case where there are no rows returned
}

$VolumeNonDipNonMarketSQL = "SELECT SUM(volume) AS totalVolume FROM regime65 WHERE spgroup = 6";
$result = mysqli_query($dbc, $VolumeNonDipNonMarketSQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalVolumeNonDipNonMarket = $row['totalVolume'];
} else {
    $totalVolumeNonDipNonMarket = 0; // Handle the case where there are no rows returned
}

$VolumeOthersSQL = "SELECT SUM(volume) AS totalVolume FROM regime65 WHERE spgroup = 7";
$result = mysqli_query($dbc, $VolumeOthersSQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalVolumeOthers = $row['totalVolume'];
} else {
    $totalVolumeOthers = 0; // Handle the case where there are no rows returned
}


/*-------------------------------  Number of tree  ---------------------------------------*/
$CountTreesSpgroup1SQL = "SELECT COUNT(*) AS totalTrees FROM regime65 WHERE spgroup = 1";
$result = mysqli_query($dbc, $CountTreesSpgroup1SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalTreesSpgroup1 = $row['totalTrees'];
}

$CountTreesSpgroup2SQL = "SELECT COUNT(*) AS totalTrees FROM regime65 WHERE spgroup = 2";
$result = mysqli_query($dbc, $CountTreesSpgroup2SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalTreesSpgroup2 = $row['totalTrees'];
}

$CountTreesSpgroup3SQL = "SELECT COUNT(*) AS totalTrees FROM regime65 WHERE spgroup = 3";
$result = mysqli_query($dbc, $CountTreesSpgroup3SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalTreesSpgroup3 = $row['totalTrees'];
}

$CountTreesSpgroup4SQL = "SELECT COUNT(*) AS totalTrees FROM regime65 WHERE spgroup = 4";
$result = mysqli_query($dbc, $CountTreesSpgroup4SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalTreesSpgroup4 = $row['totalTrees'];
}

$CountTreesSpgroup5SQL = "SELECT COUNT(*) AS totalTrees FROM regime65 WHERE spgroup = 5";

$result = mysqli_query($dbc, $CountTreesSpgroup5SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalTreesSpgroup5 = $row['totalTrees'];
}

$CountTreesSpgroup6SQL = "SELECT COUNT(*) AS totalTrees FROM regime65 WHERE spgroup = 6";

$result = mysqli_query($dbc, $CountTreesSpgroup6SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalTreesSpgroup6 = $row['totalTrees'];
}

$CountTreesSpgroup7SQL = "SELECT COUNT(*) AS totalTrees FROM regime65 WHERE spgroup = 7";

$result = mysqli_query($dbc, $CountTreesSpgroup7SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalTreesSpgroup7 = $row['totalTrees'];
}

/*-------------------------------  Production  ---------------------------------------*/
$ProductionTreesSpgroup1SQL = "SELECT SUM(production) AS totalProduction FROM regime65 WHERE spgroup = 1";

$result = mysqli_query($dbc, $ProductionTreesSpgroup1SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProductionSpgroup1 = $row['totalProduction'];
}

$ProductionTreesSpgroup2SQL = "SELECT SUM(production) AS totalProduction FROM regime65 WHERE spgroup = 2";

$result = mysqli_query($dbc, $ProductionTreesSpgroup2SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProductionSpgroup2 = $row['totalProduction'];
}


$ProductionTreesSpgroup3SQL = "SELECT SUM(production) AS totalProduction FROM regime65 WHERE spgroup = 3";

$result = mysqli_query($dbc, $ProductionTreesSpgroup3SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProductionSpgroup3 = $row['totalProduction'];
}

$ProductionTreesSpgroup4SQL = "SELECT SUM(production) AS totalProduction FROM regime65 WHERE spgroup = 4";

$result = mysqli_query($dbc, $ProductionTreesSpgroup4SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProductionSpgroup4 = $row['totalProduction'];
}

$ProductionTreesSpgroup5SQL = "SELECT SUM(production) AS totalProduction FROM regime65 WHERE spgroup = 5";

$result = mysqli_query($dbc, $ProductionTreesSpgroup5SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProductionSpgroup5 = $row['totalProduction'];
}

$ProductionTreesSpgroup6SQL = "SELECT SUM(production) AS totalProduction FROM regime65 WHERE spgroup = 6";

$result = mysqli_query($dbc, $ProductionTreesSpgroup6SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProductionSpgroup6 = $row['totalProduction'];
}

$ProductionTreesSpgroup7SQL = "SELECT SUM(production) AS totalProduction FROM regime65 WHERE spgroup = 7";

$result = mysqli_query($dbc, $ProductionTreesSpgroup7SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProductionSpgroup7 = $row['totalProduction'];
}

/*-------------------------------  Damage Crown  ---------------------------------------*/
$DamageCrownSpgroup1SQL = "SELECT SUM(damage_crown) AS totalDamageCrown FROM regime65 WHERE spgroup = 1";

$result = mysqli_query($dbc, $DamageCrownSpgroup1SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageCrownSpgroup1 = $row['totalDamageCrown'];
}

$DamageCrownSpgroup2SQL = "SELECT SUM(damage_crown) AS totalDamageCrown FROM regime65 WHERE spgroup = 2";

$result = mysqli_query($dbc, $DamageCrownSpgroup2SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageCrownSpgroup2 = $row['totalDamageCrown'];
}

$DamageCrownSpgroup3SQL = "SELECT SUM(damage_crown) AS totalDamageCrown FROM regime65 WHERE spgroup = 3";

$result = mysqli_query($dbc, $DamageCrownSpgroup3SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageCrownSpgroup3 = $row['totalDamageCrown'];
}

$DamageCrownSpgroup4SQL = "SELECT SUM(damage_crown) AS totalDamageCrown FROM regime65 WHERE spgroup = 4";

$result = mysqli_query($dbc, $DamageCrownSpgroup4SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageCrownSpgroup4 = $row['totalDamageCrown'];
}

$DamageCrownSpgroup5SQL = "SELECT SUM(damage_crown) AS totalDamageCrown FROM regime65 WHERE spgroup = 5";

$result = mysqli_query($dbc, $DamageCrownSpgroup5SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageCrownSpgroup5 = $row['totalDamageCrown'];
}

$DamageCrownSpgroup6SQL = "SELECT SUM(damage_crown) AS totalDamageCrown FROM regime65 WHERE spgroup = 6";

$result = mysqli_query($dbc, $DamageCrownSpgroup6SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageCrownSpgroup6 = $row['totalDamageCrown'];
}

$DamageCrownSpgroup7SQL = "SELECT SUM(damage_crown) AS totalDamageCrown FROM regime65 WHERE spgroup = 7";

$result = mysqli_query($dbc, $DamageCrownSpgroup7SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageCrownSpgroup7 = $row['totalDamageCrown'];
}

/*-------------------------------  Damage stem  ---------------------------------------*/
$DamageStemSpgroup1SQL = "SELECT SUM(damage_stem) AS totalDamageStem FROM regime65 WHERE spgroup = 1";

$result = mysqli_query($dbc, $DamageStemSpgroup1SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageStemSpgroup1 = $row['totalDamageStem'];
}

$DamageStemSpgroup2SQL = "SELECT SUM(damage_stem) AS totalDamageStem FROM regime65 WHERE spgroup = 2";

$result = mysqli_query($dbc, $DamageStemSpgroup2SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageStemSpgroup2 = $row['totalDamageStem'];
}

$DamageStemSpgroup3SQL = "SELECT SUM(damage_stem) AS totalDamageStem FROM regime65 WHERE spgroup = 3";

$result = mysqli_query($dbc, $DamageStemSpgroup3SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageStemSpgroup3 = $row['totalDamageStem'];
}

$DamageStemSpgroup4SQL = "SELECT SUM(damage_stem) AS totalDamageStem FROM regime65 WHERE spgroup = 4";

$result = mysqli_query($dbc, $DamageStemSpgroup4SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageStemSpgroup4 = $row['totalDamageStem'];
}

$DamageStemSpgroup5SQL = "SELECT SUM(damage_stem) AS totalDamageStem FROM regime65 WHERE spgroup = 5";

$result = mysqli_query($dbc, $DamageStemSpgroup5SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageStemSpgroup5 = $row['totalDamageStem'];
}

$DamageStemSpgroup6SQL = "SELECT SUM(damage_stem) AS totalDamageStem FROM regime65 WHERE spgroup = 6";

$result = mysqli_query($dbc, $DamageStemSpgroup6SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageStemSpgroup6 = $row['totalDamageStem'];
}

$DamageStemSpgroup7SQL = "SELECT SUM(damage_stem) AS totalDamageStem FROM regime65 WHERE spgroup = 7";

$result = mysqli_query($dbc, $DamageStemSpgroup7SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageStemSpgroup7 = $row['totalDamageStem'];
}


/*-------------------------------  Growth30 ---------------------------------------*/
$Growth30Spgroup1SQL = "SELECT SUM(Growth30) AS totalGrowth30 FROM regime65 WHERE spgroup = 1";

$result = mysqli_query($dbc, $Growth30Spgroup1SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalGrowth30Spgroup1 = $row['totalGrowth30']/10000;
}

$Growth30Spgroup2SQL = "SELECT SUM(Growth30) AS totalGrowth30 FROM regime65 WHERE spgroup = 2";

$result = mysqli_query($dbc, $Growth30Spgroup2SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalGrowth30Spgroup2 = $row['totalGrowth30']/10000;
}

$Growth30Spgroup3SQL = "SELECT SUM(Growth30) AS totalGrowth30 FROM regime65 WHERE spgroup = 3";

$result = mysqli_query($dbc, $Growth30Spgroup3SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalGrowth30Spgroup3 = $row['totalGrowth30']/10000;
}

$Growth30Spgroup4SQL = "SELECT SUM(Growth30) AS totalGrowth30 FROM regime65 WHERE spgroup = 4";

$result = mysqli_query($dbc, $Growth30Spgroup4SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalGrowth30Spgroup4 = $row['totalGrowth30']/10000;
}

$Growth30Spgroup5SQL = "SELECT SUM(Growth30) AS totalGrowth30 FROM regime65 WHERE spgroup = 5";

$result = mysqli_query($dbc, $Growth30Spgroup5SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalGrowth30Spgroup5 = $row['totalGrowth30']/10000;
}

$Growth30Spgroup6SQL = "SELECT SUM(Growth30) AS totalGrowth30 FROM regime65 WHERE spgroup = 6";

$result = mysqli_query($dbc, $Growth30Spgroup6SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalGrowth30Spgroup6 = $row['totalGrowth30']/10000;
}

$Growth30Spgroup7SQL = "SELECT SUM(Growth30) AS totalGrowth30 FROM regime65 WHERE spgroup = 7";

$result = mysqli_query($dbc, $Growth30Spgroup7SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalGrowth30Spgroup7 = $row['totalGrowth30']/10000;
}

/*-------------------------------  Production30  ---------------------------------------*/
$Production30Spgroup1SQL = "SELECT SUM(Production30) AS totalProduction30 FROM regime65 WHERE spgroup = 1";

$result = mysqli_query($dbc, $Production30Spgroup1SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProduction30Spgroup1 = $row['totalProduction30']/10000;
}

$Production30Spgroup2SQL = "SELECT SUM(Production30) AS totalProduction30 FROM regime65 WHERE spgroup = 2";

$result = mysqli_query($dbc, $Production30Spgroup2SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProduction30Spgroup2 = $row['totalProduction30']/10000;
}

$Production30Spgroup3SQL = "SELECT SUM(Production30) AS totalProduction30 FROM regime65 WHERE spgroup = 3";

$result = mysqli_query($dbc, $Production30Spgroup3SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProduction30Spgroup3 = $row['totalProduction30']/10000;
}

$Production30Spgroup4SQL = "SELECT SUM(Production30) AS totalProduction30 FROM regime65 WHERE spgroup = 4";

$result = mysqli_query($dbc, $Production30Spgroup4SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProduction30Spgroup4 = $row['totalProduction30']/10000;
}

$Production30Spgroup5SQL = "SELECT SUM(Production30) AS totalProduction30 FROM regime65 WHERE spgroup = 5";

$result = mysqli_query($dbc, $Production30Spgroup5SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProduction30Spgroup5 = $row['totalProduction30']/10000;
}

$Production30Spgroup6SQL = "SELECT SUM(Production30) AS totalProduction30 FROM regime65 WHERE spgroup = 6";

$result = mysqli_query($dbc, $Production30Spgroup6SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProduction30Spgroup6 = $row['totalProduction30']/10000;
}

$Production30Spgroup7SQL = "SELECT SUM(Production30) AS totalProduction30 FROM regime65 WHERE spgroup = 7";

$result = mysqli_query($dbc, $Production30Spgroup7SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProduction30Spgroup7 = $row['totalProduction30']/10000;
}





?>
</head>
<body>
    <div class="container">
        <header>
            <h1>Summary Regim 65</h1>
        </header>
        <main>
        <table border="1" width="100%">
        <tr>
            <th>
                Species Group
            </th>
            <th>
                Volume
            </th>
            <th>
                number
            </th>
            <th>
                Production
            </th>
            <th>
                Damage Crown
            </th>
            <th>
                Damage Stem
            </th>
            <th>
                Growth 30
            </th>
            <th>
                Production 30
            </th>
        </tr>

        <tr>
            <td> Mersawa </td>
            <td> <?php echo number_format($totalVolumeMersawa, 2); ?> </td>
            <td> <?php echo $totalTreesSpgroup1; ?> </td>
            <td> <?php echo number_format($totalProductionSpgroup1,2); ?> </td>
            <td> <?php echo $totalDamageCrownSpgroup1; ?> </td>
            <td> <?php echo $totalDamageStemSpgroup1; ?> </td>
            <td> <?php echo number_format($totalGrowth30Spgroup1,2); ?> </td>
            <td> <?php echo number_format($totalProduction30Spgroup1,2); ?> </td>
        </tr>

        <tr>
            <td> Keruing </td>
            <td> <?php echo number_format($totalVolumeKeruing,2); ?> </td>
            <td> <?php echo $totalTreesSpgroup2; ?> </td>
            <td> <?php echo number_format($totalProductionSpgroup2,2); ?> </td>
            <td> <?php echo $totalDamageCrownSpgroup2; ?> </td>
            <td> <?php echo $totalDamageStemSpgroup2; ?> </td>
            <td> <?php echo number_format($totalGrowth30Spgroup2,2); ?> </td>
            <td> <?php echo number_format($totalProduction30Spgroup2,2); ?> </td>
        </tr>
        <tr>
            <td> Dip Marketable </td>
            <td> <?php echo number_format($totalVolumeDipMarket,2); ?> </td>
            <td> <?php echo $totalTreesSpgroup3; ?> </td>
            <td> <?php echo number_format($totalProductionSpgroup3,2); ?> </td>
            <td> <?php echo $totalDamageCrownSpgroup3; ?> </td>
            <td> <?php echo $totalDamageStemSpgroup3; ?> </td>
            <td> <?php echo number_format($totalGrowth30Spgroup3,2); ?> </td>
            <td> <?php echo number_format($totalProduction30Spgroup3,2); ?> </td>
        </tr>
        <tr>
            <td> Dip non Market </td>
            <td> <?php echo number_format($totalVolumeDipNonMarket,2); ?> </td>
            <td> <?php echo $totalTreesSpgroup4; ?> </td>
            <td> <?php echo number_format($totalProductionSpgroup4,2); ?> </td>
            <td> <?php echo $totalDamageCrownSpgroup4; ?> </td>
            <td> <?php echo $totalDamageStemSpgroup4; ?> </td>
            <td> <?php echo number_format($totalGrowth30Spgroup4,2); ?> </td>
            <td> <?php echo number_format($totalProduction30Spgroup4,2); ?> </td>
        </tr>
        <tr>
            <td> Non Dip Market </td>
            <td> <?php echo number_format($totalVolumeNonDipMarket,2); ?> </td>
            <td> <?php echo $totalTreesSpgroup5; ?> </td>
            <td> <?php echo number_format($totalProductionSpgroup5,2); ?> </td>
            <td> <?php echo $totalDamageCrownSpgroup5; ?> </td>
            <td> <?php echo $totalDamageStemSpgroup5; ?> </td>
            <td> <?php echo number_format($totalGrowth30Spgroup5,2); ?> </td>
            <td> <?php echo number_format($totalProduction30Spgroup5,2); ?> </td>
        </tr>
        <tr>
            <td> Non Dip Non Market </td>
            <td> <?php echo number_format($totalVolumeNonDipNonMarket,2); ?> </td>
            <td> <?php echo $totalTreesSpgroup6; ?> </td>
            <td> <?php echo number_format($totalProductionSpgroup6,2); ?> </td>
            <td> <?php echo $totalDamageCrownSpgroup6; ?> </td>
            <td> <?php echo $totalDamageStemSpgroup6; ?> </td>
            <td> <?php echo number_format($totalGrowth30Spgroup6,2); ?> </td>
            <td> <?php echo number_format($totalProduction30Spgroup6,2); ?> </td>
        </tr>
        <tr>
            <td> others </td>
            <td> <?php echo number_format($totalVolumeOthers,2); ?> </td>
            <td> <?php echo $totalTreesSpgroup7; ?> </td>
            <td> <?php echo number_format($totalProductionSpgroup7,2); ?> </td>
            <td> <?php echo $totalDamageCrownSpgroup7; ?> </td>
            <td> <?php echo $totalDamageStemSpgroup7; ?> </td>
            <td> <?php echo number_format($totalGrowth30Spgroup7,2); ?> </td>
            <td> <?php echo number_format($totalProduction30Spgroup7,2); ?> </td>
        </tr>
    </table>
        </main>
    </div>
</body>
</html>
