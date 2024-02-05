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

    <div id="all-pokemons">
        <?php

        if (is_array($pokemons)) {
            foreach ($pokemons as $pokemon) {
                $pokemonId = isset($pokemon['url']) ? basename($pokemon['url']) : '';
                $pokemonImage = generateImageUrl($pokemonId); ?>
                <div class="pokemon-display">
                    <a href="pokemonprofile.views.php?pokemon_id=' . $pokemonId . '"><?php echo $pokemon['name'] ?>
                        <img src="<?php echo $pokemonImage ?>" alt=" <?php $pokemon['name']; ?> '">
                    </a>
                    <form method="post" action="../../includes/catchpokemon.inc.php">
                        <input type="hidden" name="pokemon_id" value="<?php echo $pokemonId ?>">
                        <button class="all-btn tertiary-btn" type="submit" name="catch_pokemon">Catch Pokemon!</button>
                    </form>
                </div>
            <?php  }
        } else { ?>
            <li>Error fetching Pokémon data</li>";
        <?php }
        ?>
    </div>
</main>

</body>

</html>