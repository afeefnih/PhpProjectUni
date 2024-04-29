
<?php
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'tree');

// Make the database connection
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error());

// Set the encoding
mysqli_set_charset($dbc, 'utf8');

// Perform your calculations here using the existing data in the database
$sql = "SELECT TreeNum, Cut_Angle, x, y, StemHeight, coordinate FROM newforestori WHERE status_tree = 'Cut'";
$result = mysqli_query($dbc, $sql);

// Check if the query executed successfully
if (!$result) {
    die('Error executing query: ' . mysqli_error($dbc));
}

// Initialize an array to store the affected victims and their corresponding cut trees
$affectedVictims = [];

while ($row = mysqli_fetch_assoc($result)) {
    $cutAngle = $row['Cut_Angle'];
    $stemHeight = $row['StemHeight'];
    $cutTreeId = $row['coordinate'];
    $x0 = $row['x'];
    $y0 = $row['y'];

    // Define additional buffer beyond the stem height
    $buffer = 10;  // 5 + 5 as described

    // Calculate the range for x and y based on the cutting angle
    if ($cutAngle >= 0 && $cutAngle < 90) {
        // Quadrant I: 0 - 90 degrees
        $x_upper = $x0 + $stemHeight + $buffer;
        $y_upper = $y0 + $stemHeight + $buffer;
    } elseif ($cutAngle >= 90 && $cutAngle < 180) {
        // Quadrant II: 90 - 180 degrees
        $x_upper = $x0 + $stemHeight + $buffer;
        $y_upper = $y0 - $stemHeight - $buffer;
    } elseif ($cutAngle >= 180 && $cutAngle < 270) {
        // Quadrant III: 180 - 270 degrees
        $x_upper = $x0 - $stemHeight - $buffer;
        $y_upper = $y0 - $stemHeight - $buffer;
    } elseif ($cutAngle >= 270 && $cutAngle < 360) {
        // Quadrant IV: 270 - 360 degrees
        $x_upper = $x0 - $stemHeight - $buffer;
        $y_upper = $y0 + $stemHeight + $buffer;
    }

    // Construct the query to find affected victims by the current cut tree
    $count_query = "SELECT coordinate FROM newforestori WHERE status_tree != 'Cut' AND x > $x0 AND x < $x_upper AND y > $y0 AND y < $y_upper";

    // Execute the query
    $result_count = mysqli_query($dbc, $count_query);

    // Check if the query executed successfully
    if (!$result_count) {
        die('Error executing query: ' . mysqli_error($dbc));
    }

    // Fetch the affected victims
    while ($row_count = mysqli_fetch_assoc($result_count)) {
        $victimId = $row_count['coordinate'];

        // Update the array of affected victims and their corresponding cut trees
        if (!isset($affectedVictims[$victimId])) {
            $affectedVictims[$victimId] = [];
        }
        
        // Add the current cut tree to the list of affected trees for the victim
        $affectedVictims[$victimId][] = $cutTreeId;
    }

    // Free the result set
    mysqli_free_result($result_count);
}

// Insert the affected victims and their corresponding cut trees into the database
foreach ($affectedVictims as $victimId => $cutTrees) {
    // Convert the array of cut trees to a comma-separated string
    $cutTreesString = implode(',', $cutTrees);
    
    // Insert or update the damage table with the victim and its affected cut trees
    $insert_query = "INSERT INTO Victim (victim, cut_tree) VALUES ('$victimId', '$cutTreesString') ON DUPLICATE KEY UPDATE cut_tree='$cutTreesString'";
    
    // Execute the insert query
    $insert_result = mysqli_query($dbc, $insert_query);
    
    // Check if the insert was successful
    if (!$insert_result) {
        die('Error inserting data into damagetree table: ' . mysqli_error($dbc));
    }
}


// Close the database connection
mysqli_close($dbc);
?>