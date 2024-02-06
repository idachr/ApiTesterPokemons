<?php

session_start();

$trainerId = $_SESSION['id'];

require_once "../parts/header.php";

require_once "../../api/pokemons.api.php";
require_once "../../models/pokemon.models.php";
require_once "../../controllers/pokemon.controllers.php";
require_once "../utilities.views.php";



$pokemonsTrainerOwns = API_Pokemon::get_owned_pokemons($trainerId);

?>

<h3>Your pokeball</h3>

<ul>
    <?php
    if (!empty($pokemonsTrainerOwns)) {
        foreach ($pokemonsTrainerOwns as $pokemon) {
            $pokemonId = $pokemon['id'];
            $pokemonImage = generateImageUrl($pokemonId); ?>
            <li class="pokemon-display"><?php echo $pokemon['name']; ?><img src="<?php echo $pokemonImage ?>" alt="<?php echo $pokemon['name'] ?>">
                <form method="post" action="../../includes/freepokemon.inc.php">
                    <input type="hidden" name="pokemon_id" value="<?php echo $pokemonId ?>">
                    <button type="submit" name="free_pokemon">Free pokemon!</button>
                </form>
            </li>
        <?php }
    } else { ?>
        <li>You don't own any Pokémon yet.</li>
    <?php } ?>
</ul>