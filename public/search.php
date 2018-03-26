<?php 

require_once("check-login.php");

if (isset($_POST['submit'])) {

    try {

        require "../config.php";
        require "../functions.php";

        $connection = new PDO($dsn, $username, $password, $options);
        // fetch data code here

        $sql = "SELECT * 
                FROM users 
                WHERE username
                LIKE :username";

        $username = $_POST['username'];

        $keyword_to_search = '%' . $username . '%';
        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $keyword_to_search, PDO::PARAM_STR);
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
                        <th>Location</th>
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

                <blockquote>No results find for <?php echo escape($_POST['username']); ?></blockquote>

            <?php
        }
    }
    ?>

    <h2>Find user by username</h2>

    <form method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required="required"> <br>
        <input type="submit" name="submit" value="Submit">
    </form>

<?php include "templates/footer.php"; ?>