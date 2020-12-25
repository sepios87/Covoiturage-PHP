<?php
$personneManager = new PersonneManager($pdo);
$listePersonne = $personneManager->getPersonne();

if (!empty($_GET["idPersonne"])) {
    if ($personneManager->suppPersonne($_GET["idPersonne"])) { ?>
        <p>✔️ La personne a été supprimée ainsi que tous ses trajets</p>
        <?php
        if (!empty($_SESSION["user"])) {
            $user = unserialize($_SESSION["user"]);
            if ($user->getNum() == $_GET["idPersonne"]) {
                unset($_SESSION["user"]);
                header('Refresh: 0');
            }
        }
    } else { ?>
        <p>❌ La personne n'a pas été supprimée</p>
<?php }
}
