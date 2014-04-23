<?php
class grupo{
	private $id;
	private $id_empresa;
	private $nome;

	public function __construct(){
		$this->id = NULL;
		$this->id_empresa = NULL;
		$this->nome = NULL;
	}

	public function get_id(){
		return $this->id;
	}
	public function get_id_empresa(){
		return $this->id_empresa;
	}
	public function get_nome(){
		return $this->nome;
	}
	
	
	public function set_id($id){
		if($id != '' && valida::numero($id)){
                    $this->id = $id;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_id_empresa($id_empresa){
		if($id_empresa != '' && valida::numero($id_empresa)){
                    $this->id_empresa = $id_empresa;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_nome($nome){
                $nome = addslashes($nome);
		if($nome != ''){
                    $this->nome = $nome;
                    return 1;
		}else{
                    return 0;
                }
        }

	
	
        public function existeGrupo($nome){
            $nome = addslashes($nome);
            $sql = "SELECT count(*) FROM grupo WHERE nome = '$nome' AND id_empresa = '".$_SESSION["cf_id_empresa"]."'";
            $db = new db(config::$driver);
            $con = $db->conecta();
            $res = $db->query($sql, $con);
            $grp = $db->fetch_array($res);
            $db->close($con);
            
            if($grp[0] > 0){
                return 1;
            }else{
                return 0;
            }
        }
        
	public function salvar(){
		$sql = "replace into grupo(id, id_empresa, nome) values('".$this->id."', '".$this->id_empresa."', '".$this->nome."')";

		$db = new db(config::$driver);
 		$con = $db->conecta();
		$res = $db->query($sql, $con);
		$db->close($con);
                
                new log($this->id_empresa, $_SESSION["cf_usuario"], $sql);

		return $res;
	}
	public function carregar($id){
		$sql = "select * from grupo where id = '$id'";

		$db = new db(config::$driver);
 		$con = $db->conecta();
		$res = $db->query($sql, $con);
		$db->close($con);

		$grupo = $db->fetch_array($res);

		$this->id = $grupo["id"];
		$this->id_empresa = $grupo["id_empresa"];
		$this->nome = $grupo["nome"];
		
		return 1;
	}
}