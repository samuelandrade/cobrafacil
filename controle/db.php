<?php
class db{
	/*
	 * "mysql" Banco de dados MySQL
         * "pg" Banco de dados PostgreSQL
	 */
	private $sgbd;
	private $database;
	private $server;
	private $username;
	private $passwd;
	
        public function __construct($driver) {
            $cnt = 0;
            $ini = 0;
            for($i = 0; $i < strlen($driver); $i++){
                if(substr($driver, $i, 1) == ';'){
                    $banco[$cnt] = substr($driver, $ini, $i - $ini);
                    $ini = $i+1;
                    $cnt++;
                }
            }
            $this->sgbd     = $banco[0];
            $this->server   = $banco[1];
            $this->database = $banco[2];
            $this->username = $banco[3];
            $this->passwd   = $banco[4];
        }
        
	public function conecta(){
		switch($this->sgbd){
			case "mysql":
				$conexao = mysql_connect($this->server, $this->username, $this->passwd);
				mysql_select_db($this->database);
			break;
                        case "pg":
                                $conexao = pg_connect("host=".$this->server." port=5432 dbname=".$this->database." user=".$this->username." password=".$this->passwd);
                        break;
		}
                return $conexao;
	}
	
	public function query($sql, $conexao){
		switch($this->sgbd){
			case "mysql":
				return mysql_query($sql, $conexao);
			break;
                        case "pg":
                                return pg_exec($conexao, $sql);
                        break;
		}
	}
	
	public function fetch_array($result){
		switch($this->sgbd){
			case "mysql":
				return mysql_fetch_array($result);
			break;
                        case "pg":
				return pg_fetch_array($result);
			break;
		}
	}
        
        public function num_rows($result){
		switch($this->sgbd){
			case "mysql":
				return mysql_num_rows($result);
			break;
		}
	}
	
	public function close($conexao){
		switch($this->sgbd){
			case "mysql":
				return mysql_close($conexao);
			break;
                        case "pg":
				return pg_close($conexao);
			break;
		}
	}
        
        public function select($sql){
		switch($this->sgbd){
			case "mysql":
				$cont = 0;
				$vetor[0] = null;
				$conexao = mysql_connect($this->server, $this->username, $this->passwd);
				mysql_select_db($this->database);
				$result = mysql_query($sql, $conexao);
				mysql_close($conexao);
				while($select = mysql_fetch_array($result)){
					$vetor[$cont] = $select;
					$cont++;
				}
				return $vetor;
			break;
		}
	}
}
?>
