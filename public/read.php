<?php include "templates/header.php"; ?>

    <h2>Find user for location</h2>

    <form action="read.php" method="POST">
        <label for="location">Username</label>
        <input type="text" name="location" id="location" required="required"> <br>
        <input type="submit" value="View Results">
    </form>

    <a href="create.php">Create</a>
    
<?php include "templates/footer.php"; ?>