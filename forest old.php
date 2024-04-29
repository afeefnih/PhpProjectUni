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

$sql5 = "UPDATE newforestori SET Cut_Angle = CASE WHEN status_tree = 'Cut' THEN FLOOR(RAND() * 360) + 1 ELSE NULL END";
$result5 = mysqli_query($dbc, $sql5);
if (!$result5) {
    die('Error executing query 5: ' . mysqli_error($dbc));
}

// Filter trees based on their quadrant
$sql6 = "SELECT * FROM newforestori WHERE status_tree = 'Cut'";
$result6 = mysqli_query($dbc, $sql6);
if (!$result6) {
    die('Error executing query 6: ' . mysqli_error($dbc));
}

// Fetch and process the filtered data
// Fetch and process the filtered data
// Fetch and process the filtered data
while ($row = mysqli_fetch_assoc($result6)) {
    $x0 = $row['x'];
    $y0 = $row['y'];
    $cutAngle = $row['Cut_Angle'];
    $stemHeight = $row['StemHeight'];

    // Define additional buffer beyond the stem height
    $buffer = 10;  // 5 + 5 as described

    // Initialize the query to count affected trees
    $count_query = "";

    // Calculate the range for x and y based on the cutting angle
    if ($cutAngle >= 0 && $cutAngle < 90) {
        // Quadrant I: 0 - 90 degrees
        if ($cutAngle >= 0 && $cutAngle < 90) {
            // Quadrant I: 0 - 90 degrees
            $x_upper = $x0 + $stemHeight + $buffer;
        
            // Calculate y bounds based on the cut angle
            $y1_lower = $y0 + ($x_upper - $x0) / tan(deg2rad($cutAngle + 1));  // y at x_upper for angle θ+1
            $y2_lower = $y0 + ($x_upper - $x0) / tan(deg2rad($cutAngle - 1));  // y at x_upper for angle θ-1
        
            $y_upper = max($y1_lower, $y2_lower) + $buffer; // To ensure coverage of the entire possible damage range
            $y_lower = min($y1_lower, $y2_lower) - $buffer;
        
            // Now, adjust the SQL query to use these new y bounds
            $count_query = "SELECT COUNT(*) AS affected_count FROM newforestori WHERE status_tree != 'Cut' AND x > $x0 AND x < $x_upper AND y > $y_lower AND y < $y_upper";
        }
    } elseif ($cutAngle >= 90 && $cutAngle < 180) {
        // Quadrant II: 90 - 180 degrees
        $theta = 180 - $cutAngle;
        $x_lower = $x0 - ($stemHeight + $buffer);
        $y1_upper = $y0 - ($x0 - $x_lower) / tan(deg2rad($theta + 1));
        $y2_upper = $y0 - ($x0 - $x_lower) / tan(deg2rad($theta - 1));
        $y_upper = $y0 + $buffer;
        $y_lower = min($y1_upper, $y2_upper) - $buffer;
        $count_query = "SELECT COUNT(*) AS affected_count FROM newforestori WHERE status_tree != 'Cut' AND x < $x0 AND x > $x_lower AND y > $y_lower AND y < $y_upper";
    } elseif ($cutAngle >= 180 && $cutAngle < 270) {
        // Quadrant III: 180 - 270 degrees
        $theta = $cutAngle - 180;
        $x_lower = $x0 - ($stemHeight + $buffer);
        $y1_upper = $y0 - ($x0 - $x_lower) / tan(deg2rad($theta + 1));
        $y2_upper = $y0 - ($x0 - $x_lower) / tan(deg2rad($theta - 1));
        $y_upper = max($y1_upper, $y2_upper) + $buffer;
        $y_lower = $y0 - $buffer;
        $count_query = "SELECT COUNT(*) AS affected_count FROM newforestori WHERE status_tree != 'Cut' AND x < $x0 AND x > $x_lower AND y > $y_lower AND y < $y_upper";
    } elseif ($cutAngle >= 270 && $cutAngle < 360) {
        // Quadrant IV: 270 - 360 degrees
        $theta = 360 - $cutAngle;
        $x_upper = $x0 + $stemHeight + $buffer;
        $y1_lower = $y0 + ($x_upper - $x0) / tan(deg2rad($theta + 1));
        $y2_lower = $y0 + ($x_upper - $x0) / tan(deg2rad($theta - 1));
        $y_upper = $y0 + $buffer;
        $y_lower = min($y1_lower, $y2_lower) - $buffer;
        $count_query = "SELECT COUNT(*) AS affected_count FROM newforestori WHERE status_tree != 'Cut' AND x > $x0 AND x < $x_upper AND y > $y_lower AND y < $y_upper";
    }

    if (!empty($count_query)) {
        $count_result = mysqli_query($dbc, $count_query);
        if (!$count_result) {
            die('Error executing count query: ' . mysqli_error($dbc));
        }
    
        $affected_count = mysqli_fetch_assoc($count_result)['affected_count'];
    
        // Update the 'damage' column for the current cut tree by incrementing the existing damage count
        $update_query = "UPDATE newforestori SET damage = damage + $affected_count WHERE Id = " . $row['Id']; // Assuming 'Id' is the primary key
        $update_result = mysqli_query($dbc, $update_query);
        if (!$update_result) {
            die('Error updating damage column: ' . mysqli_error($dbc));
        }
    }
    
}



$sql7 = "UPDATE newforestori INNER JOIN speciesname ON speciesname.No = newforestori.species SET newforestori.species = speciesname.SPECODE";
$result7 = mysqli_query($dbc, $sql7);
if (!$result7) {
    die('Error executing query 6: ' . mysqli_error($dbc));
}


echo "</table>";

?>
