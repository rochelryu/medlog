<?php
	/*
	 * Classe fournisseur
	 */
	class Fourniss extends Mysql_query{

		private $_candidat, $_existance, $_code_cat, $_LastId;


        /**
         * @param $year int l'année encours
         * @return string retourne un code
         */
        public function compte($year){

			$data = parent::getVariable();
			if (!empty($data)) {
				foreach ($data as $result) {
					$nbre_plus = str_pad($result[0] +1, 5, "0", STR_PAD_LEFT);

					$this->_candidat = "CAD-".$year."N°".$nbre_plus;

					return $this->_candidat;
				}
			}
		}


		/**
		 * @param array $checking
		 */
		public function checking_supplier(array $checking){

			if (is_array($checking)) {
				parent::hydrate($checking[0]);
				parent::select($checking[1]);
				$data = parent::getVariable();
				$this->_existance = (empty($data) ? (int) 0 : (int) 1);
			}
		}

		/**
		 * @param array $propriete
		 * @return object|string
         */
		public function create_supplier(array $propriete)
		{
			$exist = "";
			$existF = "";

			foreach ($propriete as $key => $value) {
				if ($this->_existance == 0) {
					if ($key == 'compte') {

						parent::hydrate($value[0]);
						parent::insert($value[1]);
						$this->_LastId = parent::getLastId();
						$exist = parent::getVariable();

					}
				}
			}
				if (!empty($exist)) {
					$existF = 'inserted';
					return $existF;
				} else {
					$existF = 'aborted';
					return $existF;
				}


		}

		/**
		 * @param array $propriete
		 * @return object|string
		 */
		public function create_supplier_second(array $propriete)
		{
			$exist = "";
			$existF = "";
			if ($this->_existance == 0) {

				foreach ($propriete as $key => $value) {
					if ($this->_LastId > 0 && $key != 'compte') {

						foreach ($value as $array) {

							parent::hydrate($array[0]);
							parent::insert($array[1]);
							$exist = parent::getVariable();
						}
					}
				}
			}
			if (!empty($exist)) {
				$existF = 'inserted';
				return $existF;
			} else {
				$existF = 'aborted';
				return $existF;
			}

		}

		public function create_supplier_second_alter(array $propriete)
		{
			$exist = "";
			$existF = "";
			if ($this->_existance == 0) {

				foreach ($propriete as $key => $value) {

						foreach ($value as $array) {

							parent::hydrate($array[0]);
							parent::insert($array[1]);
							$exist = parent::getVariable();
						}
				}
			}
			if (!empty($exist)) {
				$existF = 'inserted';
				return $existF;
			} else {
				$existF = 'aborted';
				return $existF;
			}

		}


		/**
		 * @param array $propriete
		 * @return object|string
		 */
		public function update_supplier(array $propriete)
		{
			$exist = "";
			$existF = "";

			foreach ($propriete as $key => $value) {
					if ($key == 'compte') {

						parent::hydrate($value[0]);
						parent::update($value[1]);
						$exist = parent::getVariable();

					}
			}
			if (!empty($exist)) {
				$existF = 'updated';
				return $existF;
			} else {
				$existF = 'aborted';
				return $existF;
			}


		}

		/**
		 * @param array $propriete
		 * @return object|string
		 */
		public function update_supplier_second(array $propriete)
		{
			$exist = "";
			$existF = "";
			if ($this->_existance == 0) {

				foreach ($propriete as $key => $value) {
					if ($key != 'compte') {

						foreach ($value as $array) {
							parent::hydrate($array[0]);
							parent::update($array[1]);
							$exist = parent::getVariable();
						}
					}
				}
			}
			if (!empty($exist)) {
				$existF = 'updated';
				return $existF;
			} else {
				$existF = 'aborted';
				return $existF;
			}

		}
		
		/**
		 * Connexion utilisateurs
		 * @param array $tablo
		 * @return bool
		 */
		public function connexion(array $tablo){

			$table = $tablo['table'];
			$login = $tablo['login'];
			$password = $tablo['pass'];
			// declare session variable
			$user_id = 0; $username = "";  $db_password ="";

			if ($stmt = $this->_bdd->prepare("SELECT ID_CMPT, CODE_CANDIDAT, PASS FROM ".$table." WHERE EMAIL = :email	LIMIT 1")) {

				$stmt->bindParam('email', $login, PDO::PARAM_STR);  // Lie "$email" aux paramètres.
				$stmt->execute();    // Exécute la déclaration.

				if ($stmt->rowCount() == 1) {

					$fetch = $stmt->fetchAll(PDO::FETCH_NUM);

					// Récupère les variables dans le résultat
					foreach ($fetch as $range){
						$user_id = $range[0];
						$username = $range[1];
						$db_password = $range[2];

					}

					// Si l’utilisateur existe, le script vérifie qu’il n’est pas verrouillé
					// à cause d’essais de connexion trop répétés
				$conect = $this->_bdd;

					if (checkbrute($user_id, $conect) == true) {
						// Le compte est verrouillé
						// Envoie un email à l’utilisateur l’informant que son compte est verrouillé
						// utiliser fonction mail send
						return false;
					} else {
						// Vérifie si les deux mots de passe sont les mêmes
						// Le mot de passe que l’utilisateur a donnée.

						if ($db_password == $password) {
			//	sec_session_start();
							// Le mot de passe est correct!
							// Récupère la chaîne user-agent de l’utilisateur
							$user_browser = $_SERVER['HTTP_USER_AGENT'];
							// Protection XSS car nous pourrions conserver cette valeur
							$user_id = preg_replace("/[^0-9]+/", "", $user_id);

							$_SESSION['user_id'] = $user_id;
							// Protection XSS car nous pourrions conserver cette valeur
							$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "",$username);

							$_SESSION['username'] = $username;

							$_SESSION['login_string'] = hash('sha512', $password . $user_browser);
							// Ouverture de session réussie.

							return true;
						} else {
							// Le mot de passe n’est pas correct
							// Nous enregistrons cet essai dans la base de données
							$now = time();
							$this->_bdd->exec("INSERT INTO login_attempts(ID_CMPT, TIMES) VALUES ('$user_id', '$now') ");
							return false;

						}
					}
				} else {
					// L’utilisateur n’existe pas.
					return false;
				}
			}

		}


		/**
		 * @param $table
		 * @return bool
		 */
		public function Veriflogin($table){

			// Vérifie que toutes les variables de session sont mises en place

			if(isset($_SESSION['user_id']  ,$_SESSION['username'] ,$_SESSION['login_string'])) {

				$user_id = $_SESSION['user_id'];
				$login_string = $_SESSION['login_string'];
				$username = $_SESSION['username'];

				// Récupère la chaîne user-agent de l’utilisateur
				$user_browser = $_SERVER['HTTP_USER_AGENT'];

				if ($stmt = $this->_bdd->prepare("SELECT PASS FROM ".$table." WHERE ID_CMPT = :id LIMIT 1")) {
					// Lie "$user_id" aux paramètres.
					$stmt->bindParam('id', $user_id);
					$stmt->execute();   // Exécute la déclaration.

					if ($stmt->rowCount() == 1) {
						$password = "";
						// Si l’utilisateur existe, récupère les variables dans le résultat
						$fetch = $stmt->fetchAll(PDO::FETCH_NUM);
						// Récupère les variables dans le résultat
						foreach ($fetch as $range){
							$password = $range[0];

						}


						$login_check = hash('sha512', $password . $user_browser);

						if ($login_check == $login_string) {
							// Connecté!!!!
							return true;
						} else {
							// Pas connecté
							return false;
						}
					} else {
						// Pas connecté
						return false;
					}
				} else {
					// Pas connecté
					return false;
				}
			}
			else {
				// Pas connecté
				return false;
			}
		}

		/**
		 * Deconnexion
		 *
		 */
		public function deconnexion(){

			// Détruisez les variables de session
			$_SESSION = array();

            // Retournez les paramètres de session
            $params = session_get_cookie_params();

			if (ini_get("session.use_cookies")) {
				$params = session_get_cookie_params();
				setcookie(session_name(), '', time() - 42000,
					$params["path"], $params["domain"],
					$params["secure"], $params["httponly"]
				);
			}

			unset($_SESSION);
			// Détruisez la session
			session_destroy();
			// echo "<script>document.location.href = 'http://".$_SERVER['HTTP_HOST']."/';</script>";
			header('Location: index.php');
			exit;
		}

		/**
		 * @return mixed
		 */
		public function getLastId()
		{
			return $this->_LastId;
		}

		/**
		 * Info for supplier connect
		 * @param $checking
		 * @return mixed
		 */
		public function information(array $checking){

			parent::hydrate($checking[0]);
			parent::select($checking[1]);
			$data = parent::getVariable();
			return $data;
		}

		/**
		 * Mise à jours des Documents Agrements
		 * @param array $checking
		 * @return mixed
         */
		public function MiseAjourDocAgre(array $checking)
		{
			$data = "";
			parent::hydrate($checking['verifie'][0]);
			parent::select($checking['verifie'][1]);
			$verif = parent::getVariable();
			if (empty($verif)) {
				parent::hydrate($checking['inserte'][0]);
				parent::insert($checking['inserte'][1]);
				$data = parent::getVariable();
			} else {
				foreach ($verif as $value) {
					$dossier_traite = "../../../SMART-MANAGER/Apps/HA-PRO/Acceuil/Interface/files/files_upload_dag/";
					$ancienDoc = pathinfo($value[2], PATHINFO_BASENAME);
					$ancien_extension = pathinfo($value[2], PATHINFO_EXTENSION);
					// On ouvre le dossier.
					$repertoire = opendir($dossier_traite);

// On lance notre boucle qui lira les fichiers un par un.
					while (false !== ($fichier = readdir($repertoire))) {
						// On met le chemin du fichier dans une variable simple
						$chemin = $dossier_traite . "/" . $fichier;

						// Les variables qui contiennent toutes les infos nécessaires.
						$infos = pathinfo($chemin);
						$extension = $infos['extension'];
						$basename = $infos['basename'];

// On n'oublie pas LA condition sous peine d'avoir quelques surprises. :p
						if ($fichier != "." && $fichier != ".." && !is_dir($fichier) &&
							$extension == $ancien_extension && $ancienDoc == $basename
						) {
							unlink($chemin);
						}
					}
					closedir($repertoire); // On ferme !
				}
				parent::hydrate($checking['update'][0]);
				parent::update($checking['update'][1]);
				$data = parent::getVariable();

				return $data;
			}
		}

		/**
		 * @param array $checking
		 * @return int
         */
		public function recupAgree(array $checking){

			parent::hydrate($checking[0]);
			parent::select($checking[1]);
			$data = parent::getVariable();
			$agres = 0;
			foreach ($data as $value){
				$agres = $value[0];
			}
			return $agres;
		}

		/**
		 * Mise à jours des Documents Agrements
		 * @param array $checking
		 * @return mixed
		 */
		public function MiseAjourDocOff(array $checking){
			$data = "";
			parent::hydrate($checking['verifie'][0]);
			parent::select($checking['verifie'][1]);
			$verif = parent::getVariable();

				if(empty($verif)){
				parent::hydrate($checking['inserte'][0]);
				parent::insert($checking['inserte'][1]);
				$data = parent::getVariable();
			}

			return $data;
		}

		/**
		 * @param $year int l'année encours
		 * @return string retourne un code
		 */
		public function codeCatalogue($year){

			$data = parent::getVariable();
			if (!empty($data)) {
				foreach ($data as $result) {
					$nbre_plus = str_pad($result[0] +1, 5, "0", STR_PAD_LEFT);

					$this->_code_cat = "CAT-".$year."/FRS/N°".$nbre_plus;

					return $this->_code_cat;
				}
			}
		}

		
	}
?>
