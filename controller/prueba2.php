<?php
class Negocio{
    private $cn=null;
    function __construct() {
        if($this->cn==null){
            $this->cn=  mysqli_connect("localhost", "root", "", "auditoria");
        }
        return $this->cn;
    }

    

    function ContarAud() {      
        $sql = "SELECT COUNT(*) AS TOTAL FROM `auditorias` WHERE estado = 0";
        $res = mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        
        // Extraer el valor directamente
        $row = mysqli_fetch_assoc($res);
        
        // Retornar el conteo
        return $row['TOTAL'];
    }
    
   
    /*---------------CRONOGRAMA----------------*/
    

    function Mostrarcronograma($idplan){      
        $sql="SELECT id_cronograma,fecha_inicio,fecha_fin from cronograma
        WHERE id_plan=".$idplan." ORDER BY fecha_inicio ASC";
        $res=  mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        $vec=array();
        while($f=  mysqli_fetch_array($res)){
            $vec[]=$f;
        }
        return $vec;
    }

    function ContarCronograma($idCrono) {      
        $sql = "SELECT COUNT(*) AS total FROM cronograma WHERE id_cronograma =".$idCrono;
        $res = mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        
        // Extraer el valor directamente
        $row = mysqli_fetch_assoc($res);
        
        // Retornar el conteo
        return $row['total'];
    }
}
?>