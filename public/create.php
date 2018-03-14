<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */

if (isset($_POST['submit'])) {

    require "../config.php";
    require "../functions.php";

    try {
        $connection = new PDO($dsn, $username, $password, $options);
        // insert new user code here

        $new_user = array(
            "username" => $_POST['username'],
            "password" => $_POST['password'],
            "location" => $_POST['location']
        );

        // $sql = "INSERT INTO users (username, password, location) values (:username, :password, :location)";
        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "users",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);   
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
        <li><a href="list.php">List</a></li>
        <li><a href="search.php">Search</a></li>
    </ul>

    <?php 
    if (isset($_POST['submit']) && $statement) {
        ?> 
        <blockquote> <?php echo escape($_POST['username']) ?> is added to DB.</blockquote> 
    <?php 
    }
    ?>

    <h2>Create User</h2>

    <form method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required="required">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required="required">
        <label for="location">Location</label>
        <input type="location" name="location" id="location" required="required">        
        <input type="submit" name="submit" value="Submit">
    </form>

<?php include "templates/footer.php"; ?>