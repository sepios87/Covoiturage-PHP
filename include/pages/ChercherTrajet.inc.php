<?php
date_default_timezone_set('Europe/Paris'); //mettre l'heure avec le bon fuseau horaire
$parcoursManager = new ParcoursManager($pdo);
$villeManager = new VilleManager($pdo);
$personneManager = new PersonneManager($pdo);
$avisManager = new AvisManager($pdo);
$listeVille = $parcoursManager->getVilleParcours();
if (empty($_SESSION['user'])) {?>
<p>❌ Il faut être connecté pour accéder a cette page</p>
<?php } else { ?>

<h1>Rechercher un trajet</h1>

<?php if (empty($_POST["numVilleDepart"]) && empty($_POST["numVilleArrive"]) && empty($_POST["heure"]) && empty($_POST["date"])) { ?>
<form action="#" method="post">
    <label>Ville de départ</label>
    <select onchange="this.form.submit()" name="numVilleDepart">
        <option name="">Choisissez</option>
        <?php foreach ($listeVille as $elem) { ?>
        <option value="<?php echo $elem->getNum() ?>"><?php echo $elem->getNom() ?></option>
        <?php } ?>
    </select>
</form>
<?php }
if (!empty($_POST["numVilleDepart"]) && empty($_POST["numVilleArrive"]) && empty($_POST["heure"]) && empty($_POST["date"])) {
    $_SESSION["numVilleDepart"] = $_POST["numVilleDepart"];
?>
<form action="#" method="post">
    <div class="colonnes">
        <div>
            <label>Ville de départ :
                <?php
                    echo $villeManager->getVilleById($_POST["numVilleDepart"])->getNom(); ?><span></span></label>
        </div>
        <div>
            <label>Ville d'arrivée :</label>
            <select name="numVilleArrive">
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
            <label>Précision :</label>
            <select name="precision">
                <option value="0">Ce jour</option>
                <option value="1">+/- 1 jour</option>
                <option value="2">+/- 2 jour</option>
                <option value="3">+/- 3 jour</option>
            </select>
        </div>
        <div>
            <label>A partir de :</label>
            <select name="heure">
                <?php for ($i = 0; $i < 24; $i++) {
                    ?> <option value="<?php echo "$i:00:00" ?> "><?php echo $i ?>h</option>
                <?php } ?>
            </select>
        </div>
    </div>
    <input type="submit" value="Valider">
</form>
<?php } ?>

<?php
if (!empty($_SESSION["numVilleDepart"]) && !empty($_POST["numVilleArrive"]) && !empty($_POST["heure"]) && !empty($_POST["date"])) {
    $proposeManager = new ProposeManager($pdo);
    $listePropose = $proposeManager->getPropose($_SESSION["numVilleDepart"], $_POST["numVilleArrive"],  $_POST["heure"], $_POST["date"], $_POST["precision"]);

    if (!empty($listePropose)) {
?> <table>
    <tr>
        <th>Ville départ</th>
        <th>Ville arrivé</th>
        <th>Date départ</th>
        <th>Heure départ</th>
        <th>nombre de place(s)</th>
        <th>Nom du covoitureur</th>
    </tr>
    <?php foreach ($listePropose as $elem) {
         $parcours = $parcoursManager->getParcoursById($elem->getParcoursNum());
         $villeDepart = $elem->getSens() == 0 ? $parcours->getVille1() : $parcours->getVille2();
         $villeArrive = $elem->getSens() == 1 ? $parcours->getVille1(): $parcours->getVille2();

         if ($villeDepart->getNum() == $_SESSION["numVilleDepart"]){
            ?> <tr>
        <td><?php echo $villeDepart->getNom() ?></td>
        <td><?php echo $villeArrive->getNom() ?></td>
        <td><?php echo date('d/m/Y', strtotime($elem->getDate())); ?></td>
        <td><?php echo $elem->getTime(); ?></td>
        <td><?php echo $elem->getPlace(); ?></td>
        <td><span class="tooltip">
                <p>
                    <?php
                                $personne = $personneManager->getByIdPersonne($elem->getPersonneNum());
                                $prenom = $personne->getPrenom();
                                $nom = $personne->getNom();
                                echo "$prenom $nom"
                                ?>
                </p>
                <span class="tooltiptext ">Moyenne des avis
                    <?php
                                echo substr($avisManager->getMoyenne($elem->getPersonneNum()), 0, 3) ?: "N/A";
                                ?> Dernier avis :
                    <?php
                                echo $avisManager->getLastCom($elem->getPersonneNum()) ?: "N/A";
                                ?></span>
            </span></td>
    </tr>
    <?php }} ?>
</table>
<?php } else { ?>
<p>❌ Désolé, pas de trajet disponible !</p>
<?php }
        unset($_SESSION["numVilleDepart"]);
    }
}