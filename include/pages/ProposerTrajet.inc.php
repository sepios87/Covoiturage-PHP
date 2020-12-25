<?php
date_default_timezone_set('Europe/Paris');
$parcoursManager = new ParcoursManager($pdo);
$proposeManger = new ProposeManager($pdo);
$villeManager = new VilleManager($pdo);
$listeVille = $parcoursManager->getVilleParcours();
if (empty($_SESSION['user'])) {?>
<p>❌ Il faut être connecté pour accéder a cette page</p>
<?php } else { ?>

<h1>Proposer un trajet</h1>

<?php if (
    empty($_POST["numVilleDepart"]) && empty($_POST["villeArrive"]) && empty($_POST["heure"]) && empty($_POST["date"]) &&
    empty($_POST["place"])
) { ?>
<form action="#" method="post">
    <label>Ville de départ</label>
    <select onchange="this.form.submit()" name="numVilleDepart">
        <option>Choisissez</option>
        <?php foreach ($listeVille as $elem) { ?>
        <option value="<?php echo $elem->getNum() ?>"><?php echo $elem->getNom() ?></option>
        <?php } ?>
    </select>
</form>
<?php }
if (
    !empty($_POST["numVilleDepart"]) && empty($_POST["villeArrive"]) && empty($_POST["heure"]) && empty($_POST["date"]) &&
    empty($_POST["place"])
) {
    $_SESSION["numVilleDepart"] = $_POST["numVilleDepart"];
?>
<form action="#" method="post">
    <div class="colonnes">
        <div>
            <label>Ville de départ :
                <?php
                    echo $villeManager->getVilleById($_POST["numVilleDepart"])->getNom(); ?>
                <span></span>
            </label>
        </div>
        <div>
            <label>Ville d'arrivée :</label>
            <select name="villeArrive" required>
                <?php
                    $listeVillesPossibles = $parcoursManager->getVilleByIdVille($_POST["numVilleDepart"]);
                    foreach ($listeVillesPossibles as $elem) { ?>
                <option value="<?php echo $elem->getNum() ?>"><?php echo $elem->getNom() ?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <label>Date de depart :</label>
            <input type="date" value="<?php echo date('Y-m-d'); ?>" name="date" required>
        </div>
        <div>
            <label>Heure de départ :</label>
            <input type="time" name="heure" value="<?php echo date('H:i:s'); ?>" required>
        </div>
        <div>
            <label>Nombre de places :</label>
            <input type="number" min="1" max="50" name="place" required>
        </div>
    </div>
    <input type="submit" value="Valider">
</form>
<?php } ?>

<?php
if (
    !empty($_SESSION["numVilleDepart"]) && !empty($_POST["villeArrive"]) && !empty($_POST["heure"]) && !empty($_POST["date"]) &&
    !empty($_POST["place"])
) {
    $parcours = $parcoursManager->getParcoursByIdVilles($_SESSION["numVilleDepart"], $_POST["villeArrive"]);
    $user = unserialize($_SESSION["user"]);
    $sens = ($_SESSION["numVilleDepart"] == $parcours->getVille1()->getNum()) ? 0 : 1;
    $propose = new Propose($parcours->getNum(), $user->getNum(), $_POST["date"], $_POST["heure"], $_POST["place"], $sens);
    $proposeManger->addPropose($propose);
?><p><?php echo "✔️ le trajet a été proposé" ?></p>
<?php
    unset($_SESSION["numVilleDepart"]);
}
}