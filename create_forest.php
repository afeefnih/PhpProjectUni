<?php

DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'tree');


// Make the connection:
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

// Set the encoding...
mysqli_set_charset($dbc, 'utf8');



$NoBlockX = 10;
$NoBlockY = 10;
$NoGroupSpecies = 7;
$NumDclass = 5;
$TreePerha = array_fill(0, $NoGroupSpecies, array_fill(0, $NumDclass, 0)); // Assuming TreePerha is a 2D array initialized elsewhere
$ListSpecies = array_fill(0, 318, array_fill(0, 318, 0)); // Assuming ListSpecies is a 2D array initialized elsewhere

echo "<table border='1'>";
echo "<tr><th>No.</th><th>Block</th><th>Group Species</th><th>Class</th><th>X</th><th>Y</th><th>Species</th><th>Diameter</th><th>Height</th></tr>";

$count = 1; // Initialize counter

for ($IX = 1; $IX <= $NoBlockX; $IX++) {
    for ($JY = 1; $JY <= $NoBlockY; $JY++) {


        $blockx = $IX;
        $blocky = $JY;

        for ($I = 1; $I <= $NoGroupSpecies; $I++) {
            for ($J = 1; $J <= $NumDclass; $J++) {
                $NumTree = isset($TreePerha[$I - 1][$J - 1]) ? $TreePerha[$I - 1][$J - 1] : 0;
                $species = 0; // Initialize $species here
                if ($I == 1) {
                    $SquenceSp = rand(1, 1);
                } elseif ($I == 2) {
                    $SquenceSp = rand(2, 6);
                } elseif ($I == 3) {
                    $SquenceSp = rand(7, 19);
                } elseif ($I == 4) {
                    $SquenceSp = rand(19, 60);
                } elseif ($I == 5) {
                    $SquenceSp = rand(61, 150);
                } elseif ($I == 6) {
                    $SquenceSp = rand(151, 250);
                } elseif ($I == 7) {
                    $SquenceSp = rand(251, 318);
                }
                $species = $SquenceSp;

                if ($J == 1) {
                    $diameter1 = rand(500, 1500) / 100;
                } elseif ($J == 2) {
                    $diameter1 = rand(1500, 3000) / 100;
                } elseif ($J == 3) {
                    $diameter1 = rand(3000, 4500) / 100;
                } elseif ($J == 4) {
                    $diameter1 = rand(4500, 6000) / 100;
                } elseif ($J == 5) {
                    $diameter1 = rand(6000, 20000) / 100;
                }
                $diameter = $diameter1;

                if ($J == 1) {
                    $height1 = rand(250, 550) / 100;
                } elseif ($J == 2) {
                    $height1 = rand(550, 1000) / 100;
                } elseif ($J == 3) {
                    $height1 = rand(1000, 1500) / 100;
                } elseif ($J == 4) {
                    $height1 = rand(1500, 4000) / 100;
                } elseif ($J == 5) {
                    $height1 = rand(4000, 10000)/100;
                }
                $height = $height1;

                $locationx = rand(1, 100);
                $locationy = rand(1, 100);
                $x = ($blockx - 1) * 100 + $locationx;
                $y = ($blocky - 1) * 100 + $locationy;

                // Output as table rows with numbering
                echo "<tr><td>$count</td><td>($blockx, $blocky)</td><td>$I</td><td>$J</td><td>$x</td><td>$y</td><td>$species</td><td>$diameter</td><td>$height</td></tr>";
               
#--code to store data into database--
                
$q = "INSERT INTO newforestori (BlockX, BlockY, species, Diameter,DiameterClass, StemHeight, X, Y,spgroup) VALUES ('$blockx', '$blocky', '$species', '$diameter','$J', '$height', '$x', '$y','$I')";
               $r = mysqli_query($dbc, $q);
               if (!$r) {
                  die('Error: ' . mysqli_error($dbc));
              }
                
             $count++; // Increment counter
               
       }
      }
    }
}

$sql1 = "UPDATE newforestori INNER JOIN speciesname ON newforestori.species = speciesname.No SET newforestori.species = speciesname.No";
$result1 = mysqli_query($dbc, $sql1);
if (!$result1) {
    die('Error executing query 1: ' . mysqli_error($dbc));
}

$sql2 = "UPDATE newforestori SET Volume = 3.142 * POW((Diameter / 200), 2) * StemHeight * 0.50";
$result2 = mysqli_query($dbc, $sql2);
if (!$result2) {
    die('Error executing query 2: ' . mysqli_error($dbc));
}

$sql3 = "UPDATE newforestori SET TreeNum = CONCAT('T', LPAD(BlockX, 2, '0'), LPAD(BlockY, 2, '0'), LPAD(x, 2, '0'), LPAD(y, 2, '0'))";
$result3 = mysqli_query($dbc, $sql3);
if (!$result3) {
    die('Error executing query 3: ' . mysqli_error($dbc));
}
$sql4 = "UPDATE newforestori SET status_tree = CASE WHEN spgroup IN (1, 2, 3, 5) AND Diameter > 45 THEN 'Cut' WHEN spgroup IN (1, 2, 3, 5) AND Diameter <= 45 THEN 'Keep' ELSE status_tree END";
$result4 = mysqli_query($dbc, $sql4);
if (!$result4) {
    die('Error executing query 4: ' . mysqli_error($dbc));
}

$sql5 = "UPDATE newforestori INNER JOIN speciesname ON speciesname.No = newforestori.species SET newforestori.species = speciesname.SPECODE";
$result5 = mysqli_query($dbc, $sql5);
if (!$result5) {
    die('Error executing query 5: ' . mysqli_error($dbc));
}



echo "</table>";

?>
