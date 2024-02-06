<?php 

require_once "../parts/header-not-logged-in.php";

?>

    <form action="../../includes/login.inc.php" method="post">
        <input type="text" name="name" placeholder="Name..."><br>
        <input type="password" name="password" placeholder="Password..."><br>
        <button type="submit" name="submit">Sign in</button>
    </form>

    <a href="../../index.php">Back to front page</a>

</body>

</html>