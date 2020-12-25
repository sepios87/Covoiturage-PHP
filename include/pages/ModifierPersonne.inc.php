<?php
$personneManager = new PersonneManager($pdo);
$etudiantManager = new EtudiantManager($pdo);
$salarieManager = new SalarieManager($pdo);
$listePersonne = $personneManager->getPersonne();

if (empty($_GET["idPersonne"])) {
?>
    <h1>Liste des personnes enregistrées</h1>
    <p>Actuellement <?php echo sizeof($listePersonne) ?> personnes enregistrées</p>
    <table>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th></th>
        </tr> <?php
                foreach ($listePersonne as $elem) {
                ?> <tr>
                <td><?php echo $elem->getNom();  ?></td>
                <td><?php echo $elem->getPrenom(); ?></td>
                <td><b><a href="index.php?page=3&idPersonne=<?php echo $elem->getNum() ?>">Modifier</a> / <a href="index.php?page=4&idPersonne=<?php echo $elem->getNum() ?>">Supprimer</a></b></td>
            </tr>
        <?php } ?>
    </table>
    <?php
}
if (empty($_POST["nom"]) && empty($_POST["prenom"]) && empty($_POST["mail"]) && !empty($_GET["idPersonne"])) {
    $personne = $personneManager->getByIdPersonne($_GET["idPersonne"]);
    if ($etudiant = $etudiantManager->getEtudiantById($_GET["idPersonne"])) { ?>
        <h1>Modifier l'étudiant <?php echo $personne->getNom() ?></h1>
    <?php } else {
        $salarie = $salarieManager->getSalarieById($_GET["idPersonne"]); ?>
        <h1>Modifier le salarié <?php echo $personne->getNom() ?></h1>
    <?php } ?>
    <form action="#" method="post">
        <div class="colonnes">
            <div>
                <label for="nom">Nom :</label>
                <input type="text" name="nom" value="<?php echo $personne->getNom() ?>" required>
            </div>
            <div>
                <label for="prenom">Prénom :</label>
                <input type="text" name="prenom" value="<?php echo $personne->getPrenom() ?>" required>
            </div>
            <div>
                <label for="tel">Téléphone :</label>
                <input type="tel" name="tel" value="<?php echo $personne->getTel() ?>" required>
            </div>
            <div>
                <label for="mail">Mail :</label>
                <input type="email" name="mail" value="<?php echo $personne->getMail() ?>" required>
            </div>
        </div>
        <input type="submit" value="Valider">
    </form>

    <?php }
if (!(empty($_POST["nom"]) || empty($_POST["prenom"]) || empty($_POST["mail"]))) {

    $personneModif = new Personne(
        $_GET["idPersonne"],
        $_POST["nom"],
        $_POST["prenom"],
        $_POST["tel"],
        $_POST["mail"],
        null,
        null
    );

    if ($personneManager->modifPersonne($personneModif)) {
    ?><p><?php echo "✔️ Les changements ont été effectués"; ?></p>
<?php
    }
}
?>