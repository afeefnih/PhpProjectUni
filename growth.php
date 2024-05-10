<?php
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'tree');

// Connect to the database
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error());
mysqli_set_charset($dbc, 'utf8');

$sql = "SELECT * FROM newforestori";
$result = mysqli_query($dbc, $sql);

// Output display
if (mysqli_num_rows($result) > 0) {
    // Output data of each row in a table
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Species Group</th>
                <th>Diameter</th>
                <th>Diameter 30</th>
                <th>Volume 30</th>
            </tr>";
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row["Id"];
        $speciesgroup = $row["spgroup"];
        $originalDiameter = $row["Diameter"];
        $newDiameter = calculateNewDiameter($originalDiameter);
        $volume30 = calculateVolume30($newDiameter, $speciesgroup);
        
        echo "<tr>
                <td>".$row["Id"]."</td>
                <td>".$speciesgroup ."</td>
                <td>".$originalDiameter."</td>
                <td>".$newDiameter."</td>
                <td>".$volume30."</td>
              </tr>";

                // Insert query
                // use this code first
                $sql1 = "UPDATE newforestori SET Diameter30 = '$newDiameter', Growth30 = '$volume30' WHERE Id = '$id' AND status_tree != 'Cut' AND Damage_stem = 0 ";

                // if the above code run error, use the below code
                // use the code one by one
                //$sql1 = "UPDATE newforestori SET Growth30 = '$volume30' WHERE Id = '$id' AND status_tree != 'Cut' AND Damage_stem = 0 ";
                //$sql1 = "UPDATE newforestori SET Diameter30 = '$newDiameter' WHERE Id = '$id' AND status_tree != 'Cut' AND Damage_stem = 0 ";
                $result1 = mysqli_query($dbc, $sql1);
    }
    echo "</table>";
} else {
    echo "0 results";
}



// Close the connection
mysqli_close($dbc);

function calculateNewDiameter($diameter) {

    // Calculate the new diameter
    for($year = 1; $year <= 30; $year++){
        if ($diameter >= 5 && $diameter <= 15) {
            $diameter += 0.4;
        } elseif ($diameter > 15 && $diameter <= 30) {
            $diameter += 0.6;
        } elseif ($diameter > 30 && $diameter <= 45) {
            $diameter += 0.5;
        } elseif ($diameter > 45 && $diameter <= 60) {
            $diameter += 0.5;
        } elseif ($diameter > 60) {
            $diameter += 0.7;
        } else {
            return "Invalid Diameter";
        }
    }

    return $diameter;
}

function calculateVolume30($newDiameter, $speciesgroup){

    //calculate the volume tree after 30 years
    if(in_array($speciesgroup, [1, 2, 3, 4])) {
        return 0.022 + 3.4 * ($newDiameter * $newDiameter);
    } elseif (in_array($speciesgroup, [5, 6, 7])){
        return -0.0971 + 9.503 * ($newDiameter * $newDiameter);
    }else{
        return "Invalid Species group";
    }
}

?>
