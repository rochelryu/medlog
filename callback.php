<?php

/**
 * @param $classe Invocation total et imediate de tous les classes existantes depuis l'instanciation
 */
function chargerClasse ($classe)
{
require_once ('php/class/'. $classe . '.class.php'); // On inclue la classe
//correspondante au paramètre passé
}
spl_autoload_register ('chargerClasse'); // On enregistre la
//fonction en autoload pour qu'elle soit appelée dès qu'on
//instanciera une classe non déclarée

?>
