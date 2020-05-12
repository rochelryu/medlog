<?php

	class Mysql_query{

		protected $_champs,
		 $_table,
         $_where,
         $_tri,
         $_value,
         $_value_up,
         $_modes,
         $_variable,
         $_lastId,
         $_bdd;

        /**
         * Mysql_query constructor.
         * @param $bdd
         */
      public function __construct($bdd)
        {
            $this->setBdd($bdd);
            unset($this->_table);
            unset($this->_where);
            unset($this->_tri);
            unset($this->_value);
            unset($this->_value_up);
            unset($this->_modes);
            unset($this->_lastId);
            unset($this->_variable);
        }

        public function table() { return $this->_table; }
        public function where() { return $this->_where; }
        public function tri() { return $this->_tri; }
        public function value() { return $this->_value; }
        public function value_up() { return $this->_value_up; }
        public function mode() { return $this->_modes; }
        public function variable() { return $this->_variable; }
        public function lastId() { return $this->_variable; }

        /**
         * @param array $donnees contiendra les informations de mise a jours des variable
         */
        public function hydrate(array $donnees)
        {
            foreach ($donnees as $key => $data)
            {
                $method = 'set'.ucfirst($key);
                if (method_exists($this, $method))
                {
                // On appelle le setter
                    $this->$method($data);
                }
                // ...
            }
            unset($donnees);
        }
      /**
         * @param mixed $bdd
         */
        public function setBdd($bdd)
        {
            $this->_bdd = $bdd;
        }


        /**
         * @param mixed $champs
         */
        public function setChamps($champs)
        {
            $this->_champs = $champs;
        }

        /**
         * @param mixed $table
         */
        public function setTable($table)
        {
            $this->_table = $table;
        }

        /**
         * @param mixed $where
         */
        public function setWhere($where)
        {
            $this->_where = $where;
        }

        /**
         * @param mixed $tri
         */
        public function setTri($tri)
        {
            $this->_tri = $tri;
        }

        /**
         * @param mixed $value
         */
        public function setValue($value)
        {
            $this->_value = $value;
        }

        /**
         * @param mixed $value_up
         */
        public function setValue_Up($value_up)
        {
            $this->_value_up = $value_up;
        }

        /**
         * @param mixed $modes
         */
        public function setModes($modes)
        {
            $this->_modes = $modes;
        }


        /**
         * Function d'insertion
         * @param array $binding
         * @return object
         */
        public function insert(array $binding){

            $req = $this->_bdd->prepare("INSERT INTO ".$this->_table."(".$this->_champs.") VALUES (".$this->_value.")");
            $var = $req->execute($binding);
            $this->_variable = $var;

            $this->_lastId = $this->_bdd->lastInsertId();
            unset($binding);
            $req->closeCursor();
        }

        /**
         * Function de Insetrion si existe mise à jours
         * @param array $binding
         */
        public function insert_update(array $binding){

            $req = $this->_bdd->prepare("INSERT INTO ".$this->_table." (".$this->_champs.") VALUES (".$this->_value.")
                                         ON DULICATE KEY UPDATE ".$this->_value_up." ");
            $var = $req->execute($binding);
            $this->_variable = $var;

           // $this->_lastId = $this->_bdd->lastInsertId();
            unset($binding);
            $req->closeCursor();

        }

        /**
         * Function mise à jours
         * @param array $binding
         */
        public function update(array $binding){

            $req = $this->_bdd->prepare("UPDATE ".$this->_table." SET ".$this->_modes." WHERE ".$this->_where);
            $var = $req->execute($binding);
            $this->_variable = $var;

            unset($binding);
            $req->closeCursor();

        }

        /**
         * Function de suppression
         * @param array $binding
         */
        public function delete(array $binding){

            $req = $this->_bdd->prepare("DELETE FROM ".$this->_table." WHERE ".$this->_where);
            $var = $req->execute($binding);
            $this->_variable = $var;

            unset($binding);
            $req->closeCursor();

        }

        /**
         * Function de selection
         * @param $binding array
         */
        public function select(array $binding){

            $req = $this->_bdd->prepare('SELECT '.$this->_champs.' FROM '.$this->_table.' WHERE '.$this->_where.' '.$this->_tri);
            $req->execute($binding);
            $this->_variable = $req->fetchAll(PDO::FETCH_BOTH);

            unset($binding);
            $req->closeCursor();

        }

        /**
         * @return mixed
         */
        public function getVariable()
        {
            return $this->_variable;
        }

        /**
         * @return mixed
         */
        public function getLastId()
        {
            return $this->_lastId;
        }


    }
?>
