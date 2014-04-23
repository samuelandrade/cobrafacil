<?php
class log{
    public function __construct($empresa, $user, $texto){
        $texto = addslashes($texto);
        $sql = "insert into log(data, user, id_empresa, texto) 
            values('".date("Y-m-d H:i:s")."', '$user', '$empresa', '$texto')";
        $db = new db(config::$driver);
        $con = $db->conecta();
        $db->query($sql, $con);
        $db->close($con);
    }
}
?>
