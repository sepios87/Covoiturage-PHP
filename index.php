<?php
//Code de florian TORIBIO
require_once("include/autoLoad.inc.php");
require_once("include/header.inc.php");

?>
<div id="corps">
    <?php
    $pdo = new Mypdo();
    require_once("include/menu.inc.php");
    require_once("include/texte.inc.php");
    ?>
</div>

<div id="spacer"></div>
<?php
require_once("include/footer.inc.php"); ?>