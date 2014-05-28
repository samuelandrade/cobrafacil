<?php
class transacao{
	private $id;
        private $id_empresa;
        private $id_boleto;
	private $id_cliente;
        private $nosso_numero;
        private $valor;
	private $dt_vencimento;
	private $multa;
	private $juro;
	private $dt_pagamento;
	private $valor_pago;

	public function __construct(){
		$this->id = NULL;
                $this->id_empresa = NULL;
                $this->id_boleto = NULL;
		$this->id_cliente = NULL;
                $this->nosso_numero = NULL;
		$this->valor = NULL;
		$this->dt_vencimento = NULL;
		$this->multa = NULL;
		$this->juro = NULL;
		$this->dt_pagamento = NULL;
		$this->valor_pago = NULL;
	}

	public function get_id(){
		return $this->id;
	}
        public function get_id_empresa(){
		return $this->id_empresa;
	}
        public function get_id_boleto(){
		return $this->id_boleto;
	}
	public function get_id_cliente(){
		return $this->id_cliente;
	}
	public function get_nosso_numero(){
		return $this->nosso_numero;
	}
        public function get_valor(){
		return $this->valor;
	}
	public function get_dt_vencimento(){
		return $this->dt_vencimento;
	}
        public function get_dt_vencimento_pt(){
		return data_ptbr($this->dt_vencimento);
	}
	public function get_multa(){
		return $this->multa;
	}
	public function get_juro(){
		return $this->juro;
	}
	public function get_dt_pagamento(){
		return $this->dt_pagamento;
	}
        public function get_dt_pagamento_pt(){
                return data_ptbr($this->dt_pagamento);
	}
	public function get_valor_pago(){
		return $this->valor_pago;
	}
	
	
	public function set_id($id){
		if(valida::numero($id)){
                    $this->id = $id;
                    return 1;
		}else{
                    return 0;
                }
        }
        
        public function set_id_empresa($id){
		if(valida::numero($id)){
                    $this->id_empresa = $id;
                    return 1;
		}else{
                    return 0;
                }
        }
        
        public function set_id_boleto($id){
		if(valida::numero($id)){
                    $this->id_boleto = $id;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_id_cliente($id_cliente){
		if(valida::numero($id_cliente)){
                    $this->id_cliente = $id_cliente;
                    return 1;
		}else{
                    return 0;
                }
        }

        public function set_nosso_numero($nosso_numero){
		if(valida::numero($nosso_numero)){
                    $this->nosso_numero = $nosso_numero;
                    return 1;
		}else{
                    return 0;
                }
        }
        
	public function set_valor($valor){
		if(valida::float($valor)){
                    $this->valor = $valor;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_dt_vencimento($dt_vencimento){
		if(valida::data($dt_vencimento)){
                    if(substr($dt_vencimento, 2, 1) == '/' && substr($dt_vencimento, 5, 1) == '/'){
                        $this->dt_vencimento = data_sql($dt_vencimento);
                    }else{
                        $this->dt_vencimento = $dt_vencimento;
                    }
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_multa($multa){
		if(valida::float($multa)){
                    $this->multa = $multa;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_juro($juro){
		if(valida::float($juro)){
                    $this->juro = $juro;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_dt_pagamento($dt_pagamento){
		if(valida::data($dt_pagamento)){
                    if(substr($dt_pagamento, 2, 1) == '/' && substr($dt_pagamento, 5, 1) == '/'){
                        $this->dt_pagamento = data_sql($dt_pagamento);
                    }else{
                        $this->dt_pagamento = $dt_pagamento;
                    }
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_valor_pago($valor_pago){
		if(valida::float($valor_pago)){
                    $this->valor_pago = $valor_pago;
                    return 1;
		}else{
                    return 0;
                }
        }

	
	
	public function salvar(){
		$sql = "replace into transacao(id, id_empresa, id_boleto, id_cliente, nosso_numero, valor, dt_vencimento, multa, juro, dt_pagamento, valor_pago) values('".$this->id."', '".$this->id_empresa."', '".$this->id_boleto."', '".$this->id_cliente."', '".$this->nosso_numero."', '".$this->valor."', '".$this->dt_vencimento."', '".$this->multa."', '".$this->juro."', '".$this->dt_pagamento."', '".$this->valor_pago."')";

		$db = new db(config::$driver);
 		$con = $db->conecta();
		$res = $db->query($sql, $con);
		$db->close($con);

		return $res;
	}
	public function carregar($id){
		$sql = "select * from transacao where id = '$id'";

		$db = new db(config::$driver);
 		$con = $db->conecta();
		$res = $db->query($sql, $con);
		$db->close($con);

		$transacao = $db->fetch_array($res);

		$this->id = $transacao["id"];
                $this->id_empresa = $transacao["id_empresa"];
                $this->id_boleto = $transacao["id_boleto"];
		$this->id_cliente = $transacao["id_cliente"];
		$this->nosso_numero = $transacao["nosso_numero"];
                $this->valor = $transacao["valor"];
		$this->dt_vencimento = $transacao["dt_vencimento"];
		$this->multa = $transacao["multa"];
		$this->juro = $transacao["juro"];
		$this->dt_pagamento = $transacao["dt_pagamento"];
		$this->valor_pago = $transacao["valor_pago"];
		
		return 1;
	}
}