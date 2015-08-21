<?php

namespace Controller;

use \W\Controller\Controller;

use \Manager\TermManager;

class TermController extends Controller
{
	/**
	 * Affiche tous les termes
	 */
	public function showAll()
	{   
		$this->allowTo('admin');
		$termManager = new \Manager\TermManager();

		$terms = $termManager->findAll("modifiedDate", "DESC");

		// debug($terms);

		// print_r(get_class_methods($termManager));

		$this->show('term/show_all_terms', ['terms' => $terms]);
	}

	/**
	 * Efface un terme
	 */
	public function delete($id)
	{   
		$this->allowTo('admin');
		$termManager = new\Manager\TermManager();

		// $deleteTerms = $termManager->delete($id);
		$termManager->delete($id);
		$this->redirectToRoute('show_all_terms');

	}

	public function edit($id)
	{   
		$this->allowTo('admin');
		$termManager = new \Manager\TermManager();

		$user = $this->getUser(); // retourne l'utilisateur connecté

		if (!empty($_POST)){

			$name = trim($_POST['name']);

			if (strlen($name) >1)
			{	
				$data = [
					"name" => $name,
					"modifiedDate" => date("Y-m-d H:i:s"),
				];

				//sauvegarder les modifications avec la méthode update() du TermManager
				$termManager->update(["name" => $name], $id);
				$this->redirectToRoute('show_all_terms');
			}
		}
		//récupérer en bdd le terme à modifier
		//grâce à la méthode ->find() du TermManager et à l'id)
		$term = $termManager->find($id);

		//debug($term);
		
		//sauvegarder les modifications avec -> update()
		//passer le terme à la vue
		$this->show('term/edit_term', ["term" => $term]);
	}


	public function changeWotd($id)
	{	
		$this->allowTo('admin');
		$termManager = new \Manager\TermManager();
		// debug($wotd);

		//Sélectionner le mot du jour actuel
		$wotd = $termManager->getCurrentWordOfTheDay();

		// faire un update sur l'ancien mot du jour pour le mettre à 0
		$termManager->update(['is_wotd' => 0], $wotd['id']);

		//faire un update sur le nouveau terme pour le mettre à 1
		$termManager->update(['is_wotd' => 1], $id);
		//rediriger vers la page d'accueil

		$this->redirectToRoute('show_all_terms');
	}

}