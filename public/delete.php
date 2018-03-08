<?php 

if (isset($_POST['submit'])) {

    try {

        require "../config.php";
        require "../functions.php";

        $connection = new PDO($dsn, $username, $password, $options);
        // fetch data code here

        $sql = "DELETE
                FROM users 
                WHERE username = :username";

        $username = $_POST['username'];                

        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->execute();

    }

    catch(PDOExeption $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
    
}

?>

<?php include "templates/header.php"; ?>

    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="create.php">Create</a></li>
        <li><a href="read.php">Read</a></li>
        <li><a href="update.php">Update</a></li>
        <li><a href="delete.php">Delete</a></li>
    </ul>

    <h2>Delete user</h2>

    <?php 
    if (isset($_POST['submit']) && $statement) {
        ?> 
        <blockquote> <?php echo escape($_POST['username']) ?> is deleted from DB.</blockquote> 
    <?php 
    }
    ?>    

    <form method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required="true">
        <input type="submit" name="submit" value="submit">
    </form>

<?php include "templates/footer.php"; ?>
