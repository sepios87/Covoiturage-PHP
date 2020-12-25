<div class="<?php echo (empty($_POST["distance"]) ?: "encadre"); ?>">
    <h1>Ajouter un parcours</h1>

    <?php
    $villeManager = new VilleManager($pdo);
    $parcoursManager = new ParcoursManager($pdo);
    $listeVille = $villeManager->getVille();

    function selection($listeVille, $name)
    { ?>
        <select name="<?php echo $name ?>">
            <?php
            foreach ($listeVille as $elem) {
            ?> <option value="<?php echo $elem->getNum(); ?>"> <?php echo $elem->getNom() ?> </option>
            <?php }
            ?> </select>
    <?php
    }
    ?>

    <?php if (empty($_POST["distance"])) { ?>
        <form action="#" method="post">
            <div>
                <label>Ville 1 :</label>
                <?php selection($listeVille, "ville1") ?>
                <label>Ville 2 :</label>
                <?php selection($listeVille, "ville2") ?>
                <label>Nombre de kilomètres</label>
                <input type="number" min="1" max="9999" name="distance">
            </div>
            <input type="submit" value="Valider">
        </form>
        <?php } else {
        $parcours = new Parcours(null, $_POST["distance"], $_POST["ville1"], $_POST["ville2"]);
        if ($parcoursManager->addParcours($parcours)) { ?>
            <p>✔️ Le parcours a été ajouté</p>
        <?php } else { ?>
            <p>❌ Le parcours n'a pas été ajouté</p>
    <?php }
    } ?>
</div>