<?php
session_start();

require_once "../parts/header.php";
require_once "../../api/pokemons.api.php";
require_once "../utilities.views.php";

if (isset($_SESSION['id'])) {
    $pokemons = API_Pokemon::get_all_pokemons_not_owned($_SESSION['id']);
}
?>

<main>
    <h3>Catch pokemons</h3>

    <ul>
        <?php

        if (is_array($pokemons)) {
            foreach ($pokemons as $pokemon) {
                $pokemonId = isset($pokemon['url']) ? basename($pokemon['url']) : '';
                $pokemonImage = generateImageUrl($pokemonId);

                echo '
            <li class="pokemon-display">
                <a href="pokemonprofile.views.php?pokemon_id=' . $pokemonId . '">
                    ' . $pokemon['name'] . '<img src="' . $pokemonImage . '" alt="' . $pokemon['name'] . '">
                </a>
                <form method="post" action="../../includes/catchpokemon.inc.php">
                    <input type="hidden" name="pokemon_id" value="' . $pokemonId . '">
                    <button type="submit" name="catch_pokemon">Catch Pokemon!</button>
                </form>
            </li>';
            }
        } else {
            echo "<li>Error fetching Pokémon data</li>";
        }
        ?>
    </ul>
</main>

</body>

</html>