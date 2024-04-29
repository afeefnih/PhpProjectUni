

<?php
/*\\
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



echo "</table>";
*/

DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'tree');

// Make the connection:
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error());

// Set the encoding...
mysqli_set_charset($dbc, 'utf8');

// Perform your calculations here using the existing data in the database

// For example, you can retrieve data from the 'newforestori' table and perform calculations:
// Construct the SQL query to retrieve data for all "Cut" trees
$sql = "SELECT TreeNum, Cut_Angle, x ,y, StemHeight, coordinate FROM newforestori WHERE status_tree = 'Cut'";
$result = mysqli_query($dbc, $sql);

// Check if the query executed successfully
if (!$result) {
    die('Error executing query: ' . mysqli_error($dbc));
}

while ($row = mysqli_fetch_assoc($result)) {
    $cutAngle = $row['Cut_Angle'];
    $stemHeight = $row['StemHeight']; // Initialize victimId here
    $cutTreeId = $row['coordinate'];
    $x0 = $row['x'];
    $y0 = $row['y'];
    $victimTreeNumbers = [];
    

    // Define additional buffer beyond the stem height
    $buffer = 10;  // 5 + 5 as described

    // Initialize the query to count affected trees
    $count_query = "";

    // Calculate the range for x and y based on the cutting angle
    if ($cutAngle >= 0 && $cutAngle < 90) {
        // Quadrant I: 0 - 90 degrees
        
        $x_upper = $x0 + $stemHeight + $buffer;
        $y_upper = $y0 + $stemHeight + $buffer;

        $query1 = "SELECT coordinate FROM newforestori WHERE status_tree != 'Cut' AND x > $x0 AND x < $x_upper AND y > $y0 AND y < $y_upper";
        $result1 = mysqli_query($dbc, $query1);
        // Construct and execute the query
        

        // Check if the query executed successfully
        if (!$result1) {
            die('Error executing query: ' . mysqli_error($dbc));
        }

        // Fetch and process the result set
        while ($row1 = mysqli_fetch_assoc($result1)) {
            $victimIds = $row1['coordinate']; // Get victim ID
            // Insert the victim ID into the damagetree table
        /*    $update_query = "INSERT INTO damagetree (Cut_Tree, Victim) VALUES ('$cutTreeId', '$victimIds')";
            $update_result = mysqli_query($dbc, $update_query);
            // Check if the insert was successful
            if (!$update_result) {
                die('Error updating data in damagetree: ' . mysqli_error($dbc));
            }
            */
        }

        // Free the result set
        mysqli_free_result($result1);

    } elseif ($cutAngle >= 90 && $cutAngle < 180) {
        // Quadrant II: 90 - 180 degrees
        $x_upper = $x0 + $stemHeight + $buffer;
        $y_upper = $y0 - $stemHeight - $buffer;

        // Execute query to find affected trees
        $count_query = "SELECT coordinate FROM newforestori WHERE status_tree != 'Cut' AND x > $x0 AND x < $x_upper AND y > $y_upper AND y < $y0";

        // Execute the query
        $result2 = mysqli_query($dbc, $count_query);

        // Check if the query executed successfully
        if (!$result2) {
            die('Error executing query: ' . mysqli_error($dbc));
        }

        // Process the result set
        while ($row2 = mysqli_fetch_assoc($result2)) {
            $victimIds = $row2['coordinate'];

            // Insert the victim ID into the damagetree table
         /*   $update_query = "INSERT INTO damagetree (Cut_Tree, Victim) VALUES ('$cutTreeId', '$victimIds')";

            // Execute the update query
            $update_result = mysqli_query($dbc, $update_query);

            // Check if the update was successful
            if (!$update_result) {
                die('Error updating data in damagetree: ' . mysqli_error($dbc));
            }
            */
        }

        // Free the result set
        mysqli_free_result($result2);

    } elseif ($cutAngle >= 180 && $cutAngle < 270) {
        // Quadrant III: 180 - 270 degrees
        $x_upper = $x0 - $stemHeight - $buffer;
        $y_upper = $y0 - $stemHeight - $buffer;

        // Execute query to find affected trees
        $count_query = "SELECT coordinate FROM newforestori WHERE status_tree != 'Cut' AND x > $x0 AND x < $x_upper AND y > $y_upper AND y < $y0";

        // Execute the query
        $result3 = mysqli_query($dbc, $count_query);

        // Check if the query executed successfully
        if (!$result3) {
            die('Error executing query: ' . mysqli_error($dbc));
        }

        // Process the result set
        while ($row3 = mysqli_fetch_assoc($result3)) {
            $victimIds = $row3['coordinate'];

            // Insert the victim ID into the damagetree table
            /*$update_query = "INSERT INTO damagetree (Cut_Tree, Victim) VALUES ('$cutTreeId', '$victimIds')";

            // Execute the update query
            $update_result = mysqli_query($dbc, $update_query);

            // Check if the update was successful
            if (!$update_result) {
                die('Error updating data in damagetree: ' . mysqli_error($dbc));
            }
            */
        }

        // Free the result set
        mysqli_free_result($result3);

    } elseif ($cutAngle >= 270 && $cutAngle < 360) {
        // Quadrant IV: 270 - 360 degrees
        $x_upper = $x0 - $stemHeight - $buffer;
        $y_upper = $y0 + $stemHeight + $buffer;

        // Execute query to find affected trees
        $count_query = "SELECT coordinate FROM newforestori WHERE status_tree != 'Cut' AND x > $x0 AND x < $x_upper AND y > $y0 AND y < $y_upper";

        // Execute the query
        $result4 = mysqli_query($dbc, $count_query);

        // Check if the query executed successfully
        if (!$result4) {
            die('Error executing query: ' . mysqli_error($dbc));
        }

        // Process the result set
        while ($row4 = mysqli_fetch_assoc($result4)) {
            $victimIds = $row4['coordinate'];

            // Insert the victim ID into the damagetree table
           /* $update_query = "INSERT INTO damagetree (Cut_Tree, Victim) VALUES ('$cutTreeId', '$victimIds')";

            // Execute the update query
            $update_result = mysqli_query($dbc, $update_query);

            // Check if the update was successful
            if (!$update_result) {
                die('Error updating data in damagetree: ' . mysqli_error($dbc));
            }
            */
        }

        // Free the result set
        mysqli_free_result($result4);
    }

     // Construct the query to find affected trees
     $count_query = "SELECT coordinate FROM newforestori WHERE status_tree != 'Cut' AND x > $x0 AND x < $x_upper AND y > $y0 AND y < $y_upper";

     // Execute the query
     $result_victims = mysqli_query($dbc, $count_query);
 
     // Check if the query executed successfully
     if (!$result_victims) {
         die('Error executing query: ' . mysqli_error($dbc));
     }
 
     // Process the result set
     while ($row_victims = mysqli_fetch_assoc($result_victims)) {
         $victimTreeNumbers[] = $row_victims['coordinate'];
     }
 
     // Free the result set
     mysqli_free_result($result_victims);
 
     // Convert victim tree numbers array to comma-separated string
     $victimTreeNumbersString = implode(',', $victimTreeNumbers);
 
     // Insert or update the damage table with the cut tree and its victims
     $update_query = "INSERT INTO damagetree (cut_tree, victim) VALUES ('$cutTreeId', '$victimTreeNumbersString') ON DUPLICATE KEY UPDATE victim='$victimTreeNumbersString'";
 
     // Execute the update query
     $update_result = mysqli_query($dbc, $update_query);
 
     // Check if the update was successful
     if (!$update_result) {
         die('Error updating data in damage: ' . mysqli_error($dbc));
     }
 }

 // Close the database connection
 mysqli_close($dbc);
 ?>

