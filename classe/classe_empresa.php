<?php
class empresa{
	private $id;
	private $empresa;
	private $cnpj;
        private $logo;
	private $telefone;
	private $email;
	private $endereco;
	private $bairro;
	private $cidade;
	private $estado;
	private $cep;
	private $dt_cadastro;

	public function __construct(){
		$this->id = NULL;
		$this->empresa = NULL;
		$this->cnpj = NULL;
                $this->logo = NULL;
		$this->telefone = NULL;
		$this->email = NULL;
		$this->endereco = NULL;
		$this->bairro = NULL;
		$this->cidade = NULL;
		$this->estado = NULL;
		$this->cep = NULL;
		$this->dt_cadastro = NULL;
	}

	public function get_id(){
		return $this->id;
	}
	public function get_empresa(){
		return $this->empresa;
	}
	public function get_cnpj(){
		return $this->cnpj;
	}
        public function get_logo(){
		return $this->logo;
	}
	public function get_telefone(){
		return $this->telefone;
	}
	public function get_email(){
		return $this->email;
	}
	public function get_endereco(){
		return $this->endereco;
	}
	public function get_bairro(){
		return $this->bairro;
	}
	public function get_cidade(){
		return $this->cidade;
	}
	public function get_estado(){
		return $this->estado;
	}
	public function get_cep(){
		return $this->cep;
	}
	public function get_dt_cadastro(){
            if($this->dt_cadastro != ''){
                $dia = substr($this->dt_cadastro, 8, 2);
                $mes = substr($this->dt_cadastro, 5, 2);
                $ano = substr($this->dt_cadastro, 0, 4);
		return $dia."/".$mes."/".$ano;
            }else{
                return '';
            }
	}
	
	
	public function set_id($id){
		if($id != '' && valida::numero($id)){
                    $this->id = $id;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_empresa($empresa){
		if($empresa != '' && valida::nome($empresa)){
                    $this->empresa = $empresa;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_cnpj($cnpj){
		if($cnpj != '' && valida::cnpj($cnpj)){
                    $this->cnpj = $cnpj;
                    return 1;
		}else{
                    return 0;
                }
        }
        
        public function set_logo($logo){
                $this->logo = $logo;
                return 1;
        }

	public function set_telefone($telefone){
		if($telefone != '' && valida::telefone($telefone)){
                    $this->telefone = $telefone;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_email($email){
		if(valida::email($email)){
                    $this->email = $email;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_endereco($endereco){
                $endereco = addslashes($endereco);
                $this->endereco = $endereco;
                return 1;
        }

	public function set_bairro($bairro){
		if(valida::nome_num($bairro)){
                    $this->bairro = $bairro;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_cidade($cidade){
		if(valida::nome($cidade)){
                    $this->cidade = $cidade;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_estado($estado){
		if(valida::nome_num($estado)){
                    $this->estado = $estado;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_cep($cep){
		if(valida::cep($cep)){
                    $this->cep = $cep;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_dt_cadastro($dt_cadastro){
            $this->dt_cadastro = $dt_cadastro;
            return 1;
            /*
                $dia = substr($dt_cadastro, 0, 2);
                $mes = substr($dt_cadastro, 3, 2);
                $ano = substr($dt_cadastro, 6, 4);
                
                if(!valida::numero($dia)){return 0;}
                if(!valida::numero($mes)){return 0;}
                if(!valida::numero($ano)){return 0;}
                
		if(valida::data($dia, $mes, $ano)){
                    $this->dt_cadastro = $ano."-".$mes."-".$dia;
                    return 1;
		}else{
                    return 0;
                }
             */
        }

	
	
	public function salvar(){
                $sql_sel = "SELECT count(*) FROM empresa WHERE id = '".$this->id."'";
		$sql_ins = "insert into empresa(id, empresa, cnpj, logo, telefone, email, endereco, bairro, cidade, estado, cep, dt_cadastro) values('".$this->id."', '".$this->empresa."', '".$this->cnpj."', '".$this->logo."', '".$this->telefone."', '".$this->email."', '".$this->endereco."', '".$this->bairro."', '".$this->cidade."', '".$this->estado."', '".$this->cep."', '".$this->dt_cadastro."')";
                $sql_upd = "update empresa set id = '".$this->id."', empresa = '".$this->empresa."', cnpj = '".$this->cnpj."', logo = '".$this->logo."', telefone = '".$this->telefone."', email = '".$this->email."', endereco = '".$this->endereco."', bairro = '".$this->bairro."', cidade = '".$this->cidade."', estado = '".$this->estado."', cep = '".$this->cep."', dt_cadastro = '".$this->dt_cadastro."' where id = '$this->id'";
                
		$db = new db(config::$driver_login);
 		$con = $db->conecta();
		$res = $db->query($sql_sel, $con);
                $ids = $db->fetch_array($res);
                
                if($ids[0] > 0){
                    $result = $db->query($sql_upd, $con);
                }else{
                    $result = $db->query($sql_ins, $con);
                }
		$db->close($con);

		return $result;
	}
	public function carregar($id){
		$sql = "select * from empresa where id = '$id'";

		$db = new db(config::$driver_login);
 		$con = $db->conecta();
		$res = $db->query($sql, $con);
		$db->close($con);

		$empresa = $db->fetch_array($res);

		$this->id = $empresa["id"];
		$this->empresa = $empresa["empresa"];
		$this->cnpj = $empresa["cnpj"];
                $this->logo = $empresa["logo"];
		$this->telefone = $empresa["telefone"];
		$this->email = $empresa["email"];
		$this->endereco = $empresa["endereco"];
		$this->bairro = $empresa["bairro"];
		$this->cidade = $empresa["cidade"];
		$this->estado = $empresa["estado"];
		$this->cep = $empresa["cep"];
		$this->dt_cadastro = $empresa["dt_cadastro"];
		
		return 1;
	}
}
?>
