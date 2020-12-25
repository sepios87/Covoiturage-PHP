<div class="<?php echo (empty($_POST["nom"]) ?: "encadre"); ?>">
    <h1>Ajouter une ville</h1>

    <?php
    if (empty($_POST["nom"])) { ?>
        <form action="#" method="post">
            <label>Nom :</label>
            <input type="text" name="nom" required>
            <input type="submit" value="Valider" id="validerVille">
        </form>
        <?php
    } else {
        $ville = new Ville(null, $_POST["nom"]);
        $villeManager = new VilleManager($pdo);
        if ($villeManager->addVille($ville)) {
        ?> <p>✔️ La ville <b>"<?php echo $ville->getNom() ?>"</b> a été ajoutée</p>
        <?php
        } else {
        ?> <p>❌ La ville n'a pas été ajoutée</p>
    <?php
        }
    }
    ?>
</div>