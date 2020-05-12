<?php

/**
 * Class Manager
 * @lang php5
 */
    class Manager extends Mysql_query
    {

        /**
         * @param $nivo
         * @return  string
         */
        public function derouler($nivo,$select)
        {
            $data = parent::getVariable();
            if (!empty($data)) {
                foreach ($data as $list) {
                    if (is_string($nivo) && $nivo == 'one') {
                        $op_id = (int)$list[0];
                        $text = "";
                            if($select == $op_id){$text = "selected";}
                        
                        echo '<option value="' . $op_id . '" '.$text.'>' . $op_id . ' </option>';

                    } elseif (is_string($nivo) && $nivo == 'two') {
                        $op_id = (int)$list[0];
                        $op_text = (is_string($list[1]) ? $list[1] : (int)$list[1]);
                        $text = "";
                        if($select == $op_id){$text = "selected";}

                        echo '<option value="' . $op_id . '" '.$text.'> ' . $op_text . ' </option>';
                        
                    } elseif (is_string($nivo) && $nivo == 'three') {
                        $op_id = (int)$list[0];
                        $op_text = (is_string($list[1]) ? $list[1] : (int)$list[1]);
                        $op_text2 = (is_string($list[2]) ? $list[2] : (int)$list[2]);
                        $text = "";
                        if($select == $op_id){$text = "selected";}

                        echo '<option value="' . $op_id . '" '.$text.'>' . $op_text . ' ' . $op_text2 . '</option>';
                    }

                }
            }


        }

        /**
         * @param array $checking
         * @return string
         */
        public function details_domaine(array $checking)
        {

            $details = "";
            if (is_array($checking)) {
                parent::hydrate($checking[0]);
                parent::select($checking[1]);
                $data = parent::getVariable();

                foreach ($data as $result) {
                    $details .= $result[0].'; ';
            }
            }
    return $details;
        }


        /**
         * Téléchargement de fichier
         * @param $fichier
         * @param $Doc
         * @param $content_types_list
         * @return mixed|string
         */
        public function uploading(array $browsing)
        {
            $fichier = $browsing['files'];
            $Doc = $browsing['doc'];
            $content_types_list = $browsing['mime'];
            $nameDoc = "";

            for ($j = 0; $j < 1; $j++) {

                $file = $fichier['name'][$j];

                $ext = get_file_ext($file);

                if (array_key_exists($ext, $content_types_list)) {

// Nettoyage du nom de fichier

                    $nom_fichier = preg_replace('/[^a-z0-9\.\-]/i', '', $fichier['name'][$j]);

                    $strong = true;
                    $prefix = openssl_random_pseudo_bytes(30, $strong);
                    if(is_bool($prefix))
                    {
                        $prefix = uniqid();
                    }
                    else
                    {
                        $prefix = bin2hex($prefix);
                    }
                    $nom_unique = sha1(uniqid($prefix, true));

                    // $new_file = basename($nom_fichier,'.'.$ext);
// Déplacement depuis le répertoire temporaire

                    move_uploaded_file($fichier['tmp_name'][$j], $Doc . $nom_unique.'.'.$ext);
                    $nameDoc = $nom_unique.'.'.$ext;

                }
            }

            return $nameDoc;

        }

        /**
         * Téléchargement de fichier multiple dans une boucle
         * @param array $browsing
         * @return mixed|string
         */
        public function upload_Multiple(array $browsing)
        {
            $fichierName = $browsing['name'];
            $fichierTemp = $browsing['temp'];
            
            $Doc = $browsing['doc'];
            $content_types_list = $browsing['mime'];
            $nameDoc = "";

                $file = $fichierName;

                $ext = get_file_ext($file);

                if (array_key_exists($ext, $content_types_list)) {

// Nettoyage du nom de fichier

                    $nom_fichier = preg_replace('/[^a-z0-9\.\-]/i', '', $fichierName);

                    $strong = true;
                    $prefix = openssl_random_pseudo_bytes(30, $strong);
                    if(is_bool($prefix))
                    {
                        $prefix = uniqid();
                    }
                    else
                    {
                        $prefix = bin2hex($prefix);
                    }
                    $nom_unique = sha1(uniqid($prefix, true));

                    // $new_file = basename($nom_fichier,'.'.$ext);
// Déplacement depuis le répertoire temporaire

                    move_uploaded_file($fichierTemp, $Doc . $nom_unique.'.'.$ext);
                    $nameDoc = $nom_unique.'.'.$ext;

                }

            return $nameDoc;

        }
        
        /**
         * Liste de tous les agrements
         * @param array $checking
         * @return mixed
         */
        public function listAgrement(array $checking){

            parent::hydrate($checking[0]);
            parent::select($checking[1]);
            $data = parent::getVariable();
            return $data;
        }

        /** Postuler a un agrement
         * @param $bdd
         * @param $table
         * @param $type
         * @param $user
         * @param $postId
         * @param $date
         * @return string
         */
        public function postuler($bdd, $table, $type, $user, $postId, $date){
            $test = "";
            $mode = 1;
            if($type == 'agr'){
                 //utilisation de update
                $rep =$bdd->prepare("SELECT * FROM ".$table."  WHERE ID_CMPT = :comp AND ID_AGR = :agr ORDER BY ID_POSTULER_D ");
                $rep->bindParam(':comp',$user, PDO::PARAM_INT);
                $rep->bindParam(':agr',$postId,PDO::PARAM_INT);
                $rep->execute();
                $nbr = $rep->rowCount();

                if($nbr > 0){ $test = $nbr;}
                elseif($nbr == 0) {
                    $valid = $bdd->prepare("INSERT INTO ".$table." (ID_AGR, ID_CMPT, DATE_POST, MODE) VALUES(?, ?, ?, ?) ");
                    $valid->bindValue(1,$postId,PDO::PARAM_INT);
                     $valid->bindValue(2, $user, PDO::PARAM_INT);
                     $valid->bindValue(3, $date,PDO::PARAM_STR);
                     $valid->bindValue(4,$mode ,PDO::PARAM_INT);
                    $valid->execute();
                    $valid->closeCursor();
                    $test = $valid;
                    if(!empty($valid)) {
                        $test = 'ok';
                    }
                }

            }
            elseif($type == 'offre'){

                //utilisation de update
                $rep =$bdd->prepare("SELECT * FROM ".$table."  WHERE ID_AGRE = :comp AND ID_APPEL = :appel ORDER BY ID_POSTULE_O ");
                $rep->bindParam(':comp',$user, PDO::PARAM_INT);
                $rep->bindParam(':appel',$postId,PDO::PARAM_INT);
                $rep->execute();
                $nbr = $rep->rowCount();

                if($nbr > 0){ $test = 'none';}
                elseif($nbr == 0) {

                    $valid = $bdd->prepare("INSERT INTO ".$table." (ID_APPEL, ID_AGRE, DATE_POST, MODE) VALUES(?, ?, ?, ?) ");
                    $valid->bindValue(1,$postId,PDO::PARAM_INT);
                    $valid->bindValue(2, $user, PDO::PARAM_INT);
                    $valid->bindValue(3, $date,PDO::PARAM_STR);
                    $valid->bindValue(4,$mode ,PDO::PARAM_INT);
                    $valid->execute();
                    $valid->closeCursor();
                    if(!empty($valid)) {
                        $test = 'ok';
                    }
                }

            }
            return $test;
        }

        /** Afficher la liste des postes agrements
         * @param $bdd
         * @param $lab
         * @param $tableAgr
         * @param $tablePos
         * @param $user
         */
        public function postAgrement ($bdd, $lab, $tableAgr, $tablePos, $user, $date){
            $mode = 1;

            $rep =$bdd->prepare("SELECT ".$tablePos.".ID_AGR, LIBELLE, DATE_POST 
                                 FROM ".$tableAgr.",".$tablePos."
                                 WHERE ".$tableAgr.".ID_AGR = ".$tablePos.".ID_AGR
                                 AND ".$tablePos.".ID_CMPT = :comp 
                                 AND ".$tablePos.".MODE = :mode
                                 AND (".$tableAgr.".DATE_C >= :dates OR ".$tableAgr.".DATE_C = 'Illimit&eacute;')
                                 AND ".$tableAgr.".MODE = :mode
                                 ORDER BY ".$tablePos.".ID_AGR DESC LIMIT 15");
            $rep->bindParam(':comp',$user, PDO::PARAM_INT);
            $rep->bindParam(':dates',$date, PDO::PARAM_STR);
            $rep->bindParam(':mode',$mode, PDO::PARAM_INT);
            $rep->execute();
            $nbr = $rep->rowCount();

            if($nbr > 0){
                $datas = $rep->fetchAll(PDO::FETCH_BOTH);
                foreach ($datas as $value){
                ?>
                <tr>
                <td><a class="click-post btn" href="?lab=<?php echo $lab.$value[0];?>"><i class="fa fa-angle-double-right"></i> <?php echo $value[1];?></a></td>
                <td valign="middle">le :<span class="label label-primary"><?php echo $value[2];?></span></td>
                </tr>
          <?php
            }
            }
            elseif($nbr == 0) {?>
            <tr> 
                <td><a href="javascript:void(0);" class="btn"><i class="fa fa-angle-double-right"></i><p>Aucun Agrément</p></a></td>
            </tr>
           <?php }
        }

        /** Afficher la liste des postes offre
         * @param $bdd
         * @param $lab
         * @param $tableAgr
         * @param $tablePos
         * @param $user
         */
        public function postOffre ($bdd, $lab, $tableOff, $tablePos, $user, $date){
            $mode = 1;

            $rep = $bdd->prepare("SELECT ".$tablePos.".ID_APPEL, LIBELLE, DATE_POST 
                                 FROM ".$tableOff.",".$tablePos."
                                 WHERE ".$tableOff.".ID_APPEL = ".$tablePos.".ID_APPEL
                                 AND ".$tablePos.".ID_AGRE = :comp 
                                 AND ".$tablePos.".MODE = :mode
                                 AND ".$tableOff.".MODE = :mode
                                 ORDER BY ".$tablePos.".ID_AGRE ");
            $rep->bindParam(':comp',$user, PDO::PARAM_INT);
            $rep->bindParam(':mode',$mode, PDO::PARAM_INT);
            $rep->execute();
            $nbr = $rep->rowCount();

            if($nbr > 0){
                $datas = $rep->fetchAll(PDO::FETCH_BOTH);
                foreach ($datas as $value){
                    ?>
                <tr>
                <td><a class="click-post btn" href="?lab=<?php echo $lab.$value[0];?>"><i class="fa fa-angle-double-right"></i> <?php echo $value[1];?></a></td>
                <td valign="middle">le :<span class="label label-primary"><?php echo $value[2];?></span></td>
                </tr>
                    <?php
                }
            }
            elseif($nbr == 0) {?>
            <tr>
                <td><a href="javascript:void(0);" class="btn"><i class="fa fa-angle-double-right"></i><p>Aucune Offre</p></a></td>
            </tr>
            <?php }
        }

        /** Afficher la liste des sujets Agrements
         * @param $bdd
         * @param $lab
         * @param $tableA
         * @param $tablePos
         * @
         */
        public function listeSujetA ($bdd, $lab, $tablePos, $tableA){
            $mode = 1;

            $rep = $bdd->prepare("SELECT ".$tablePos.".ID_SUJ_A, ".$tablePos.".LIBELLE ,COMMENT
                                 FROM ".$tablePos.",".$tableA."
                                 WHERE ".$tablePos.".ID_AGR = ".$tableA.".ID_AGR
                                 AND ".$tablePos.".MODE = :mode
                                 AND ".$tableA.".MODE = :mode
                                 ORDER BY ".$tablePos.".ID_SUJ_A ");
            $rep->bindParam(':mode',$mode, PDO::PARAM_INT);
            $rep->execute();
            $nbr = $rep->rowCount();

            if($nbr > 0){
                $datas = $rep->fetchAll(PDO::FETCH_BOTH);
                foreach ($datas as $value){
                    ?>
                    <li><a class="click-post" href="?lab=<?php echo $lab.$value[0];?>">
                            <i class="fa fa-angle-double-right"></i><p><?php echo $value[1];?></p></a><span class="badge">(<?php echo $value[2];?>)</span></li>
                    <?php
                }
            }
            elseif($nbr == 0) {?>
                <li><a href="#"><i class="fa fa-angle-double-right"></i><p>Aucun sujet disponible</p></a><span class="badge">(0)</span></li>
            <?php }
        }

        /** Afficher la liste des sujets Agrements
         * @param $bdd
         * @param $lab
         * @param $tableO
         * @param $tablePos
         * @
         */
        public function listeSujetO ($bdd, $lab, $tablePos, $tableO){
            $mode = 1;

            $rep = $bdd->prepare("SELECT ".$tablePos.".ID_SUJ_O, ".$tablePos.".LIBELLE , COMMENT
                                 FROM ".$tablePos.",".$tableO."
                                 WHERE ".$tablePos.".ID_APPEL = ".$tableO.".ID_APPEL
                                 AND ".$tablePos.".MODE = :mode
                                 AND ".$tableO.".MODE = :mode
                                 ORDER BY ".$tablePos.".ID_SUJ_O ");
            $rep->bindParam(':mode',$mode, PDO::PARAM_INT);
            $rep->execute();
            $nbr = $rep->rowCount();

            if($nbr > 0){
                $datas = $rep->fetchAll(PDO::FETCH_BOTH);
                foreach ($datas as $value){
                    ?>
                    <li><a class="click-post" href="?lab=<?php echo $lab.$value[0];?>">
                            <i class="fa fa-angle-double-right"></i><p><?php echo $value[1];?></p></a><span class="badge">(<?php echo $value[2];?>)</span></li>
                    <?php
                }
            }
            elseif($nbr == 0) {?>
                <li><a href="#"><i class="fa fa-angle-double-right"></i><p>Aucun sujet disponible</p></a><span class="badge">(0)</span></li>
            <?php }
        }



    }
?>