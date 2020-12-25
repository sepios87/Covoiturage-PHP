<div id="menu">
	<div id="menuInt">
		<p><a href="index.php?page=0"><img src="image/accueil.gif" class="imagMenu" alt="Accueil" />Accueil</a></p>
		<p><img src="image/personne.png" class="imagMenu" alt="Personne" />Personne</p>
		<ul>
			<li><a href="index.php?page=1">Ajouter</a></li>
			<li><a href="index.php?page=2">Lister</a></li>
			<li><a href="index.php?page=3">Modifier / Supprimer</a></li>
		</ul>
		<p><img src="image/parcours.gif" class="imagMenu" alt="Parcours" />Parcours</p>
		<ul>
			<li><a href="index.php?page=5">Ajouter</a></li>
			<li><a href="index.php?page=6">Lister</a></li>
		</ul>
		<p><img src="image/ville.png" class="imagMenu" alt="Ville" />Ville</p>
		<ul>
			<li><a href="index.php?page=7">Ajouter</a></li>
			<li><a href="index.php?page=8">Lister</a></li>
		</ul>

		<?php if (!empty($_SESSION["user"])) { ?>
			<p><img src="image/trajet.png" class="imagMenu" alt="Trajet" />Trajet</p>
			<ul>
				<li><a href="index.php?page=9">Proposer</a></li>
				<li><a href="index.php?page=10">Rechercher</a></li>
			</ul>
		<?php } ?>
	</div>
</div>