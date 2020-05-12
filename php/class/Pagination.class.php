<?php
/**
 * CodexWorld is a programming blog. Our mission is to provide the best online resources on programming and web development.
 *
 * This Pagination class helps to integrate ajax pagination in PHP.
 *
 * @class		Pagination
 * @author		CodexWorld
 * @link		http://www.codexworld.com
 * @contact		http://www.codexworld.com/contact-us
 * @version		1.0
 */
class Pagination {

	public $output; // Sortie HTML;
	public $nbtotal; // Nombre total de liens, de news, de n'importe quoi :)
	public $_getName; // Nom du _GET pour l'affichage des pages !

	public $nbmaxparpage;  // Nombre d'affichage par page
	private $nbdepages;    // Nombre de pages nécessaires
	public $minid;         // Retourne l'ID du premier enregistrement pour la page en cours

	/**
	 * Pagination constructor.
	 * @param $nbtotal
	 * @param int $nbmaxparpage
	 * @param string $getName
     */
	public function __construct($nbtotal, $nbmaxparpage = 10, $getName) {

		$this->nbtotal = (int) $nbtotal;
		$this->nbmaxparpage = (int) $nbmaxparpage;
		$this->nbdepages = ceil($this->nbtotal / $this->nbmaxparpage);
		$this->_getName = $getName;

	}

	/**
	 * @param $page
     */
	public function Generate($page) {

		unset($this->output);

		$pageencours = (isset($page[$this->_getName]) && (int) $page[$this->_getName] > 1 ) ? (int) $page[$this->_getName] : 1;
		$this->minid = ( $pageencours - 1 ) * $this->nbmaxparpage;
		if ( $this->nbdepages > 1 ) {
			for ( $i=1; $i <= $this->nbdepages; $i++ ) {
				if ( $i === $pageencours ) {
					$this->output[] = array('link' => FALSE, 'page' => $i);
				} else {
					$this->output[] = array('link' => TRUE, 'page' => $i);
				}
			}
		} else {
			$this->output = NULL;
		}
	}

}
?>