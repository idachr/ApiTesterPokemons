<?php 

require_once "../parts/header-not-logged-in.php";

?>

    <h2>Don't have an accont? Create one here!</h2>
    <form action="../../includes/signup.inc.php" method="post">
        <input type="text" name="name" placeholder="Name..."><br>
        <input type="password" name="password" placeholder="Password..."><br>
        <input type="password" name="passwordrepeat" placeholder="Repeat Password..."><br>
        <button type="submit" name="submit">Sign up</button>
    </form>

    <a href="../../index.php">Back to front page</a>

</body>

</html>