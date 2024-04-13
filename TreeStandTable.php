<?php
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'tree');

// Connect to the database
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error());
mysqli_set_charset($dbc, 'utf8');

// Define diameter ranges
$diameter_ranges = array(
    array(5, 15),
    array(15, 30),
    array(30, 45),
    array(45, 60),
    // No upper limit for the last range
);

// Prepare the SQL query to count the number of trees falling within each diameter range for each spgroup
$q = "SELECT 
            spgroup,
            SUM(CASE WHEN diameter >= 5 AND diameter <= 15 THEN 1 ELSE 0 END) AS '5-15',
            SUM(CASE WHEN diameter > 15 AND diameter <= 30 THEN 1 ELSE 0 END) AS '15-30',
            SUM(CASE WHEN diameter > 30 AND diameter <= 45 THEN 1 ELSE 0 END) AS '30-45',
            SUM(CASE WHEN diameter > 45 AND diameter <= 60 THEN 1 ELSE 0 END) AS '45-60',
            SUM(CASE WHEN diameter > 60 THEN 1 ELSE 0 END) AS '60+'
        FROM newforestori
        GROUP BY spgroup";

// Execute the query
$r = mysqli_query($dbc, $q);
if (!$r) {
    die('Error: ' . mysqli_error($dbc));
}

// Display the table
echo "<table border='1'>";
echo "<tr><th>spgroup</th>";
foreach ($diameter_ranges as $range) {
    echo "<th>" . $range[0] . "-" . ($range[1] === null ? "Inf" : $range[1]) . "</th>";
}
echo "</tr>";

// Loop through the results
while ($row = mysqli_fetch_assoc($r)) {
    echo "<tr>";
    echo "<td>" . $row['spgroup'] . "</td>";
    foreach ($diameter_ranges as $range) {
        $rangeLabel = $range[0] . "-" . ($range[1] === null ? "Inf" : $range[1]);
        echo "<td>" . $row[$rangeLabel] . "</td>";
    }
    echo "</tr>";
}

echo "</table>";

// Close the database connection
mysqli_close($dbc);
?>