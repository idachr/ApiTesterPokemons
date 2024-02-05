<?php

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //grabbing the data
    $pokemonId = htmlspecialchars($_POST["pokemon_id"], ENT_QUOTES, 'UTF-8');
    $trainerId = $_SESSION['id'];

    include "../classes/dbh.classes.php";
    include "../models/pokemon.models.php";
    include "../controllers/pokemon.controllers.php";

    $freePokemon = new PokemonController($trainerId, $pokemonId);

    $freePokemon->freePokemon();

    header("Location: ../views/private/pokeball.views.php");

}