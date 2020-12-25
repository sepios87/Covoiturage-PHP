<?php

if ((empty($_POST["nom"]) || empty($_POST["prenom"]) || empty($_POST["pwd"]) || empty($_POST["mail"])
	|| empty($_POST["login"]) || empty($_POST["stat"])) && (empty($_POST["division"]) && empty($_POST["departement"])
	&& empty($_POST["telPro"]) && empty($_POST["fonction"]))) { ?>

	<h1>Ajouter une personne</h1>
	<form action="#" method="post">
		<div class="colonnes">
			<div>
				<label>Nom :</label>
				<input type="text" name="nom" required>
			</div>
			<div>
				<label>Prénom :</label>
				<input type="text" name="prenom" required>
			</div>
			<div>
				<label>Téléphone :</label>
				<input type="tel" name="tel" required>
			</div>
			<div>
				<label>Mail :</label>
				<input type="email" name="mail" required>
			</div>
			<div>
				<label>Login :</label>
				<input type="text" name="login" required>
			</div>
			<div>
				<label>Mot de passe :</label>
				<input type="password" name="pwd" required>
			</div>
		</div>
		<div>
			<label>Catégorie :</label>
			<input type="radio" name="stat" value="etudiant" checked>
			<label>Etudiant</label>
			<input type="radio" name="stat" value="personnel">
			<label>Personnel</label>
		</div>
		<input type="submit" value="Valider">
	</form>
	<?php }
if (!(empty($_POST["nom"]) || empty($_POST["prenom"]) || empty($_POST["pwd"]) || empty($_POST["mail"])
	|| empty($_POST["login"]) || empty($_POST["stat"]))) {

	$pwdCrypt = sha1(sha1(mb_convert_encoding($_POST["pwd"], "UTF-8")) . SALT); //Encrypter mot de passe

	$personne = new Personne(
		null,
		$_POST["nom"],
		$_POST["prenom"],
		$_POST["tel"],
		$_POST["mail"],
		$_POST["login"],
		$pwdCrypt
	);

	$personneManager = new PersonneManager($pdo);
	$personneManager->addPersonne($personne);

	$_SESSION['idPersonne'] =  $personneManager->getIdPersonne($personne);

	if ($_POST["stat"] == "etudiant") {

		$departementManager = new DepartementManager($pdo);
		$listeDepartement = $departementManager->getDepartement();

		$divisionManager = new DivisionManager($pdo);
		$listeDivision = $divisionManager->getDivision();

	?> <h1>Ajouter un étudiant</h1>
		<form action="#" method="post">
			<div>
				<label>Année :</label>
				<select name="division">
					<?php foreach ($listeDivision as $elem) { ?>
						<option value="<?php echo $elem->getNum(); ?>"><?php echo $elem->getNom(); ?></option>
					<?php } ?>
				</select>
			</div>
			<div>
				<label>Département</label>
				<select name="departement">
					<?php foreach ($listeDepartement as $elem) { ?>
						<option value="<?php echo $elem->getNum(); ?>"><?php echo $elem->getNom(); ?></option>
					<?php } ?>
				</select>
			</div>
		<?php
	} else {

		$fonctionManager = new FonctionManager($pdo);
		$listeFonction = $fonctionManager->getFonction();

		?> <h1>Ajouter un salarié</h1>
			<form action="#" method="post">
				<div>
					<label>Téléphone professionnel :</label>
					<input type="tel" name="telPro">
				</div>
				<div>
					<label>Fonction :</label>
					<select name="fonction">
						<?php foreach ($listeFonction as $elem) { ?>
							<option value="<?php echo $elem->getNum(); ?>"><?php echo $elem->getLib(); ?></option>
						<?php } ?>
					</select>
				</div>
			<?php }
			?> <input type="submit" value="Valider">
			</form>
			<?php
		}

		if (!empty($_POST["division"]) && !empty($_POST["departement"])) {
			$etudiant = new Etudiant($_SESSION['idPersonne'], $_POST["departement"], $_POST["division"]);
			unset($_SESSION['idPersonne']); //liberer la variable de session
			$etudiantManager = new EtudiantManager($pdo);
			if ($etudiantManager->addEtudiant($etudiant)) { ?>
				<p>✔️ L'étudiant a été ajouté</p>
			<?php } else { ?>
				<p>❌ L'étudiant n'a pas été ajouté</p>
			<?php }
		}

		if (!empty($_POST["telPro"]) && !empty($_POST["fonction"])) {
			$salarie = new Salarie($_SESSION['idPersonne'], $_POST["telPro"], $_POST["fonction"]);
			unset($_SESSION['idPersonne']); //liberer la variable de session
			$salarieManager = new SalarieManager($pdo);
			if ($salarieManager->addSalarie($salarie)) { ?>
				<p>✔️ Le salarié a été ajouté</p>
			<?php } else { ?>
				<p>❌ Le salarié n'a pas été ajouté</p>
		<?php }
		}
		?>