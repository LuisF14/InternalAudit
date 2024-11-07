<?php
class Negocio{
    private $cn=null;
    function __construct() {
        if($this->cn==null){
            $this->cn=  mysqli_connect("localhost", "root", "", "auditoria");
        }
        return $this->cn;
    }

    function verNombreAuditorias($codaud){
        $sql = "SELECT nombre FROM auditorias
              WHERE `id_auditoria`=$codaud";
        $res = mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        $row = mysqli_fetch_assoc($res);
        return $row ? $row['nombre'] : 0;
    }

    function verAuditorias($anio){      
        $sql = "SELECT id_auditoria, nombre, anio FROM auditorias
              WHERE `estado`=1 AND `anio`=".$anio;
        $res=  mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        $vec=array();
        while($f=  mysqli_fetch_array($res)){
            $vec[]=$f;
        }
        return $vec;
    }

    /* REGISTRO */     
    function registroAudit($area,$nom,$ape){
        $sql="insert into personal (id_area,nombres,apellidos) 
        values('$area','$nom','$ape')";
        $res=mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
           if($res){
           $last_id = mysqli_insert_id($this->cn);
           return $last_id;
           }else{
           return "Error";
           }
    }

    function registroUsu($last_id,$correo,$contrasena){
        $sql="insert into usuarios (id_personal,correo,contrasena) 
        values('$last_id','$correo','$contrasena')";
        $res=mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
           if($res)
           return "ok";
           else
           return "Error";
    }

    /* LOGIN Auditor y TI*/ 
    function loginAuditor($ema, $pas) {
        // Consulta para obtener el usuario basado en el correo electrónico
        $sql = "SELECT id_usuario, contrasena FROM usuarios WHERE correo='$ema'";
        $res = mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        
        if (mysqli_num_rows($res) > 0) {
            $f = mysqli_fetch_assoc($res);
            
            // Verificar si la contraseña proporcionada coincide con la hasheada
            if (password_verify($pas, $f['contrasena'])) {
                // Contraseña correcta, devolver el ID del usuario y otros detalles necesarios
                $resultado = array(
                    $f['id_usuario']
                    // Agrega otros campos si es necesario
                );
            } else {
                // Contraseña incorrecta
                $resultado = "error";
            }
        } else {
            // Usuario no encontrado
            $resultado = "error";
        }

        return $resultado;
    }
    
    //MENU PRINCIPAL AUDITOR
    /*function ContarDias() {      
        $sql = "SELECT (fecha_cierre - fecha_apertura) AS TOTAL FROM `auditorias` WHERE estado = 0";
        $res = mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        
        // Extraer el valor directamente
        $row = mysqli_fetch_assoc($res);
        
        // Retornar el conteo
        return $row['TOTAL'];
    }*/

    function ContarDias() {
        $sql = "SELECT DATEDIFF(fecha_vcto, fecha_inicio) AS TOTAL FROM auditorias WHERE estado = 0 AND fecha_vcto IS NOT NULL";
        $res = mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        $row = mysqli_fetch_assoc($res);
        return $row ? $row['TOTAL'] : 0;
    }
    
    function devolverFechaAuditVig(){
        $sql = "SELECT fecha_inicio AS fechaini FROM auditorias WHERE estado = 0 ";
        $res = mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        $row = mysqli_fetch_assoc($res);
        return $row ? $row['fechaini'] : 0;
    }

    function ContarAud() {      
        $sql = "SELECT COUNT(*) AS TOTAL FROM `auditorias` WHERE estado = 0";
        $res = mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        
        // Extraer el valor directamente
        $row = mysqli_fetch_assoc($res);
        
        // Retornar el conteo
        return $row['TOTAL'];
    }

    // Para no mostrar el boton en los items del plan
    function ContarAudClosed($idplan) {      
        $sql = "SELECT COUNT(*) AS TOTAL FROM auditorias a 
                LEFT JOIN plan b ON a.id_auditoria = b.id_auditoria 
                WHERE id_plan=$idplan AND estado = 0";
        $res = mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        
        // Extraer el valor directamente
        $row = mysqli_fetch_assoc($res);
        
        // Retornar el conteo
        return $row['TOTAL'];
    }

    // Para no mostrar el boton en conclusiones y recomendaciones
    function ContarAudClosedbyAud($idaud) {      
        $sql = "SELECT COUNT(*) AS TOTAL FROM auditorias 
                WHERE id_auditoria=$idaud AND estado = 0";
        $res = mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        
        // Extraer el valor directamente
        $row = mysqli_fetch_assoc($res);
        
        // Retornar el conteo
        return $row['TOTAL'];
    }
    
    //Obtener id de auditoria
    function ConsultarAuditoriaCod(){      
        $sql="SELECT `id_auditoria` AS id FROM `auditorias` WHERE estado=0 AND anio=YEAR(CURDATE())";
        $res=  mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        // Extraer el valor directamente
        $row = mysqli_fetch_assoc($res);
        
        // Retornar el conteo
        return $row ? $row['id'] :0;
    }
    
    function UpdateAudi($codaud) {      
        $sql= "UPDATE auditorias SET estado = 1 WHERE id_auditoria =".$codaud;
        $res = mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
    
        // Verificar si la consulta fue exitosa
        if ($res) {
            return "Actualización exitosa";
        } else {
            return "Error en la actualización";
        }
    }
        
    //Obtener id de plan
    function ConsultarPlanCod($codaud){      
        $sql="SELECT `id_plan` AS id FROM `plan` WHERE id_auditoria=".$codaud;
        $res=  mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        // Extraer el valor directamente
        $row = mysqli_fetch_assoc($res);
        
        // Retornar el conteo
        return $row ? $row['id'] :0;
    }
    
    //------------APARTADO DE OBJETIVOS------------//
    
    //Mostrar tabla de objetivos
    function Mostrarobjetivos($idplan){      
        $sql="SELECT id_objetivo,nombre,descripcion from objetivo
        WHERE id_plan=".$idplan;
        $res=  mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        $vec=array();
        while($f=  mysqli_fetch_array($res)){
            $vec[]=$f;
        }
        return $vec;
    }

    //Modificar
    function UpdateObjetivo($upObj){      
        $sql="SELECT id_objetivo, nombre, descripcion
        FROM objetivo WHERE id_objetivo=".$upObj;
        $res=  mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        $vec=array();
        while($f=  mysqli_fetch_array($res)){
            $vec[]=$f;
        }
        return $vec;
    }


    //------------APARTADO DE ELEMENTOS------------//
    
    //Mostrar tabla de elementos
    function MostrarElementos($idplan){      
        $sql="SELECT id_elemento,nombre,descripcion,cantidad,fecha_revision,estado,observacion from elementos
        WHERE id_plan=".$idplan;
        $res=  mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        $vec=array();
        while($f=  mysqli_fetch_array($res)){
            $vec[]=$f;
        }
        return $vec;
    }

    //Modificar
    function UpdateElemento($upEle){      
        $sql="SELECT id_elemento, nombre, descripcion, cantidad,fecha_revision,estado,observacion
        FROM elementos WHERE id_elemento=".$upEle;
        $res=  mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        $vec=array();
        while($f=  mysqli_fetch_array($res)){
            $vec[]=$f;
        }
        return $vec;
    }
  
    function ListarEstado($idele){      
        $sql="SELECT estado from elementos where id_elemento=".$idele;
        $res=  mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        $vec=array();
        while($f=  mysqli_fetch_array($res)){
            $vec[]=$f;
        }
        return $vec;
    }


    //------------APARTADO DE GUIA DE EVALUACION------------//
    /* MOSTRAR GUIA DE EVALUACIÓN*/ 
    function Mostrarguia($idplan){      
        $sql="SELECT id_guia_evaluacion,actividad,procedimiento,herramienta,observacion FROM guia_evaluacion
        WHERE id_plan=".$idplan;
        $res=  mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        $vec=array();
        while($f=  mysqli_fetch_array($res)){
            $vec[]=$f;
        }
        return $vec;
    }
    //Modificar
    function UpdateGuia($upgi){      
        $sql="SELECT id_guia_evaluacion, actividad, procedimiento, herramienta, observacion,id_plan FROM guia_evaluacion 
        WHERE id_guia_evaluacion=".$upgi;
        $res=  mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        $vec=array();
        while($f=  mysqli_fetch_array($res)){
            $vec[]=$f;
        }
        return $vec;
    }

    //APARTADO DE CONCLUSIONES

    //NUEVO 
    
    /* MOSTRAR CONCLUSIONES*/ 
    function MostrarCon($idaud){      
        $sql="SELECT id_conclusion, descripcion
        FROM conclusiones WHERE id_auditoria=".$idaud;
        $res=  mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        $vec=array();
        while($f=  mysqli_fetch_array($res)){
            $vec[]=$f;
        }
        return $vec;
    }

    //Modificar
    function UpdateConclusion($upcon){      
        $sql="SELECT id_conclusion, descripcion 
        FROM conclusiones WHERE id_conclusion=".$upcon;
        $res=  mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        $vec=array();
        while($f=  mysqli_fetch_array($res)){
            $vec[]=$f;
        }
        return $vec;
    }

    //APARTADO DE RECOMENDACIONES
    //NUEVO 
    /* MOSTRAR RECOMENDACIONES*/ 
    function MostrarRec($idaud){      
        $sql="SELECT id_recomendacion,descripcion 
        FROM recomendaciones WHERE id_auditoria=".$idaud;
        $res=  mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        $vec=array();
        while($f=  mysqli_fetch_array($res)){
            $vec[]=$f;
        }
        return $vec;
    }

    //Modificar
    function UpdateRecomendacion($uprec){      
        $sql="SELECT id_recomendacion,descripcion 
        FROM recomendaciones WHERE id_recomendacion=".$uprec;
        $res=  mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        $vec=array();
        while($f=  mysqli_fetch_array($res)){
            $vec[]=$f;
        }
        return $vec;
    }

    /*--------EQUIPO AUDITORIA------------*/
    //MOSTRAR EQUIPO AUDITORA
    function MostrarequipoAuditoria(){      
        $sql="SELECT id_personal,nombres,apellidos FROM personal
        WHERE id_area=1";
        $res=  mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        $vec=array();
        while($f=  mysqli_fetch_array($res)){
            $vec[]=$f;
        }
        return $vec;
    }

    /*--------ALCANCES------------*/
    function MostrarAlcances($idplan){      
        $sql="SELECT * FROM alcances WHERE id_plan = $idplan";
        $res=  mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        $vec=array();
        while($f=  mysqli_fetch_array($res)){
            $vec[]=$f;
        }
        return $vec;
    }

    //Modificar
    function UpdateAlcance($upAlc){      
        $sql="SELECT id_alcance, tipo, descripcion
        FROM alcances 
        WHERE id_alcance= '".$upAlc."'";
        $res=  mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        $vec=array();
        while($f=  mysqli_fetch_array($res)){
            $vec[]=$f;
        }
        return $vec;
    }

    function ContarAlcance($tipo) {      
        $sql = "SELECT COUNT(*) AS total FROM alcances WHERE tipo =".$tipo;
        $res = mysqli_query($this->cn, $sql) or die(mysqli_error($this->cn));
        
        // Extraer el valor directamente
        $row = mysqli_fetch_assoc($res);
        
        // Retornar el conteo
        return $row['total'];
    }

    /*---------------CRONOGRAMA----------------*/
    function Mostrarcronograma($idplan){      
        $sql="SELECT id_cronograma,tipo,fecha_inicio,fecha_fin from cronograma
        WHERE id_plan=".$idplan;
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



