<?php $this->layout('layout', ['title' => 'Connexion d\'un admin']) ?>

<?php $this->start('main_content') ?>
	
	<h2>Connexion administrateur</h2>

		<form method="POST" novalidate>
			<label for="username">Pseudo</label>
			<input type="text" id="username" name="username" value=""><br />	

			<label for="paswword">Mot de passe</label>	
			<input type="password" id="password" name="password" value=""><br />	

			<input type="submit" value="Go">
			<input type="reset" value="Reset">
			<div class="error"><?= $error ?></div>
		</form>

<?php $this->stop('main_content') ?>