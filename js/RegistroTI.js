const formulario = document.getElementById('enviarRegistroTI');
const inputs = document.querySelectorAll('#enviarRegistroTI input');

const expresiones = {
    nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    apellido: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	pas: /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{6,20}$/ // 6 digitos
}
const campos = { 
    nombre:false,
    apellido: false,
    correo: false,
    pas: false
  
}

const validarFormulario = (e) => {
    switch(e.target.name){
        
        case "nombres":
            validarCampo(expresiones.nombre,e.target,'nombres');
        break;
        case "apellidos":
            validarCampo(expresiones.apellido,e.target,'apellidos');
        break;
        case "correo":
          validarCampo(expresiones.correo,e.target,'correo');
        break;
        case "contrasena":
          validarCampo(expresiones.pas,e.target,'contrasena');
        break;
        
    }
}

const validarCampo = (expresion,input,campo) => {
    if(expresion.test(input.value)){
        document.getElementById(`grupo-${campo}`).classList.remove('formulario-grupo-incorrecto');
        document.getElementById(`grupo-${campo}`).classList.add('formulario-grupo-correcto');
        document.querySelector(`#grupo-${campo} i`).classList.add('fa-check-circle');
        document.querySelector(`#grupo-${campo} i`).classList.remove('fa-times-circle');
        document.querySelector(`#grupo-${campo} .formulario-input-error`).classList.remove('formulario-input-error-activo')
        campos[campo] = true;
    } else {
        document.getElementById(`grupo-${campo}`).classList.add('formulario-grupo-incorrecto');
        document.getElementById(`grupo-${campo}`).classList.remove('formulario-grupo-correcto');
        document.querySelector(`#grupo-${campo} i`).classList.add('fa-times-circle');
        document.querySelector(`#grupo-${campo} i`).classList.remove('fa-check-circle');
        document.querySelector(`#grupo-${campo} .formulario-input-error`).classList.add('formulario-input-error-activo')
        campos[campo] = false;
    }
}

inputs.forEach((input) =>{
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
});

/*$(document).ready(function(){

    // REGISTRO AUDITOR
    $('#enviareaud').on('submit',function(e){
        e.preventDefault();
        var datos = $(this).serializeArray();
        $.ajax({
            type:$(this).attr('method'),
            data:datos,
            url:$(this).attr('action'),
            dataType:'json',
            success:function(data){
                var resultado=data;
                if(resultado.respuesta =='Correoexiste'){
                  swal(
                    'Correo existente',
                    'Pruebe otro',
                    'error'
                  )
                  
                }else if(resultado.respuesta=='exitoso'){
                  swal(
                    'Registro exitoso',
                    '',
                    'success'
                );setTimeout(function(){
                  window.location.href='login.php';
                  },2000)
                      }
                 
            }
        })
    });

});*/