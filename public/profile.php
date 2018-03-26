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

    <?php // var_dump($result); ?>


<?php 
        if ($result && $statement->rowCount() > 0) {
            foreach ($result as $row) { ?>
                The profile of: <b><?php echo $row['username']; ?></b>
            <?php } 
        } else {
            // No results
            ?>
                <blockquote>No results find</blockquote>
        <?php } ?>

<?php include "templates/footer.php"; ?>