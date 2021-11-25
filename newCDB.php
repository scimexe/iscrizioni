<?php

	class CDB{
		private $host='127.0.0.1';
		private $user='andrea';
		private $passwd='root';
		private $nomeDB='inserzioni';
		private $conn;

        public function connessione(){
            $this->conn = new mysqli($this->host, $this->user, $this->passwd, $this->nomeDB);
            if($this->conn->connect_error){
                die("Connessione fallita: " . $conn->connect_error);
            }
        }

        private function connessioneROOT(){
			$this->conn= new mysqli($this->host,$this->user,$this->passwd);
			if($this->conn->connect_error){
                die("Connessione fallita: " . $conn->connect_error);
            }
        }

        private function creaDB(){
            $this->connessioneROOT();
			$this->conn->query("CREATE DATABASE ".$this->nomeDB);
			$r=$this->conn->error;
			$this->conn->close();
			return $r;
		}

        public function test(){
            return $this->creaDB();
        }

        public function fCreaCitta(){
            $sql="CREATE TABLE IF NOT EXISTS $this->nomeDB.tbCitta(
				idCodice CHAR(5) NOT NULL,
				PRIMARY KEY (idCodice),
				denominazione VARCHAR(100) NOT NULL);
            ";    
            $this->connessioneROOT();
            if($this->conn->query($sql) == null){
                return $this->conn->error;
            }
            else{
                return "";
            }
            $this->conn->close();
        }

        public function fcreaRuoli(){
            $sql="CREATE TABLE IF NOT EXISTS $this->nomeDB.tbRuoli(
                idRuolo INT NOT NULL,
				PRIMARY KEY (idRuolo),
				ruolo VARCHAR (50) NOT NULL);
            ";
            $this->connessioneROOT();
            if($this->conn->query($sql) == null){
                return $this->conn->error;
            }
            else{
                return "";
            }
            $this->conn->close();
        }

        public function fcreaNazioni(){
            $sql="CREATE TABLE IF NOT EXISTS inserzioni.tbNazioni(
                idNazione CHAR (10),
                PRIMARY KEY (idNazione),
                denominazione VARCHAR (100) NOT NULL,
                cittadinanza VARCHAR (100) NOT NULL);
            ";    
            $this->connessioneROOT();
            if($this->conn->query($sql) == null){
                return $this->conn->error;
            }
            else{
                return "";
            }
            $this->conn->close();
        }

        public function fcreaComponenti(){
            $sql="CREATE TABLE IF NOT EXISTS inserzioni.tbComponenti(
				idComponente INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY (idComponente),
				denominazione VARCHAR (100) NOT NULL);
            ";
            $this->connessioneROOT();
            if($this->conn->query($sql) == null){
                return $this->conn->error;
            }
            else{
                return "";
            }
            $this->conn->close();
        }

        public function fcreaAnagrafiche(){
            $sql="CREATE TABLE IF NOT EXISTS inserzioni.tbAnagrafica(
                idAnagrafica BIGINT NOT NULL AUTO_INCREMENT,
                PRIMARY KEY(idAnagrafica),
                nome VARCHAR (100) NOT NULL,
                cognome VARCHAR (100) NOT NULL,
                dataNascita DATE NOT NULL,
                codiceFiscale CHAR (16) NOT NULL UNIQUE,
                extCittaNascita CHAR (5) NOT NULL,
                FOREIGN KEY(extCittaNascita) REFERENCES tbCitta(idCodice),
                extNazione CHAR (10) NOT NULL,
                FOREIGN KEY(extNazione) REFERENCES tbNazioni(idNazione),
                extComponente INT NOT NULL,
                FOREIGN KEY(extComponente) REFERENCES tbComponenti(idComponente),
                inserimento TIMESTAMP NOT NULL);
            ";
            $this->connessioneROOT();
            if($this->conn->query($sql) == null){
                return $this->conn->error;
            }
            else{
                return "";
            }
            $this->conn->close();
        }

        public function fcreaAccount(){
            $sql="CREATE TABLE IF NOT EXISTS inserzioni.tbAccount(
				user VARCHAR (100) NOT NULL,
                PRIMARY KEY (user),
				passwd VARCHAR (32) NOT NULL,
				livello INT NOT NULL,
                extAnagrafica BIGINT,
				FOREIGN KEY(extAnagrafica) REFERENCES tbAnagrafica(idAnagrafica));
				
            ";
            $this->connessioneROOT();
            if($this->conn->query($sql) == null){
                return $this->conn->error;
            }
            else{
                return "";
            }
            $this->conn->close();
        }

        public function fcreaCittadinanze(){
            $sql="CREATE TABLE IF NOT EXISTS inserzioni.tbCittadinanze(
				extAnagrafica BIGINT NOT NULL,
                FOREIGN KEY(extAnagrafica) REFERENCES tbAnagrafica(idAnagrafica),
				extNazione CHAR (5) NOT NULL,
                FOREIGN KEY(extNazione) REFERENCES tbNazioni(idNazione));
                
            ";
            $this->connessioneROOT();
            if($this->conn->query($sql) == null){
                return $this->conn->error;
            }
            else{
                return "";
            }
            $this->conn->close();
        }   

        public function fcreaRuoliAnagrafica(){
            $sql="CREATE TABLE IF NOT EXISTS inserzioni.tbRuoliAnagrafica(
				extAnagrafica BIGINT NOT NULL,
				extRuoli INT NOT NULL,
                FOREIGN KEY (extAnagrafica) REFERENCES tbAnagrafica(idAnagrafica),
                FOREIGN KEY (extRuoli) REFERENCES tbRuoli(idRuolo));

            ";
            $this->connessioneROOT();
            if($this->conn->query($sql) == null){
                return $this->conn->error;
            }
            else{
                return "";
            }
            $this->conn->close();

        } 
    }
?>
