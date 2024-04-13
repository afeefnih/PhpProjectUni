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
            diameter
        FROM newforestori";

// Execute the query
$r = mysqli_query($dbc, $q);
if (!$r) {
    die('Error: ' . mysqli_error($dbc));
}

// Initialize $num
$spgroup1 = array(0, 0, 0, 0, 0);
$spgroup2 = array(0, 0, 0, 0, 0);
$spgroup3 = array(0, 0, 0, 0, 0);
$spgroup4 = array(0, 0, 0, 0, 0);
$spgroup5 = array(0, 0, 0, 0, 0);


// Display the table
echo "<table border='1'>";
echo "<tr><th>spgroup</th>";
foreach ($diameter_ranges as $range) {
    echo "<th>" . $range[0] . "-" . ($range[1] === null ? "Inf" : $range[1]) . "</th>";
}
echo "</tr>";

// Loop through the results
while ($row = mysqli_fetch_assoc($r)) {
    $spgroup = $row['spgroup'];
    $diameter = $row['diameter'];
    
    if ($spgroup == 1) {
            if ($diameter >= 5 && $diameter < 15) {
                $spgroup1[0]++;
            } else if ($diameter >= 15 && $diameter < 30){
                $spgroup1[1]++;
            } else if ($diameter >= 30 && $diameter < 45){
                $spgroup1[2]++;
            } else if ($diameter >= 45 && $diameter < 60){
                $spgroup1[3]++;
            }else if ($diameter >= 60){
                $spgroup1[4]++;
            }
        }else if ($spgroup == 2){
            if ($diameter >= 5 && $diameter < 15) {
                $spgroup2[0]++;
            } else if ($diameter >= 15 && $diameter < 30){
                $spgroup2[1]++;
            } else if ($diameter >= 30 && $diameter < 45){
                $spgroup2[2]++;
            } else if ($diameter >= 45 && $diameter < 60){
                $spgroup2[3]++;
            }else if ($diameter >= 60){
                $spgroup2[4]++;
            }
        }else if ($spgroup == 3){
            if ($diameter >= 5 && $diameter < 15) {
                $spgroup3[0]++;
            } else if ($diameter >= 15 && $diameter < 30){
                $spgroup3[1]++;
            } else if ($diameter >= 30 && $diameter < 45){
                $spgroup3[2]++;
            } else if ($diameter >= 45 && $diameter < 60){
                $spgroup3[3]++;
            }else if ($diameter >= 60){
                $spgroup3[4]++;
            }
        }
        else if ($spgroup == 4){
            if ($diameter >= 5 && $diameter < 15) {
                $spgroup4[0]++;
            } else if ($diameter >= 15 && $diameter < 30){
                $spgroup4[1]++;
            } else if ($diameter >= 30 && $diameter < 45){
                $spgroup4[2]++;
            } else if ($diameter >= 45 && $diameter < 60){
                $spgroup4[3]++;
            }else if ($diameter >= 60){
                $spgroup4[4]++;
            }
        }
        else if ($spgroup == 5){
            if ($diameter >= 5 && $diameter < 15) {
                $spgroup5[0]++;
            } else if ($diameter >= 15 && $diameter < 30){
                $spgroup5[1]++;
            } else if ($diameter >= 30 && $diameter < 45){
                $spgroup5[2]++;
            } else if ($diameter >= 45 && $diameter < 60){
                $spgroup5[3]++;
            }else if ($diameter >= 60){
                $spgroup5[4]++;
            }
        }
    }

echo "<tr>";
echo "<td>group 1</td>";
echo "<td>$spgroup1[0]</td>";
echo "<td>$spgroup1[1]</td>";
echo "<td>$spgroup1[2]</td>";
echo "<td>$spgroup1[3]</td>";
echo "<td>$spgroup1[4]</td>";
echo "</tr>";
echo "<tr>";
echo "<td>group 2</td>";
echo "<td> $spgroup2[0]</td>";
echo "<td> $spgroup2[1]</td>";
echo "<td> $spgroup2[2]</td>";
echo "<td> $spgroup2[3]</td>";
echo "<td> $spgroup2[4]</td>";
echo "</tr>";
echo "<tr>";
echo "<td>group 3</td>";
echo "<td> $spgroup3[0]</td>";
echo "<td> $spgroup3[1]</td>";
echo "<td> $spgroup3[2]</td>";
echo "<td> $spgroup3[3]</td>";
echo "<td> $spgroup3[4]</td>";
echo "</tr>";
echo "<tr>";
echo "<td>group 4</td>";
echo "<td> $spgroup4[0]</td>";
echo "<td> $spgroup4[1]</td>";
echo "<td> $spgroup4[2]</td>";
echo "<td> $spgroup4[3]</td>";
echo "<td> $spgroup4[4]</td>";
echo "</tr>";
echo "<tr>";
echo "<td>group 5</td>";
echo "<td> $spgroup5[0]</td>";
echo "<td> $spgroup5[1]</td>";
echo "<td> $spgroup5[2]</td>";
echo "<td> $spgroup5[3]</td>";
echo "<td> $spgroup5[4]</td>";
echo "</tr>";

echo "</table>";

// Close the database connection
mysqli_close($dbc);
?>
