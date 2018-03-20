<?php 

if (isset($_POST['submit'])) {

try {

    require "../config.php";
    require "../functions.php";

    $connection = new PDO($dsn, $username, $password, $options);
    // fetch data code here

    $sql = "SELECT * 
            FROM users";

    $location = $_POST['location'];

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();
}

catch(PDOExeption $error) {
    echo $sql . "<br>" . $error->getMessage();
}

}

?>

<?php include "templates/header.php"; ?>

    <h2>All users</h2>

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
                        <th>location</th>
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
                        <td><?php echo escape($row['location']); ?></td>
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

    <form method="post">
        <label for="submit">Show all users?</label>
        <input type="submit" name="submit" value="Yes show all users">
    </form>

<?php include "templates/footer.php"; ?>