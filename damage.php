<?php
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
$sql = "SELECT TreeNum, Cut_Angle, x ,y, StemHeight FROM newforestori WHERE status_tree = 'Cut'";
$result = mysqli_query($dbc, $sql);

// Check if the query executed successfully
if (!$result) {
    die('Error executing query: ' . mysqli_error($dbc));
}

while ($row = mysqli_fetch_assoc($result)) {
    $cutTreeId = $row['TreeNum'];
    $cutAngle = $row['Cut_Angle'];
    $stemHeight = $row['StemHeight'];
    $x0 = $row['x'];
    $y0 = $row['y'];

    // Define additional buffer beyond the stem height
    $buffer = 10;  // 5 + 5 as described

    // Initialize the count of affected trees
    $affectedTreesCount = 0;

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

    // Construct the query to count affected trees
    $count_query = "SELECT COUNT(*) AS count FROM newforestori WHERE status_tree != 'Cut' AND x > $x0 AND x < $x_upper AND y > $y0 AND y < $y_upper";

    // Execute the query
    $count_result = mysqli_query($dbc, $count_query);

    // Check if the query executed successfully
    if (!$count_result) {
        die('Error executing query: ' . mysqli_error($dbc));
    }

    // Fetch the count of affected trees
    $row_count = mysqli_fetch_assoc($count_result);
    $affectedTreesCount = $row_count['count'];

    // Free the result set
    mysqli_free_result($count_result);

    // Output the count of affected trees for the current cut tree
    echo "Tree $cutTreeId cut, $affectedTreesCount victims affected.<br>";

    // You can also insert this count into the database or perform any other necessary operations
}

// Close the database connection
mysqli_close($dbc);
?>
