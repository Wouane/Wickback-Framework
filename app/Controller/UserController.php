<?php

namespace Controller;

use \W\Controller\Controller;
use \Manager\UserManager;
use \W\Security\AuthentificationManager;

class UserController extends Controller
{	

	public function logout()
	{
		$am = new AuthentificationManager();
		$am->logUserOut();
		$this->redirectToRoute('login');
	}

	public function login()
	{
		$am = new AuthentificationManager();
		$error = "";
		$username = "";
		$data = [];

		//traitement du formulaire
		if(!empty($_POST))
		{
			debug($_POST);
			//VALIDATION
			$username = $_POST['username'];
			$password = $_POST['password'];			
			$result = $am->isValidLoginInfo($username, $password);
			//SI VALIDE : CONNEXION
			if ($result > 0){
				//la fonction isValidLoginInfo nous a donné l'id du User
				$userId = $result;
				//Récupère l'utilisateur
				$userManager = new \Manager\UserManager();
				$user = $userManager->find($userId);

				//connecte l'user
				$am->logUserIn($user);

				//redirection
				$this->redirectToRoute('show_all_terms');
			}
			else{
				$error = "no";
			}
		}

		$data['error'] = $error;
		$data['username'] = $username;
		$this->show('user/login', $data);

		$this->show('user/login');
	}



	public function register()
	{	
		$this->allowTo('admin');
		$userManager = new UserManager();
		$error = "";
		$username = "";
		$email = "";


		//formulaire d'inscription soumis ?
		if(!empty($_POST))
		{
			//ninja shit ?

			foreach($_POST as $key => $value){
				//créer une variable $username, $email, $password, etc...
				$$key = trim(strip_tags($value));
			}
			// //La boucle foreach revient à écrire v
			// $username    	 = trim(strip_tags($_POST['username'])); 
			// $email 			 = trim(strip_tags($_POST['email'])); 
			// $password 		 = trim(strip_tags($_POST['password']));
			// $password_confirm = trim(strip_tags($_POST['password_confirm']));



			/*Validadation*/
			//-----------------------------------------------------
			//username assez long ?
			if(strlen($username) < 4){
				$error = "Votre pseudo est trop court";
			}
			//-----------------------------------------------------
			//pseudo déjà présent dans la bdd ?
			if($userManager->usernameExists($username)){
				$error= "Pseudo déjà utilisé !";
			}
			//-----------------------------------------------------
			//email déjà présent dans la bdd ?
			if($userManager->emailExists($email)){
				$error = "Email déjà existant !";
			}
			//-----------------------------------------------------
			//email valide
			elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$error = "Email non valide";
			}

			//-----------------------------------------------------
			//mot de passe correspondent?
			if ($password != $password_confirm){
				$error = "Les mots de passe ne correspondent pas !";
			}
			//-----------------------------------------------------
			/*Fin de validation*/
			//si valide ..
			if(empty($error)){
				//hacher le mot de passe
				$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

				$newAdmin = [
					"username" 	   => $username,
					"email" 	   => $email,
					"password" 	   => $hashedPassword,
					"role" 		   => "admin",
					"dateCreated"  => date("Y-m-d H:i:s"),
					"dateModified" => date("Y-m-d H:i:s")
				];

				//insérer en base
				$userManager->insert($newAdmin);

				
			}
		}	
		//afficher bravo ou rediriger ou faire quelque chose de bien
		// si invalide..
		//envoyer les erreurs et les données soumises à la vue
		$dataToPassToTheView = [
			"username" => $username,
			"email" => $email,
			"error" => $error
		];

		$this->show('user/register_administrator', $dataToPassToTheView);
		}

}