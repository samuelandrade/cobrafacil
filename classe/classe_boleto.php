<?php
class boleto{
	private $id;
        private $id_empresa;
	private $titulo;
	private $banco;
	private $prazo_pagamento;
	private $taxa_boleto;
	private $instrucoes1;
	private $instrucoes2;
	private $instrucoes3;
	private $instrucoes4;
	private $agencia;
	private $conta;
	private $conta_dv;
        private $convenio;
	private $identificacao;
	private $cpf_cnpj;
	private $endereco;
	private $cidade;
	private $uf;
	
	public function __construct(){
		$this->id = NULL;
                $this->id_empresa = NULL;
		$this->titulo = NULL;
		$this->banco = NULL;
		$this->prazo_pagamento = NULL;
		$this->taxa_boleto = NULL;
		$this->instrucoes1 = NULL;
		$this->instrucoes2 = NULL;
		$this->instrucoes3 = NULL;
		$this->instrucoes4 = NULL;
		$this->agencia = NULL;
		$this->conta = NULL;
		$this->conta_dv = NULL;
                $this->convenio = NULL;
                $this->identificacao = NULL;
		$this->cpf_cnpj = NULL;
		$this->endereco = NULL;
		$this->cidade = NULL;
		$this->uf = NULL;
	}

	public function get_id(){
		return $this->id;
	}
        public function get_id_empresa(){
		return $this->id_empresa;
	}
	public function get_titulo(){
		return $this->titulo;
	}
	public function get_banco(){
		return $this->banco;
	}
	public function get_prazo_pagamento(){
            if($this->prazo_pagamento){
		return $this->prazo_pagamento;
            }else{
                return 2;
            }
	}
	public function get_taxa_boleto(){
		return $this->taxa_boleto;
	}
	public function get_instrucoes1(){
            if($this->instrucoes1){
                return $this->instrucoes1;
            }else{
                return 'SR CAIXA. NÃO RECEBER APÓS A DATA DE VENCIMENTO!';
            }
	}
	public function get_instrucoes2(){
            if($this->instrucoes2){
		return $this->instrucoes2;
            }else{
                return 'PAGAVEL PREFERENCIALMENTE NAS AGÊNCIAS DESTE BANCO';
            }
	}
	public function get_instrucoes3(){
		return $this->instrucoes3;
	}
	public function get_instrucoes4(){
		return $this->instrucoes4;
	}
	public function get_agencia(){
		return $this->agencia;
	}
	public function get_conta(){
		return $this->conta;
	}
        public function get_conta_dv(){
		return $this->conta_dv;
	}
	public function get_convenio(){
		return $this->convenio;
	}
	public function get_identificacao(){
		return $this->identificacao;
	}
	public function get_cpf_cnpj(){
		return $this->cpf_cnpj;
	}
	public function get_endereco(){
		return $this->endereco;
	}
	public function get_cidade(){
		return $this->cidade;
	}
	public function get_uf(){
		return $this->uf;
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
        
	public function set_titulo($titulo){
		if($titulo != '' && valida::nome_num($titulo)){
                    $this->titulo = $titulo;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_banco($banco){
		if($banco != '' && valida::numero($banco)){
                    $this->banco = $banco;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_prazo_pagamento($prazo_pagamento){
		if(valida::numero($prazo_pagamento)){
                    $this->prazo_pagamento = $prazo_pagamento;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_taxa_boleto($taxa_boleto){
		if(valida::float($taxa_boleto)){
                    $this->taxa_boleto = $taxa_boleto;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_instrucoes1($instrucoes1){
                $instrucoes1 = addslashes($instrucoes1);
                $this->instrucoes1 = $instrucoes1;
                return 1;
        }

	public function set_instrucoes2($instrucoes2){
                $instrucoes2 = addslashes($instrucoes2);
                $this->instrucoes2 = $instrucoes2;
                return 1;
        }

	public function set_instrucoes3($instrucoes3){
                $instrucoes3 = addslashes($instrucoes3);
                $this->instrucoes3 = $instrucoes3;
                return 1;
        }

	public function set_instrucoes4($instrucoes4){
                $instrucoes4 = addslashes($instrucoes4);
                $this->instrucoes4 = $instrucoes4;
                return 1;
        }

	public function set_agencia($agencia){
                $agencia = addslashes($agencia);
		if($agencia != '' && valida::numero($agencia)){
                    $this->agencia = $agencia;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_conta($conta){
                $conta = addslashes($conta);
		if($conta != '' && valida::numero($conta)){
                    $this->conta = $conta;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_conta_dv($conta_dv){
                $conta_dv = addslashes($conta_dv);
		if($conta_dv != '' && valida::numero($conta_dv)){
                    $this->conta_dv = $conta_dv;
                    return 1;
		}else{
                    return 0;
                }
        }

        public function set_convenio($convenio){
		if(valida::numero($convenio)){
                    $this->convenio = $convenio;
                    return 1;
		}else{
                    return 0;
                }
        }
        
        public function set_identificacao($identificacao){
                $identificacao = addslashes($identificacao);
		if($identificacao != ''){
                    $this->identificacao = $identificacao;
                    return 1;
		}else{
                    return 0;
                }
        }
        
	public function set_cpf_cnpj($cpf_cnpj){
		if($cpf_cnpj != ''){
                    if(valida::cpf($cpf_cnpj) || valida::cnpj($cpf_cnpj)){
                        $this->cpf_cnpj = $cpf_cnpj;
                        return 1;
                    }else{
                        return 0;
                    }
		}else{
                    return 0;
                }
        }

	public function set_endereco($endereco){
                $endereco = addslashes($endereco);
                $this->endereco = $endereco;
                return 1;
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

	public function set_uf($uf){
		if($uf != '' && valida::nome($uf)){
                    $this->uf = $uf;
                    return 1;
		}else{
                    return 0;
                }
        }


	
	
	public function salvar(){
		//$sql = "replace into boleto(id, titulo, banco, prazo_pagamento, taxa_boleto, instrucoes1, instrucoes2, instrucoes3, instrucoes4, agencia, conta, conta_dv, convenio, id_instituicao) values('".$this->id."', '".$this->titulo."', '".$this->banco."', '".$this->prazo_pagamento."', '".$this->taxa_boleto."', '".$this->instrucoes1."', '".$this->instrucoes2."', '".$this->instrucoes3."', '".$this->instrucoes4."', '".$this->agencia."', '".$this->conta."', '".$this->conta_dv."', '".$this->convenio."', '".$this->id_instituicao."')";
                $sql = "replace into boleto(id, id_empresa, titulo, banco, prazo_pagamento, taxa_boleto, instrucoes1, instrucoes2, instrucoes3, instrucoes4, agencia, conta, conta_dv, convenio, identificacao, cpf_cnpj, endereco, cidade, uf) values('".$this->id."', '".$this->id_empresa."', '".$this->titulo."', '".$this->banco."', '".$this->prazo_pagamento."', '".$this->taxa_boleto."', '".$this->instrucoes1."', '".$this->instrucoes2."', '".$this->instrucoes3."', '".$this->instrucoes4."', '".$this->agencia."', '".$this->conta."', '".$this->conta_dv."', '".$this->convenio."', '".$this->identificacao."', '".$this->cpf_cnpj."', '".$this->endereco."', '".$this->cidade."', '".$this->uf."')";

		$db = new db(config::$driver);
 		$con = $db->conecta();
		$res = $db->query($sql, $con);
		$db->close($con);

		return $res;
	}
	public function carregar($id){
		$sql = "select * from boleto where id = '$id'";

		$db = new db(config::$driver);
 		$con = $db->conecta();
		$res = $db->query($sql, $con);
		$db->close($con);

		$boleto = $db->fetch_array($res);

		$this->id = $boleto["id"];
		$this->titulo = $boleto["titulo"];
		$this->banco = $boleto["banco"];
		$this->prazo_pagamento = $boleto["prazo_pagamento"];
		$this->taxa_boleto = $boleto["taxa_boleto"];
		$this->instrucoes1 = $boleto["instrucoes1"];
		$this->instrucoes2 = $boleto["instrucoes2"];
		$this->instrucoes3 = $boleto["instrucoes3"];
		$this->instrucoes4 = $boleto["instrucoes4"];
		$this->agencia = $boleto["agencia"];
		$this->conta = $boleto["conta"];
		$this->conta_dv = $boleto["conta_dv"];
                $this->convenio = $boleto["convenio"];
		$this->identificacao = $boleto["identificacao"];
		$this->cpf_cnpj = $boleto["cpf_cnpj"];
		$this->endereco = $boleto["endereco"];
		$this->cidade = $boleto["cidade"];
		$this->uf = $boleto["uf"];
		
		return 1;
	}
}