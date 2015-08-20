<?php

namespace Controller;

use \W\Controller\Controller;
use \Manager\UserManager;

class UserController extends Controller
{
	public function register()
	{	

		$userManager = new UserManager();
		$error = "";
		$username = "";
		$email = "";


		//formulaire d'inscription soumis ?
		if(!empty($_POST)){
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
					"username" => $username,
					"email" => $email,
					"password" => $hashedPassword,
					"role" => "admin",
					"dateCreated" => date("Y-m-d H:i:s"),
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