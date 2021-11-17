<?php
require_once File::build_path(array("model","ModelClients.php"));

class ControllerClients {
	public static function readAll() {
		$tab_cli = ModelClients::getAllClients();
		$controller='clients';
		$view='list';
		$pagetitle='Liste des clients';
		require File::build_path(array("view","view.php"));
	}

	public static function read() {
		$client = $_GET['client'];
		$c = Modelclients::getClient($client);
		if ($c===false) {
			$controller='clients';
			$view='error';
			$pagetitle='Erreur';
			require File::build_path(array("view","view.php"));
		} else {
			$controller='clients';
			$view='detail';
			$pagetitle='Détail de client';
			require File::build_path(array("view","view.php"));
		}
		
	}

	public static function create() {
		$controller='clients';
		$view='create';
		$pagetitle='Créer un client';
		require File::build_path(array("view","view.php"));
	}


	public static function created() {
		/*
https://webinfo.iutmontp.univ-montp2.fr/~depeyreg/index.php?
action=created
&controller=clients&
nom=roub_humain&
prenom=Gatien&
mail=test%40pandore.dnd&
mdp=test&
adresse=1+rue+jdr&
telephone=0123456789
		*/
		$nomClient = $_GET['nom'];
		$prenomClient = $_GET['prenom'];
		$mail = $_GET['mail'];
		$telephone = $_GET['telephone'];
		$mdp = $_GET['mdp'];
		$adresse = $_GET['adresse'];
		echo("</br></br>adresse=".$adresse."</br></br></br></br></br>");
		$c = new ModelClients(NULL, $nomClient,$prenomClient,$mail,$telephone,$mdp,$adresse);
		$c->save();
		$controller='clients';
		$view='created';
		$pagetitle='Client créé';
		$tab_cli = ModelClients::getAllClients();
		require File::build_path(array("view","view.php"));
	}


	public static function login() {
		$controller='clients';
		$view='login';
		$pagetitle='Se connecter';
		require File::build_path(array("view","view.php"));
	}

	public static function verification() {
		$c = ModelClients::clientExiste($_GET['mail'],$_GET['mdp']);
		if ($c===false) {
			ControllerClients::login();
		} else {
			$controller = '';
			$view = '';
			$pagetitle = '';
		}
	}

	
	/*public static function login(){
		
		if(isset($_GET['mail']) && isset($_GET['mdp'])){
			//Si l'id et le mdp ont été remplis
			$c = ModelClients::clientLogin($_GET['mail'], $_GET['mdp']);
			if(c===false){
				$controller='clients';
				$view='error';
				$pagetitle='Erreur';
				require File::build_path(array("view","view.php"));
			}
			else{
				$controller='clients';
				$view='detail';
				$pagetitle='Connexion réussie';
				require File::build_path(array("view","view.php"));
			}
		}
		else{
			//Si l'id et le mdp n'ont pas été remplis
			$controller='clients';
			$view='login';
			$pagetitle="S'enregistrer";
			require File::build_path(array("view","view.php"));
		}
	}*/
}
	
?>

