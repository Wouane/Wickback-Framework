<?php $this->layout('layout', ['title' => 'Reset name']) ?>

<?php $this->start('main_content') ?>

	<form method="POST">
		<label for="name">Ancien terme :</label>
		<h2><?= $this->e($term['name']) ?></h2>
		<label for="name">Le terme à modifier</label>
		<input type="text" id="name" name="name" value="<?= $this->e($term['name']) ?>">
		
		
		<input type="submit" value="Save">
	</form>

<?php $this->stop('main_content') ?>