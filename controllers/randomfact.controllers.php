<?php

class RandomFactController extends RandomFactModel {
    public function getRandomFactForDisplay() {
        $randomFact = $this->getRandomFact();

        return $randomFact;
    }
}