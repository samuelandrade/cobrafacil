<?php
class parcela{
	private $id_cliente;
	private $valor;
	private $multa;
	private $juro;
	private $quantidade;
	private $dt_vencimento;

	public function __construct(){
		$this->id_cliente = NULL;
		$this->valor = NULL;
		$this->multa = NULL;
		$this->juro = NULL;
		$this->quantidade = NULL;
		$this->dt_vencimento = NULL;
	}

	public function get_id_cliente(){
		return $this->id_cliente;
	}
	public function get_valor(){
		return $this->valor;
	}
	public function get_multa(){
		return $this->multa;
	}
	public function get_juro(){
		return $this->juro;
	}
	public function get_quantidade(){
		return $this->quantidade;
	}
	public function get_dt_vencimento(){
                return $this->dt_vencimento;
	}
        public function get_dt_vencimento_pt(){
                if(substr($this->dt_vencimento, 2, 1) == '/' && substr($this->dt_vencimento, 5, 1) == '/'){
                    return $this->dt_vencimento;
                }else{
                    return data_ptbr($this->dt_vencimento);
                }
	}
	
	
	public function set_id_cliente($id_cliente){
		if($id_cliente != '' && valida::numero($id_cliente)){
                    $this->id_cliente = $id_cliente;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_valor($valor){
		if($valor != '' && valida::float($valor)){
                    $this->valor = $valor;
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

	public function set_quantidade($quantidade){
		if($quantidade != '' && valida::numero($quantidade)){
                    $this->quantidade = $quantidade;
                    return 1;
		}else{
                    return 0;
                }
        }

	public function set_dt_vencimento($dt_vencimento){
		if($dt_vencimento != '' && valida::data($dt_vencimento)){
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
        
}