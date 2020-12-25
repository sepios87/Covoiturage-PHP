<h1>Liste des parcours proposés</h1>
<?php
$parcoursManager = new ParcoursManager($pdo);
$listeParcours = $parcoursManager->getParcours();
?>

<p>Actuellement <?php echo sizeof($listeParcours) ?> parcours sont enregistrés</p>
<table>
    <tr>
        <th>Numéro</th>
        <th>Nom ville</th>
        <th>Nom ville</th>
        <th>Nombre de Km</th>
    </tr> <?php
            foreach ($listeParcours as $elem) {
            ?> <tr>
            <td><?php echo $elem->getNum(); ?></td>
            <td><?php echo $elem->getVille1()->getNom(); ?></td>
            <td><?php echo $elem->getVille2()->getNom(); ?></td>
            <td><?php echo $elem->getDistance(); ?></td>
        </tr>
    <?php } ?>
</table>