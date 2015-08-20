<?php $this->layout('layout', ['title' => 'Tous les termes']) ?>

<?php $this->start('main_content') ?>
	<h1>Tous les termes.</h1>

	<header>
		<a href="<?= $this->url('change_wotd') ?>" title="Modifier le mot du jour actuel">Nouveau Mot du Jour</a>
	</header>


	
	<table border="1px solid">
		<caption>Tableau Quebecois</caption>
			<thead>
				<tr>
					<th>Id</th>
					<th>Terme</th>
					<th>Date de modification</th>
					<th>Suppression</th>
					<th>Modification</th>
					<th>Mot du jour</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($terms as $term): ?>
					</tr <?php if ($term['is_wotd']) echo 'class="wotd"';?>>
						<td><?= $this->e( $term['id']); ?></td>
						<td><?= $this->e( $term['name']); ?></td>
						<td><?= $this->e( $term['modifiedDate']); ?></td>
						<td >
							<a href="<?php echo $this->url('delete_term', ['id' => $term['id']]) ?>"  class="erase" title="Effacer ce terme" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce terme ?'));">
							<i class="fa fa-trash-o"></i> Effacer
							</a>
						</td>
						<td >
							<a href="<?php echo $this->url('edit_term', ['id' => $term['id']]) ?>" class="edit" title="Modification de ce terme" onclick="return(confirm('Etes-vous sûr de vouloir modifier ce terme ?'));">
							<i class="fa fa-pencil"></i>  Modifier
							</a>
						</td>
						<td >
							<a href="<?php echo $this->url('change_wotd', ['id' => $term['id']]) ?>" class="motdujour" title="Choisir ce terme comme MDJ" onclick="return(confirm('Etes-vous sûr de vouloir choisir ce terme ?'));">
							<i class="fa fa-star"></i>  WOTD
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			<tbody>
	</table>

	**Afficher les termes ici **
	
<?php $this->stop('main_content') ?>
