<?php

echo "</table>";

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
    $victimIds = [];

    // Define additional buffer beyond the stem height
    $buffer = 10;  // 5 + 5 as described

    // Initialize the query to count affected trees
    $count_query = "";

    // Calculate the range for x and y based on the cutting angle
    if ($cutAngle >= 0 && $cutAngle < 90) {
        // Quadrant I: 0 - 90 degrees
        
        $x_upper = $x0 + $stemHeight + $buffer;
        $y_upper = $y0 + $stemHeight + $buffer;

        // Quadrant II: 90 - 180 degree

        // Execute query to find affected trees
        $count_query = "SELECT coordinate FROM newforestori WHERE status_tree != 'Cut' AND x > $x0 AND x < $x_upper AND y > $y_upper AND y < $y0";

        // Execute the query
        $result1 = mysqli_query($dbc, $count_query);

        // Check if the query executed successfully
        if (!$result1) {
            die('Error executing query: ' . mysqli_error($dbc));
        }

        // Process the result set
        while ($row1 = mysqli_fetch_assoc($result1)) {
            $y1 = $y0 + ($x0 / tan(deg2rad( $cutAngle + 1)));
            $y2 = $y0 + ($x0 / tan(deg2rad($cutAngle - 1)));

            $damage1 = "SELECT coordinate FROM newforestori WHERE status_tree != 'Cut' AND $y0 > $y1 AND $y0 < $y2" ;
            $damage_result1 = mysqli_query($dbc, $damage1);

            while ($row1 = mysqli_fetch_assoc($damage_result1)) {
                $victimIds[] = $row1['coordinate'];
            }
        }
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
            $cutAngle = 180 - $cutAngle;
            $radian = deg2rad($cutAngle);
            $y1 = $y0 + ($x0 / tan( $radian + 1));
            $y2 = $y0 + ($x0 / tan( $radian - 1));

            $damage2 = "SELECT coordinate FROM newforestori WHERE status_tree != 'Cut' AND $y0 > $y1 AND $y0 < $y2" ;
            $damage_result2 = mysqli_query($dbc, $damage2);

            while ($row2 = mysqli_fetch_assoc($damage_result2)) {
                $victimIds[] = $row2['coordinate'];
            }
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
            $cutAngle = 180 + $cutAngle;
            $y1 = $y0 - ($x0 / tan(deg2rad($cutAngle  + 1)));
            $y2 = $y0 - ($x0 / tan(deg2rad($cutAngle - 1)));

            $damage3 = "SELECT coordinate FROM newforestori WHERE status_tree != 'Cut' AND $y0 > $y1 AND $y0 < $y2" ;
            $damage_result3 = mysqli_query($dbc, $damage3);

            while ($row3 = mysqli_fetch_assoc($damage_result3)) {
                $victimIds[] = $row3['coordinate'];
            }
        }

        // Free the result set
        mysqli_free_result($result3);

    } elseif ($cutAngle >= 270 && $cutAngle < 360) {
        // Quadrant IV: 270 - 360 degrees
        $x_upper = $x0 - $stemHeight - $buffer;
        $y_upper = $y0 + $stemHeight + $buffer;

        $count_query = "SELECT coordinate FROM newforestori WHERE status_tree != 'Cut' AND x > $x0 AND x < $x_upper AND y > $y_upper AND y < $y0";

        // Execute the query
        $result4 = mysqli_query($dbc, $count_query);

        // Check if the query executed successfully
        if (!$result4) {
            die('Error executing query: ' . mysqli_error($dbc));
        }

        // Process the result set
        while ($row4 = mysqli_fetch_assoc($result4)) {
            $cutAngle = 360 - $cutAngle;
            $y1 = $y0 + ($x0 / tan(deg2rad($cutAngle - 270 + 1)));
            $y2 = $y0 + ($x0 / tan(deg2rad($cutAngle - 270 - 1)));

            $damage4 = "SELECT coordinate FROM newforestori WHERE status_tree != 'Cut' AND $y0 > $y1 AND $y0 < $y2" ;
            $damage_result4 = mysqli_query($dbc, $damage4);

            while ($row4 = mysqli_fetch_assoc($damage_result4)) {
                $victimIds[] = $row4['coordinate'];
            }
        }

        // Free the result set
        mysqli_free_result($result4);
    }

    // Insert victim tree numbers into damagetree table
    foreach ($victimIds as $victimId) {
        $insert_query = "INSERT INTO damagetree (cut_tree, victim) VALUES ('$cutTreeId', '$victimId')";
        $insert_result = mysqli_query($dbc, $insert_query);

        if (!$insert_result) {
            die('Error updating data in damagetree: ' . mysqli_error($dbc));
        }
    }

    // Store the count of affected trees in the 'damage' column of 'newforestori' table
    $affectedCount = count($victimIds);
    $update_query = "UPDATE newforestori SET damage = $affectedCount WHERE coordinate = '$cutTreeId'";
    $update_result = mysqli_query($dbc, $update_query);

    if (!$update_result) {
        die('Error updating data in newforestori: ' . mysqli_error($dbc));
    }
}

// Close the database connection
mysqli_close($dbc);

?>
