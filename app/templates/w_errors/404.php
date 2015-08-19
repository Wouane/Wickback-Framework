<?php $this->layout('error_layout', ['title' => 'ERROR 404 :: Vous êtes Perdu ?']) ?>

<?php $this->start('main_content'); ?>
<h1>404. Perdu ?</h1>
<img src="<?php echo $this->assetUrl('img/peugeot404.jpg'); ?>" alt="image404"/>

<?php $this->stop('main_content'); ?>
