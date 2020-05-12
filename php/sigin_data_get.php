<?php

$year = date('Y');
$mode = 1;
/*
 * Get Autoset Code Candidat to implement new input for new Supplier
 */
// Hydrating method data
$donnees = array(
	'champs' => "COUNT(ID_CMPT)",
	'table' => demandeur,
	'where' => "MODE = :mode",
	'tri' => "ORDER BY ID_CMPT ASC",
);

$binding = array(':mode' => $mode);
$call = new Fourniss($bdd);

// Hydrating and lunch select method

$call->hydrate($donnees);
$call->select($binding);
// Get Code Compte
$code = $call->compte($year);

// -------------------- End --------------------------------------
/*
 * Get Autoset Code Candidat to implement new input for new Supplier
 */
// Hydrating method
$donnees = array(
	'champs' => "ID_DOM_A, LIBELLE",
	'table' => domaine,
	'where' => "MODE = :mode",
	'tri' => "ORDER BY ID_DOM_A ASC",
);

$binding = array(':mode' => $mode);

$getting = new Manager($bdd);
$getting->hydrate($donnees);
$getting->select($binding);

?>

