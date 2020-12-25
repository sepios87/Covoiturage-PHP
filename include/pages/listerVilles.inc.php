<h1>Liste des villes</h1>
<?php
$villeManager = new VilleManager($pdo);
$listeVille = $villeManager->getVille();

?>
<p>Actuellement <?php echo sizeof($listeVille) ?> villes sont enregistrées</p>
<table>
    <tr>
        <th>Numéro</th>
        <th>Nom</th>
    </tr>
    <?php
    foreach ($listeVille as $elem) {
    ?> <tr>
            <td><?php echo $elem->getNum() ?></td>
            <td><?php echo $elem->getNom() ?></td>
        </tr>
    <?php }
    ?>
</table>