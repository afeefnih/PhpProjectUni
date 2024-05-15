<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>phpMyAdmin Table</title>
        <?php include 'header.html';?>
    <style>
        <?php include 'styles.css'; ?>
    </style>
</head>
<body class="phpmyadmin">
    <div class="container">
        <header>
            <h1>phpMyAdmin Table</h1>
        </header>
        <main>
            <?php
            //ammar punya
            DEFINE ('DB_USER', 'root');
            DEFINE ('DB_PASSWORD', '');
            DEFINE ('DB_HOST', 'localhost');
            DEFINE ('DB_NAME', 'tree');

            // Connect to the database 
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error());
            mysqli_set_charset($dbc, 'utf8');

            $sql = "SELECT * FROM newforestori";
            $result = mysqli_query($dbc, $sql);




            // Database connection details
            /*$db_host = 'localhost';
            $db_user = 'username'; // Replace 'username' with your MySQL username
            $db_pass = 'password'; // Replace 'password' with your MySQL password
            $db_name = 'tree'; // Replace 'database_name' with your database name

            // Create connection
            $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to select all records from a table (replace 'table_name' with your table name)
            $sql = "SELECT * FROM `newforestori`";

            // Execute query
            $result = $conn->query($sql);*/

            if ($result->num_rows > 0) {
                // Display table headers
                echo "<table>";
                echo "<tr><th>ID</th><th>BlockX</th><th>BlockY</th><th>x</th><th>y</th><th>TreeNum</th>
                <th>species</th><th>sgroup</th><th>Diameter</th><th>DiameterClass</th><th>StemHeight</th>
                <th>volume</th><th>status_tree</th><th>Cut_Angle</th><th>Damage</th></tr>";

                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Id"] . "</td><td>" . $row["BlockX"] . "</td><td>" . $row["BlockY"] . 
                    "</td><td>" . $row["x"] . "</td><td>" . $row["y"] . "</td><td>" . $row["TreeNum"] . 
                    "</td><td>" . $row["species"] . "</td><td>" . $row["spgroup"] . "</td><td>" . $row["Diameter"] . 
                    "</td><td>" . $row["DiameterClass"] . "</td><td>" . $row["StemHeight"] . "</td><td>" . $row["volume"] . 
                    "</td><td>" . $row["status_tree"] . "</td><td>" . $row["Cut_Angle"] . "</td><td>" . $row["Damage"]."</td></tr>";
                    
                }

                echo "</table>";
            } else {
                echo "0 results";
            }

            // Close connection
            $conn->close();
            ?>
        </main>
    </div>
    <?php include 'footer.html';?>
</body>
</html>
