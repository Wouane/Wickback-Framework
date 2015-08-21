<?php
	
	$w_routes = array(
		// --------------------------------------ADMIN-------------------------------------------------
		//accueil de l'admin --------------------------------------------------------------------------
		['GET', '/admin/termes/', 'Term#showAll', 'show_all_terms'],
		// efface un terme ----------------------------------------------------------------------------
		['GET', '/admin/termes/suppression/[i:id]/', 'Term#delete', 'delete_term'],
		// modifie un terme ---------------------------------------------------------------------------
		['GET|POST', '/admin/termes/modification/[i:id]/', 'Term#edit', 'edit_term'],
		// changer le mot du jour ---------------------------------------------------------------------
		['GET', '/admin/termes/nouveau-mdj/[i:id]/', 'Term#changeWotd', 'change_wotd'],
		// Creer un nouvel administrateur -------------------------------------------------------------
		['GET|POST', '/admin/administrateurs/inscription/', 'User#register', 'register_administrator'],
		// connexion login ----------------------------------------------------------------------------
		['GET|POST', '/admin/connexion/', 'User#login', 'login'],
		//Déconnexion----------------------------------------------------------------------------------
		['GET', '/admin/deconnexion/', 'User#logout', 'logout'],
		//---------------------------------------------------------------------------------------------		
	);