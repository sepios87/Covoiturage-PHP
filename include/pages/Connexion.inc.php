<?php
$personneManager = new PersonneManager($pdo);
if (empty($_POST["valCaptcha"])) {
    $_SESSION["captcha"] = serialize(new Captcha());
}

$valideCaptcha = unserialize($_SESSION["captcha"])->getEgal(empty($_POST["valCaptcha"]) ? null : $_POST["valCaptcha"]);
$_SESSION["captcha"] = serialize(new Captcha());

if (empty($_POST["user"]) || !$valideCaptcha) { ?>
    <h1>Pour vous connecter</h1>
    <form action="#" method="post" id="connexion">
        <label>Nom d'utilisateur :</label>
        <input type="text" name="user" required>
        <label>Mot de passe :</label>
        <input type="password" name="pwd" required>
        <div id="captcha">
            <img src="./image/nb/<?php echo unserialize($_SESSION["captcha"])->getAlea1() ?>.jpg" alt="rand1">
            <p>+</p>
            <img src="./image/nb/<?php echo unserialize($_SESSION["captcha"])->getAlea2() ?>.jpg" alt="rand2">
            <p>=</p>
        </div>
        <input type="text" name="valCaptcha" required>
        <?php if (!$valideCaptcha && !empty($_POST["valCaptcha"])) {
        ?><p><?php echo "❌ Captcha non valide"; ?></p>
        <?php
        }  ?>
        <input type="submit" value="Valider">
    </form>
    <?php
} else {
    if (empty($_SESSION["user"])) {
        $user = $personneManager->getByLoginPwdPersonne($_POST["user"], sha1(sha1(mb_convert_encoding($_POST["pwd"], "UTF-8")) . SALT));
        if (empty($user)) {
    ?> <p>❌ Identifiant ou mot de passe incorrecte</p>
<?php
        } else {
            $_SESSION["user"] = serialize($user);
            header('Location: index.php?page=0');
        }
    } else {
        header('Location: index.php?page=0');
    }
}
