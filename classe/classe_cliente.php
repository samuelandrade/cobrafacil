<?php
class cliente{
	private $id;
	private $id_empresa;
	private $bloqueado;
	private $nome;
	private $cpf;
	private $rg;
	private $dt_nasc;
	private $sexo;
        private $logadouro;
        private $numero;
        private $complemento;
	private $uf;
	private $cidade;
	private $cep;
	private $telefone;
	private $email;
	private $senha;
	private $contrato;
	private $grupo;
	private $obsercacoes;

	public function __construct(){
		$this->id = NULL;
		$this->id_empresa = NULL;
		$this->bloqueado = 0;
		$this->nome = NULL;
		$this->cpf = NULL;
		$this->rg = NULL;
		$this->dt_nasc = NULL;
		$this->sexo = NULL;
                $this->logadouro = NULL;
                $this->numero = NULL;
                $this->complemento = NULL;
		$this->uf = NULL;
		$this->cidade = NULL;
		$this->cep = NULL;
		$this->telefone = NULL;
		$this->email = NULL;
		$this->senha = NULL;
		$this->contrato = NULL;
		$this->grupo = NULL;
		$this->observacoes = NULL;
	}

	public function get_id(){
		return $this->id;
	}
	public function get_id_empresa(){
		return $this->id_empresa;
	}
	public function get_bloqueado(){
		return $this->bloqueado;
	}
	public function get_nome(){
		return $this->nome;
	}
	public function get_cpf(){
		return $this->cpf;
	}
	public function get_rg(){
		return $this->rg;
	}
	public function get_dt_nasc(){
            if(strlen($this->dt_nasc) > 0){
		return data_ptbr($this->dt_nasc);
            }else{
                return NULL;
            }
	}
	public function get_sexo(){
		return $this->sexo;
	}
        public function get_logadouro(){
		return $this->logadouro;
	}
        public function get_numero(){
		return $this->numero;
	}
        public function get_complemento(){
		return $this->complemento;
	}
	public function get_uf(){
		return $this->uf;
	}
	public function get_cidade(){
		return $this->cidade;
	}
	public function get_cep(){
		return $this->cep;
	}
	public function get_telefone(){
		return $this->telefone;
	}
	public function get_email(){
		return $this->email;
	}
	public function get_senha(){
		return $this->senha;
	}
	public function get_contrato(){
		return $this->contrato;
	}
	public function get_grupo(){
		return $this->grupo;
	}
	public function get_observacoes(){
		return $this->observacoes;
	}
        public function get_endereco(){
            $r = '';
            if($this->logadouro){
                $r = $this->logadouro;
                
                if($this->numero){
                    $r .= ", ".$this->numero;
                }
                
                if($this->complemento){
                    $r .= ", ".$this->complemento;
                }
            }
            
            return $r;
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

	public function set_bloqueado($bloqueado){
		if(valida::numero($bloqueado)){
                    $this->bloqueado = $bloqueado;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_nome($nome){
		if($nome != '' && valida::nome($nome)){
                    $this->nome = $nome;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_cpf($cpf){
		if($cpf != '' && valida::cpf($cpf)){
                    $this->cpf = $cpf;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_rg($rg){
                $rg = addslashes($rg);
		if($rg != ''){
                    $this->rg = $rg;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_dt_nasc($dt_nasc){
		if(valida::data($dt_nasc)){
                    $this->dt_nasc = data_sql($dt_nasc);
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_sexo($sexo){
		if($sexo != '' && valida::numero($sexo)){
                    $this->sexo = $sexo;
                    return 1;
		}else{
                    return 0;
                }
        }
        public function set_logadouro($logadouro){
		$logadouro = addslashes($logadouro);
                $this->logadouro = $logadouro;
                return 1;
        }
        public function set_numero($numero){
		$numero = addslashes($numero);
                $this->numero = $numero;
                return 1;
        }
        public function set_complemento($complemento){
		$complemento = addslashes($complemento);
                $this->complemento = $complemento;
                return 1;
        }
	public function set_uf($uf){
		if($uf != '' && valida::nome($uf)){
                    $this->uf = $uf;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_cidade($cidade){
                $cidade = addslashes($cidade);
		if($cidade != ''){
                    $this->cidade = $cidade;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_cep($cep){
		if($cep == '' || valida::cep($cep)){
                    $this->cep = $cep;
                    return 1;
		}else{
                    return 0;
                }
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
		if($email != '' && valida::email($email)){
                    $this->email = $email;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_senha($senha){
                $senha = addslashes($senha);
		if($senha != ''){
                    $this->senha = $senha;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_contrato($contrato){
		if(valida::numero($contrato)){
                    $this->contrato = $contrato;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_grupo($grupo){
		if(valida::numero($grupo)){
                    $this->grupo = $grupo;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_observacoes($observacoes){
                $observacoes = addslashes($observacoes);
                $this->observacoes = $observacoes;
                return 1;
        }

	
	
	public function salvar(){
		$sql = "replace into cliente(id, id_empresa, bloqueado, nome, cpf, rg, dt_nasc, sexo, logadouro, numero, complemento, uf, cidade, cep, telefone, email, senha, contrato, grupo, observacoes) values('".$this->id."', '".$this->id_empresa."', '".$this->bloqueado."', '".$this->nome."', '".$this->cpf."', '".$this->rg."', '".$this->dt_nasc."', '".$this->sexo."', '".$this->logadouro."', '".$this->numero."', '".$this->complemento."', '".$this->uf."', '".$this->cidade."', '".$this->cep."', '".$this->telefone."', '".$this->email."', '".$this->senha."', '".$this->contrato."', '".$this->grupo."', '".$this->observacoes."')";

		$db = new db(config::$driver);
 		$con = $db->conecta();
		$res = $db->query($sql, $con);
		$db->close($con);

                new log($this->id_empresa, $_SESSION["cf_usuario"], $sql);
                
		return $res;
	}
	public function carregar($id){
		$sql = "select * from cliente where id = '$id'";

		$db = new db(config::$driver);
 		$con = $db->conecta();
		$res = $db->query($sql, $con);
		$db->close($con);

		$cliente = $db->fetch_array($res);

		$this->id = $cliente["id"];
		$this->id_empresa = $cliente["id_empresa"];
		$this->bloqueado = $cliente["bloqueado"];
		$this->nome = $cliente["nome"];
		$this->cpf = $cliente["cpf"];
		$this->rg = $cliente["rg"];
		$this->dt_nasc = $cliente["dt_nasc"];
		$this->sexo = $cliente["sexo"];
                $this->logadouro = $cliente["logadouro"];
                $this->numero = $cliente["numero"];
                $this->complemento = $cliente["complemento"];
		$this->uf = $cliente["uf"];
		$this->cidade = $cliente["cidade"];
		$this->cep = $cliente["cep"];
		$this->telefone = $cliente["telefone"];
		$this->email = $cliente["email"];
		$this->senha = $cliente["senha"];
		$this->contrato = $cliente["contrato"];
		$this->grupo = $cliente["grupo"];
		$this->observacoes = $cliente["observacoes"];
		
		return 1;
	}
}