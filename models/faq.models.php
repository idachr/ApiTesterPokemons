<?php

class FAQModel extends Dbh {
    protected function getFAQ() {
        $stmt = parent::connect()->prepare('SELECT * FROM faq;');
    
        if (!$stmt->execute()) {
            $stmt = null;
            header("Location: ../views/private/faq.views.php?error=stmtfailed");
            exit();
        }
    
        if ($stmt->rowCount() === 0) {
            $stmt = null;
            header("Location: ../views/private/faq.views.php?error=profilenotfound");
            exit();
        }
    
        $faqData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
    
        return $faqData;
    }
}