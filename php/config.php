 <?php
 require_once('../functions/pdo_connect.php');
 require_once('../functions/function.traitement.php');
 require_once('../define/define.php');
 require_once('../functions/encode_utf8.php');
 require_once('../functions/extension.php');
 require_once('../callback.php');
 if (!isset($_SESSION)) {
    session_start();
 }
extract($_POST);

 $supplier = new Fourniss($bdd);
 $pass = "";
 $login = "";
 $error_msg = "";
      //if(isset($_POST['connexion'])) {

          if (isset($_POST['login'], $_POST['password'])) {
              // Nettoyez et validez les données transmises au script
              $pass = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
              $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_EMAIL);
              $login = filter_var($login, FILTER_VALIDATE_EMAIL);
              if (!filter_var($login, FILTER_VALIDATE_EMAIL)) {
                  // L’adresse email n’est pas valide
                  $error_msg = 'none';
              }
          }
  $tablo['table'] = demandeur;
          $tablo['login'] = htmlentities(addslashes($login));
          $tablo['pass'] = sha1(htmlentities(addslashes($pass)));

          if ($supplier->connexion($tablo) == true) {
              $error_msg = 'ok';
          }else{
              $error_msg = 'none';
          }

     // }
 $tab = array('exist' => $error_msg);
 print json_encode($tab, JSON_NUMERIC_CHECK);
?>