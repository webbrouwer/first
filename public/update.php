<?php 

if (isset($_POST['submit'])) {

    try {

        require "../config.php";
        require "../functions.php";

        $connection = new PDO($dsn, $username, $password, $options);
        // fetch data code here

        $sql = "UPDATE users 
                SET username = :username
                WHERE id = :id";

        $username = $_POST['username'];
        $id = $_POST['id'];                

        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_STR);
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
        <li><a href="list.php">List</a></li>
        <li><a href="search.php">Search</a></li>
    </ul>

    <h2>Update user</h2>

    <?php 
    if (isset($_POST['submit']) && $statement) {
        ?> 
        <blockquote> <?php echo escape($_POST['username']) ?> is updated in DB.</blockquote> 
    <?php 
    }
    ?>    

    <form method="post">
        <label for="username">Update Username:</label>
        <input type="text" name="username" id="username" required="true">
        <label for="id">Where ID is:</label>
        <input type="text" name="id" id="id" required="true">        
        <input type="submit" name="submit" value="submit">
    </form>

<?php include "templates/footer.php"; ?>