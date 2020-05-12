<?php
	function get_file_ext($file)
	{
     
     $tab = pathinfo($file, PATHINFO_EXTENSION);     
     return $tab;
 }
?>