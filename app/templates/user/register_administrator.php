<?php $this->layout('layout', ['title' => 'Inscription d\'un nouvel admin']) ?>

<?php $this->start('main_content') ?>
	
	<h2>Ajout d'un nouvel administrateur</h2>

		<p class="register_admin">Veuillez renseigner ci-dessous les informations de connexion d'un nouvel administrateur</p>

		<form method="POST" novalidate>
			<label for="username">Pseudo</label>		
			<input type="text" id="username" name="username" value="<?= $username ?>"><br />	

			<label for="email">Email</label>
			<input type="email" id="email" name="email" value="<?= $email ?>"><br />	

			<label for="paswword">Mot de passe</label>	
			<input type="password" id="password" name="password" value=""><br />	

			<label for="password_confirm">Mot de passe encore</label>
			<input type="password" id="password_confirm" name="password_confirm" value="">
			<br />	
			<input type="submit" value="Go">
			<input type="reset" value="Reset">
			<div class="error"><?= $error ?></div>
		</form>

<?php $this->stop('main_content') ?>