<?php 

if (isset($_POST['submit'])) {

    try {

        require "../config.php";
        require "../functions.php";

        $connection = new PDO($dsn, $username, $password, $options);
        // fetch data code here

        $sql = "SELECT * 
                FROM users 
                WHERE location = :location";

        $location = $_POST['location'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':location', $location, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
    }

    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
    
}

?>

<?php include "templates/header.php"; ?>

    <?php 
    if (isset($_POST['submit'])) {
        if ($result && $statement->rowCount() > 0) {
            // Open table
            ?>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>
    
            <?php
            foreach ($result as $row) {
                // Table content
                ?>

                    <tr>
                        <td><?php echo escape($row['id']); ?></td>
                        <td><?php echo escape($row['username']); ?></td>
                        <td><?php echo escape($row['password']); ?></td>
                    </tr>

                <?php
            }
            // Close table
            ?>

            </tbody>
            </table>

            <?php
        }
        else {
            // No results
            ?>

                <blockquote>No results find for <?php echo escape($_POST['location']); ?></blockquote>

            <?php
        }
    }
    ?>

    <h2>Find user for location</h2>

    <form method="post">
        <label for="location">Location</label>
        <input type="text" name="location" id="location" required="required"> <br>
        <input type="submit" name="submit" value="Submit">
    </form>

<?php include "templates/footer.php"; ?>