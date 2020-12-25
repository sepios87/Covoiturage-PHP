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
            <th>Numéro</th>
            <th>Nom</th>
            <th>Prénom</th>
        </tr> <?php
                foreach ($listePersonne as $elem) {
                ?> <tr>
                <td><b><a href="index.php?page=2&idPersonne=<?php echo $elem->getNum() ?>"><?php echo $elem->getNum(); ?></a></b></td>
                <td><?php echo $elem->getNom();  ?></td>
                <td><?php echo $elem->getPrenom(); ?></td>
            </tr>
        <?php } ?>
    </table>
    <?php
} else {
    $personne = $personneManager->getByIdPersonne($_GET["idPersonne"]);
    if ($etudiant = $etudiantManager->getEtudiantById($_GET["idPersonne"])) { ?>
        <h1>Détail sur l'étudiant <?php echo $personne->getNom() ?></h1>
    <?php } else if (!empty($salarie)) {
        $salarie = $salarieManager->getSalarieById($_GET["idPersonne"]); ?>
        <h1>Détail sur le salarié <?php echo $personne->getNom() ?></h1>
    <?php } else {
    ?><h1>❌ <?php echo $personne->getNom() ?> n'est ni salarié ni étudiant</h1><?php
                                                                                    } ?>
    <table>
        <tr>
            <th>Prénom</th>
            <th>Mail</th>
            <th>Tel</th>
            <?php if (!empty($etudiant)) { ?>
                <th>Département</th>
                <th>Ville</th>
            <?php } else if (!empty($salarie)) { ?>
                <th>Tel pro</th>
                <th>Fonction</th>
            <?php } ?>
        </tr>
        <tr>
            <td><?php echo $personne->getPrenom() ?></td>
            <td><?php echo $personne->getMail() ?></td>
            <td><?php echo $personne->getTel() ?></td>
            <?php if (!empty($etudiant)) { ?>
                <td><?php echo $etudiant->getDepartement()->getNom() ?></td>
                <td><?php echo $etudiant->getVille()->getNom() ?></td>
            <?php } else if (!empty($salarie)) { ?>
                <td><?php echo $salarie->getTel() ?></td>
                <td><?php echo $salarie->getFonNum() ?></td>
            <?php } ?>
        </tr>
    </table>
<?php } ?>