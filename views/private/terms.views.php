<?php

session_start();

require_once "../parts/header.php";
?>

<h1>Terms and conditions</h1>
<ul>
    <li>
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Magnam nihil, sint aperiam tempore atque enim laudantium rerum dolorum? Odio nesciunt unde maxime aliquid eius dolores blanditiis cumque suscipit molestias labore?
    </li>
    <li>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum quae cupiditate ab ipsum reprehenderit quos doloribus, maxime temporibus iste quibusdam vitae veritatis quaerat ut recusandae, nisi sunt, repudiandae perspiciatis at.
    </li>
    <li>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus asperiores incidunt qui sit? Unde odio consectetur laborum ut sit enim ad quasi obcaecati ipsa similique? Culpa ipsam voluptatem pariatur earum?
    </li>
</ul>

<form action="../../includes/terms.inc.php" method="post">
    <input type="checkbox" name="terms_accepted" id="terms_accepted" required <?php if ($_SESSION['terms_approved']) {
        ?> disabled> <label for="terms_accepted">You have already accepted the terms and conditions</label> <?php
    } else {
        ?> > <label for="terms_accepted">I accept the terms and conditions</label> <?php
    } ?>

    <button class="all-btn primary-btn" type="submit" <?php if ($_SESSION['terms_approved']) {
         ?> disabled <?php } ?> >Accept terms and conditions</button>
</form>
    
<?php 
require_once "../parts/footer.php";
?>