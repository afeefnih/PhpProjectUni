<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tree Data</title>
    <?php include 'header.html';?>
    <style>
        <?php include 'styles.css'; ?>
    </style>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
            color: black;
        }
        th {
            background-color: #4CAF50;
            text-align: center;
        }
        tr:hover {
            background-color: #f5f5f5;
        }

        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a {
            color: #007bff;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
        }

        .pagination a.active {
            background-color: #007bff;
            color: white;
        }

        .pagination a:hover:not(.active) {
            background-color: #f2f2f2;
        }

    </style>
</head>
<body>

<?php
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'tree');

// Connect to the database
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error());
mysqli_set_charset($dbc, 'utf8');

/*$sql = "SELECT * FROM newforestori";
$result = mysqli_query($dbc, $sql);*/

//Paging code
$records_per_page = 20; // Number of records to display per page

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1; // Get the current page number

$start_from = ($page - 1) * $records_per_page; // Calculate the starting point for fetching records

$sql1 = "SELECT * FROM newforestori LIMIT $start_from, $records_per_page";
$result = mysqli_query($dbc, $sql1);

// Output display
if (mysqli_num_rows($result) > 0) {
    // Output data of each row in a table
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Block X</th>
                <th>Block Y</th>
                <th>Coordinate x</th>
                <th>Coordinate y</th>
                <th>TreeNum</th>
                <th>Species Name</th>
                <th>Species Group</th>
                <th>Diameter</th>
                <th>Diameter Class</th>
                <th>Stem Height</th>
                <th>Volume</th>
                <th>Production</th>
                <th>Status Tree</th>
                <th>Cut Angle</th>
                <th>Cut Tree</th>
                <th>Damage crown</th>
                <th>Damage Stem</th>
                <th>Growth30</th>
                <th>Production30</th>
            </tr>";
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row["Id"];
        $BlockX = $row["BlockX"];
        $BlockY = $row["BlockY"];
        $coordinateX = $row["x"];
        $coordinateY = $row["y"];
        $TreeNum = $row["TreeNum"];
        $speciesName = $row["species"];
        $speciesGroup = $row["spgroup"];
        $originalDiameter = $row["Diameter"];
        $DiameterClass = $row["DiameterClass"];
        $StemHeight = $row["StemHeight"];
        $Volume = $row["volume"];
        $Production = $row["production"];
        $Status_Tree = $row["status_tree"];
        $Cut_Angle = $row["Cut_Angle"];
        $Cut_Tree = $row["Cut_tree"];
        $Damage_Crown = $row["Damage_crown"];
        $Damage_Stem = $row["Damage_stem"];
        $Growth30 = $row["Growth30"];
        $Production30 = $row["Production30"];
        
        echo "<tr>
                <td>".$id."</td>
                <td>".$BlockX."</td>
                <td>".$BlockY."</td>
                <td>".$coordinateX."</td>
                <td>".$coordinateY."</td>
                <td>".$TreeNum."</td>
                <td>".$speciesName."</td>
                <td>".$speciesGroup ."</td>
                <td>".$originalDiameter."</td>
                <td>".$DiameterClass."</td>
                <td>".$StemHeight."</td>
                <td>".$Volume."</td>
                <td>".$Production."</td>
                <td>".$Status_Tree."</td>
                <td>".$Cut_Angle."</td>
                <td>".$Cut_Tree."</td>
                <td>".$Damage_Crown."</td>
                <td>".$Damage_Stem."</td>
                <td>".$Growth30."</td>
                <td>".$Production30."</td>
              </tr>";

    }
    echo "</table>";

    // Pagination links
    $sql2 = "SELECT COUNT(*) AS total_records FROM newforestori";
    $result = mysqli_query($dbc, $sql2);
    $row = mysqli_fetch_assoc($result);
    $total_records = $row['total_records'];
    $total_pages = ceil($total_records / $records_per_page);

    echo "<div class='pagination'>";
    if ($page > 1) {
        echo "<a href='?page=1'>&laquo; First</a>";
        $prev_page = $page - 1;
        echo "<a href='?page=$prev_page'>&lsaquo; Previous</a>";
    }
    for ($i = max(1, $page - 5); $i <= min($page + 5, $total_pages); $i++) {
        echo "<a href='?page=$i'";
        if ($i == $page) echo " class='active'";
        echo ">$i</a>";
    }
    if ($page < $total_pages) {
        $next_page = $page + 1;
        echo "<a href='?page=$next_page'>Next &rsaquo;</a>";
        echo "<a href='?page=$total_pages'>Last &raquo;</a>";
    }
    echo "</div>";


} else {
    echo "0 results";
}

// Close the connection
mysqli_close($dbc);

?>

</body>
</html>
