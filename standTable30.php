<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
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
            background-color: #f2f2f2;
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



$VolumeMersawaSQL = "SELECT SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 1";
$result = mysqli_query($dbc, $VolumeMersawaSQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalVolumeMersawa = $row['totalVolume'];
} else {
    $totalVolumeMersawa = 0; // Handle the case where there are no rows returned
}

$VolumeKeruingSQL = "SELECT SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 2";
$result = mysqli_query($dbc, $VolumeKeruingSQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalVolumeKeruing = $row['totalVolume'];
} else {
    $totalVolumeKeruing = 0; // Handle the case where there are no rows returned
}

$VolumeDipMarketSQL = "SELECT SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 3";
$result = mysqli_query($dbc, $VolumeDipMarketSQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalVolumeDipMarket = $row['totalVolume'];
} else {
    $totalVolumeDipMarket = 0; // Handle the case where there are no rows returned
}

$VolumeDipNonMarketSQL = "SELECT SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 4";
$result = mysqli_query($dbc, $VolumeDipNonMarketSQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalVolumeDipNonMarket = $row['totalVolume'];
} else {
    $totalVolumeDipNonMarket = 0; // Handle the case where there are no rows returned
}

$VolumeNonDipMarketSQL = "SELECT SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 5";
$result = mysqli_query($dbc, $VolumeNonDipMarketSQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalVolumeNonDipMarket = $row['totalVolume'];
} else {
    $totalVolumeNonDipMarket = 0; // Handle the case where there are no rows returned
}

$VolumeNonDipNonMarketSQL = "SELECT SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 6";
$result = mysqli_query($dbc, $VolumeNonDipNonMarketSQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalVolumeNonDipNonMarket = $row['totalVolume'];
} else {
    $totalVolumeNonDipNonMarket = 0; // Handle the case where there are no rows returned
}

$VolumeOthersSQL = "SELECT SUM(volume) AS totalVolume FROM newforestori WHERE spgroup = 7";
$result = mysqli_query($dbc, $VolumeOthersSQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalVolumeOthers = $row['totalVolume'];
} else {
    $totalVolumeOthers = 0; // Handle the case where there are no rows returned
}

$CountTreesSpgroup1SQL = "SELECT COUNT(*) AS totalTrees FROM newforestori WHERE spgroup = 1";
$result = mysqli_query($dbc, $CountTreesSpgroup1SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalTreesSpgroup1 = $row['totalTrees'];
}

$CountTreesSpgroup2SQL = "SELECT COUNT(*) AS totalTrees FROM newforestori WHERE spgroup = 2";
$result = mysqli_query($dbc, $CountTreesSpgroup2SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalTreesSpgroup2 = $row['totalTrees'];
}

$CountTreesSpgroup3SQL = "SELECT COUNT(*) AS totalTrees FROM newforestori WHERE spgroup = 3";
$result = mysqli_query($dbc, $CountTreesSpgroup3SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalTreesSpgroup3 = $row['totalTrees'];
}

$CountTreesSpgroup4SQL = "SELECT COUNT(*) AS totalTrees FROM newforestori WHERE spgroup = 4";
$result = mysqli_query($dbc, $CountTreesSpgroup4SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalTreesSpgroup4 = $row['totalTrees'];
}

$CountTreesSpgroup5SQL = "SELECT COUNT(*) AS totalTrees FROM newforestori WHERE spgroup = 5";

$result = mysqli_query($dbc, $CountTreesSpgroup5SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalTreesSpgroup5 = $row['totalTrees'];
}

$CountTreesSpgroup6SQL = "SELECT COUNT(*) AS totalTrees FROM newforestori WHERE spgroup = 6";

$result = mysqli_query($dbc, $CountTreesSpgroup6SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalTreesSpgroup6 = $row['totalTrees'];
}

$CountTreesSpgroup7SQL = "SELECT COUNT(*) AS totalTrees FROM newforestori WHERE spgroup = 7";

$result = mysqli_query($dbc, $CountTreesSpgroup7SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalTreesSpgroup7 = $row['totalTrees'];
}

$ProductionTreesSpgroup1SQL = "SELECT SUM(production) AS totalProduction FROM newforestori WHERE spgroup = 1";

$result = mysqli_query($dbc, $ProductionTreesSpgroup1SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProductionSpgroup1 = $row['totalProduction'];
}

$ProductionTreesSpgroup2SQL = "SELECT SUM(production) AS totalProduction FROM newforestori WHERE spgroup = 2";

$result = mysqli_query($dbc, $ProductionTreesSpgroup2SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProductionSpgroup2 = $row['totalProduction'];
}


$ProductionTreesSpgroup3SQL = "SELECT SUM(production) AS totalProduction FROM newforestori WHERE spgroup = 3";

$result = mysqli_query($dbc, $ProductionTreesSpgroup3SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProductionSpgroup3 = $row['totalProduction'];
}

$ProductionTreesSpgroup4SQL = "SELECT SUM(production) AS totalProduction FROM newforestori WHERE spgroup = 4";

$result = mysqli_query($dbc, $ProductionTreesSpgroup4SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProductionSpgroup4 = $row['totalProduction'];
}

$ProductionTreesSpgroup5SQL = "SELECT SUM(production) AS totalProduction FROM newforestori WHERE spgroup = 5";

$result = mysqli_query($dbc, $ProductionTreesSpgroup5SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProductionSpgroup5 = $row['totalProduction'];
}

$ProductionTreesSpgroup6SQL = "SELECT SUM(production) AS totalProduction FROM newforestori WHERE spgroup = 6";

$result = mysqli_query($dbc, $ProductionTreesSpgroup6SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProductionSpgroup6 = $row['totalProduction'];
}

$ProductionTreesSpgroup7SQL = "SELECT SUM(production) AS totalProduction FROM newforestori WHERE spgroup = 7";

$result = mysqli_query($dbc, $ProductionTreesSpgroup7SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProductionSpgroup7 = $row['totalProduction'];
}

$DamageCrownSpgroup1SQL = "SELECT SUM(damage_crown) AS totalDamageCrown FROM newforestori WHERE spgroup = 1";

$result = mysqli_query($dbc, $DamageCrownSpgroup1SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageCrownSpgroup1 = $row['totalDamageCrown'];
}

$DamageCrownSpgroup2SQL = "SELECT SUM(damage_crown) AS totalDamageCrown FROM newforestori WHERE spgroup = 2";

$result = mysqli_query($dbc, $DamageCrownSpgroup2SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageCrownSpgroup2 = $row['totalDamageCrown'];
}

$DamageCrownSpgroup3SQL = "SELECT SUM(damage_crown) AS totalDamageCrown FROM newforestori WHERE spgroup = 3";

$result = mysqli_query($dbc, $DamageCrownSpgroup3SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageCrownSpgroup3 = $row['totalDamageCrown'];
}

$DamageCrownSpgroup4SQL = "SELECT SUM(damage_crown) AS totalDamageCrown FROM newforestori WHERE spgroup = 4";

$result = mysqli_query($dbc, $DamageCrownSpgroup4SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageCrownSpgroup4 = $row['totalDamageCrown'];
}

$DamageCrownSpgroup5SQL = "SELECT SUM(damage_crown) AS totalDamageCrown FROM newforestori WHERE spgroup = 5";

$result = mysqli_query($dbc, $DamageCrownSpgroup5SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageCrownSpgroup5 = $row['totalDamageCrown'];
}

$DamageCrownSpgroup6SQL = "SELECT SUM(damage_crown) AS totalDamageCrown FROM newforestori WHERE spgroup = 6";

$result = mysqli_query($dbc, $DamageCrownSpgroup6SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageCrownSpgroup6 = $row['totalDamageCrown'];
}

$DamageCrownSpgroup7SQL = "SELECT SUM(damage_crown) AS totalDamageCrown FROM newforestori WHERE spgroup = 7";

$result = mysqli_query($dbc, $DamageCrownSpgroup7SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageCrownSpgroup7 = $row['totalDamageCrown'];
}

$DamageStemSpgroup1SQL = "SELECT SUM(damage_stem) AS totalDamageStem FROM newforestori WHERE spgroup = 1";

$result = mysqli_query($dbc, $DamageStemSpgroup1SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageStemSpgroup1 = $row['totalDamageStem'];
}

$DamageStemSpgroup2SQL = "SELECT SUM(damage_stem) AS totalDamageStem FROM newforestori WHERE spgroup = 2";

$result = mysqli_query($dbc, $DamageStemSpgroup2SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageStemSpgroup2 = $row['totalDamageStem'];
}

$DamageStemSpgroup3SQL = "SELECT SUM(damage_stem) AS totalDamageStem FROM newforestori WHERE spgroup = 3";

$result = mysqli_query($dbc, $DamageStemSpgroup3SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageStemSpgroup3 = $row['totalDamageStem'];
}

$DamageStemSpgroup4SQL = "SELECT SUM(damage_stem) AS totalDamageStem FROM newforestori WHERE spgroup = 4";

$result = mysqli_query($dbc, $DamageStemSpgroup4SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageStemSpgroup4 = $row['totalDamageStem'];
}

$DamageStemSpgroup5SQL = "SELECT SUM(damage_stem) AS totalDamageStem FROM newforestori WHERE spgroup = 5";

$result = mysqli_query($dbc, $DamageStemSpgroup5SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageStemSpgroup5 = $row['totalDamageStem'];
}

$DamageStemSpgroup6SQL = "SELECT SUM(damage_stem) AS totalDamageStem FROM newforestori WHERE spgroup = 6";

$result = mysqli_query($dbc, $DamageStemSpgroup6SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageStemSpgroup6 = $row['totalDamageStem'];
}

$DamageStemSpgroup7SQL = "SELECT SUM(damage_stem) AS totalDamageStem FROM newforestori WHERE spgroup = 7";

$result = mysqli_query($dbc, $DamageStemSpgroup7SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalDamageStemSpgroup7 = $row['totalDamageStem'];
}

$Growth30Spgroup1SQL = "SELECT SUM(Growth30) AS totalGrowth30 FROM newforestori WHERE spgroup = 1";

$result = mysqli_query($dbc, $Growth30Spgroup1SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalGrowth30Spgroup1 = $row['totalGrowth30'];
}

$Growth30Spgroup2SQL = "SELECT SUM(Growth30) AS totalGrowth30 FROM newforestori WHERE spgroup = 2";

$result = mysqli_query($dbc, $Growth30Spgroup2SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalGrowth30Spgroup2 = $row['totalGrowth30'];
}

$Growth30Spgroup3SQL = "SELECT SUM(Growth30) AS totalGrowth30 FROM newforestori WHERE spgroup = 3";

$result = mysqli_query($dbc, $Growth30Spgroup3SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalGrowth30Spgroup3 = $row['totalGrowth30'];
}

$Growth30Spgroup4SQL = "SELECT SUM(Growth30) AS totalGrowth30 FROM newforestori WHERE spgroup = 4";

$result = mysqli_query($dbc, $Growth30Spgroup4SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalGrowth30Spgroup4 = $row['totalGrowth30'];
}

$Growth30Spgroup5SQL = "SELECT SUM(Growth30) AS totalGrowth30 FROM newforestori WHERE spgroup = 5";

$result = mysqli_query($dbc, $Growth30Spgroup5SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalGrowth30Spgroup5 = $row['totalGrowth30'];
}

$Growth30Spgroup6SQL = "SELECT SUM(Growth30) AS totalGrowth30 FROM newforestori WHERE spgroup = 6";

$result = mysqli_query($dbc, $Growth30Spgroup6SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalGrowth30Spgroup6 = $row['totalGrowth30'];
}

$Growth30Spgroup7SQL = "SELECT SUM(Growth30) AS totalGrowth30 FROM newforestori WHERE spgroup = 7";

$result = mysqli_query($dbc, $Growth30Spgroup7SQL);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalGrowth30Spgroup7 = $row['totalGrowth30'];
}


?>
</head>
<body>
    <table border="1" width="100%">
        <tr>
            <td>
                Species Group
            </td>
            <td>
                Volume
            </td>
            <td>
                number
            </td>
            <td>
                Production
            </td>
            <td>
                Damage Crown
            </td>
            <td>
                Damage Stem
            </td>
            <td>
                Growth 30
            </td>
        </tr>

        <tr>
            <td> Mersawa </td>
            <td> <?php echo $totalVolumeMersawa; ?> </td>
            <td> <?php echo $totalTreesSpgroup1; ?> </td>
            <td> <?php echo $totalProductionSpgroup1; ?> </td>
            <td> <?php echo $totalDamageCrownSpgroup1; ?> </td>
            <td> <?php echo $totalDamageStemSpgroup1; ?> </td>
            <td> <?php echo $totalGrowth30Spgroup1; ?> </td>
        </tr>

        <tr>
            <td> Keruing </td>
            <td> <?php echo $totalVolumeKeruing; ?> </td>
            <td> <?php echo $totalTreesSpgroup2; ?> </td>
            <td> <?php echo $totalProductionSpgroup2; ?> </td>
            <td> <?php echo $totalDamageCrownSpgroup2; ?> </td>
            <td> <?php echo $totalDamageStemSpgroup2; ?> </td>
            <td> <?php echo $totalGrowth30Spgroup2; ?> </td>
        </tr>
        <tr>
            <td> Dip Marketable </td>
            <td> <?php echo $totalVolumeDipMarket; ?> </td>
            <td> <?php echo $totalTreesSpgroup3; ?> </td>
            <td> <?php echo $totalProductionSpgroup3; ?> </td>
            <td> <?php echo $totalDamageCrownSpgroup3; ?> </td>
            <td> <?php echo $totalDamageStemSpgroup3; ?> </td>
            <td> <?php echo $totalGrowth30Spgroup3; ?> </td>
        </tr>
        <tr>
            <td> Dip non Market </td>
            <td> <?php echo $totalVolumeDipNonMarket; ?> </td>
            <td> <?php echo $totalTreesSpgroup4; ?> </td>
            <td> <?php echo $totalProductionSpgroup4; ?> </td>
            <td> <?php echo $totalDamageCrownSpgroup4; ?> </td>
            <td> <?php echo $totalDamageStemSpgroup4; ?> </td>
            <td> <?php echo $totalGrowth30Spgroup4; ?> </td>
        </tr>
        <tr>
            <td> Non Dip Market </td>
            <td> <?php echo $totalVolumeNonDipMarket; ?> </td>
            <td> <?php echo $totalTreesSpgroup5; ?> </td>
            <td> <?php echo $totalProductionSpgroup5; ?> </td>
            <td> <?php echo $totalDamageCrownSpgroup5; ?> </td>
            <td> <?php echo $totalDamageStemSpgroup5; ?> </td>
            <td> <?php echo $totalGrowth30Spgroup5; ?> </td>
        </tr>
        <tr>
            <td> Non Dip Non Market </td>
            <td> <?php echo $totalVolumeNonDipNonMarket; ?> </td>
            <td> <?php echo $totalTreesSpgroup6; ?> </td>
            <td> <?php echo $totalProductionSpgroup6; ?> </td>
            <td> <?php echo $totalDamageCrownSpgroup6; ?> </td>
            <td> <?php echo $totalDamageStemSpgroup6; ?> </td>
            <td> <?php echo $totalGrowth30Spgroup6; ?> </td>
        </tr>
        <tr>
            <td> others </td>
            <td> <?php echo $totalVolumeOthers; ?> </td>
            <td> <?php echo $totalTreesSpgroup7; ?> </td>
            <td> <?php echo $totalProductionSpgroup7; ?> </td>
            <td> <?php echo $totalDamageCrownSpgroup7; ?> </td>
            <td> <?php echo $totalDamageStemSpgroup7; ?> </td>
            <td> <?php echo $totalGrowth30Spgroup7; ?> </td>
        </tr>
    </table>
</body>
</html>

