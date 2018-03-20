<?php 

if (isset($_POST['submit'])) {

    try {

        require "../config.php";
        require "../functions.php";

        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT id 
                FROM users 
                WHERE username = :username
                AND password = :password";        

        $username = $_POST['username'];
        $password = $_POST['password'];

        $statement = $connection->prepare($sql);
        $statement->bindParam("username", $username, PDO::PARAM_STR);
        // $enc_password = hash('sha256', $password);
        $statement->bindParam("password", $password, PDO::PARAM_STR);
        $statement->execute();

        if ($statement->rowCount() > 0) {
        $result = $statement->fetchAll();
        } else {
            $error = "Username or password incorrect";
        }

    } catch (PDOException $e) {
        exit($e->getMessage());
    }    
}

?>

<?php include "templates/header.php"; ?>

    <?php 
        if (isset($_POST['submit'])) {
            if ($result && $statement->rowCount() > 0) {
                foreach ($result as $row) {
                    $id = $row['id'];
                }
                $_SESSION['id'] = $id;
                header("Location: profile.php");
            } else 
                echo $error;
        }
        ?>

    <h2>Login</h2>

    <form method="post">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required="required"> <br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required="required"> <br>
        <input type="submit" name="submit" value="Submit">
    </form>

<?php include "templates/footer.php"; ?>