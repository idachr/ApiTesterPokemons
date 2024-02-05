<?php
session_start();
require_once "../parts/header.php";

include "../../classes/dbh.classes.php";
include "../../models/faq.models.php";
include "../../controllers/faq.controllers.php";

class FAQView extends FAQModel
{

    public function fetchFAQs()
    {
        return $this->getFAQ();
    }
}

$faqsView = new FAQView();
$faqs = $faqsView->fetchFAQs();
?>

<main>
    <div id="faq">
        <h1>Frequently asked questions and answers</h1>

        <?php foreach ($faqs as $faq) { ?>
            <h3><?php echo $faq['question']; ?></h3>
            <h4><?php echo $faq['answer']; ?></h4><br>
        <?php } ?>
    </div>
</main>

<?php
require_once "../parts/footer.php";
?>