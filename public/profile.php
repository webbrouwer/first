<?php 

require_once("check-login.php");

if (isset($_SESSION['id'])) {

    try {

        require "../config.php";
        require "../functions.php";

        $connection = new PDO($dsn, $username, $password, $options);
        // fetch data code here

        $sql = "SELECT * 
                FROM users 
                WHERE id = :id";

        $id = $_SESSION['id'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll();
    }

    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    } 
}

?>

<?php include "templates/header.php"; ?>
    
    <em>Create profilepage</em>

    <?php $session_id = $_SESSION['id']; ?>
    <?php echo $session_id; ?>

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

                <blockquote>No results find</blockquote>

            <?php
        }
    }
    ?>    

<?php include "templates/footer.php"; ?>