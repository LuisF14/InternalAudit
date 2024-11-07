$(document).ready(function () {

  // REGISTRO AUDITOR
  $('#enviarRegistro').on('submit', function (e) {
    e.preventDefault();
    var datos = $(this).serializeArray();
    $.ajax({
      type: $(this).attr('method'),
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      success: function (data) {
        var resultado = data;
        if (resultado.respuesta == 'Correoexiste') {
          swal(
            'Correo existente',
            'Pruebe otro',
            'error'
          )

        } else if (resultado.respuesta == 'exitoso') {
          swal(
            'Registro exitoso',
            '',
            'success'
          ); setTimeout(function () {
            window.location.href = 'login.php';
          }, 2000)
        }

      }
    })
  });

  // LOGIN AUDITOR
  $('#envialoaud').on('submit', function (e) {
    e.preventDefault();
    var datos = $(this).serializeArray();
    $.ajax({
      type: $(this).attr('method'),
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      success: function (data) {
        var resultado = data;
        if (resultado.respuesta == 'exitoso') {
          swal(
            'Ingreso exitoso',
            'Bienvenid@: ',
            'success'
          )
          setTimeout(function () {
            window.location.href = '../auditor/menu_principal.php';
          }, 2000)
        } else {
          swal(
            'Error de ingreso',
            'Correo o contraseña inválida',
            'error'
          )
        }
      }
    })
  });

  //////------------ REGISTRO TI ----------- ///////
  $('#enviarRegistroTI').on('submit', function (e) {
    e.preventDefault();
    var datos = $(this).serializeArray();
    $.ajax({
      type: $(this).attr('method'),
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      success: function (data) {
        var resultado = data;
        if (resultado.respuesta == 'Correoexiste') {
          swal(
            'Correo existente',
            'Pruebe otro',
            'error'
          )

        } else if (resultado.respuesta == 'exitoso') {
          swal(
            'Registro exitoso',
            '',
            'success'
          ); setTimeout(function () {
            window.location.href = 'loginTI.php';
          }, 2000)
        }

      }
    })
  });

  ///////------------ LOGIN TI ----------- ///////
  $('#envialoaudTI').on('submit', function (e) {
    e.preventDefault();
    var datos = $(this).serializeArray();
    $.ajax({
      type: $(this).attr('method'),
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      success: function (data) {
        var resultado = data;
        if (resultado.respuesta == 'exitoso') {
          swal(
            'Ingreso exitoso',
            'Bienvenid@: ',
            'success'
          )
          setTimeout(function () {
            window.location.href = '../auditor/menu_principalTI.php';
          }, 2000)
        } else {
          swal(
            'Error de ingreso',
            'Correo o contraseña inválida',
            'error'
          )
        }
      }
    })
  });

  // LOGIN EMPRESA
  /*
  $('#envialobu').on('submit', function (e) {
    e.preventDefault();
    var datos = $(this).serializeArray();
    $.ajax({
      type: $(this).attr('method'),
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      success: function (data) {
        var resultado = data;
        if (resultado.respuesta == 'exitoso') {
          swal(
            'Ingreso exitoso',
            'Bienvenido: ' + resultado.usuario,
            'success'
          )
          setTimeout(function () {
            window.location.href = '../Empresa/MenuPrincipal.php';
          }, 2000)
        } else {
          swal(
            'Error de ingreso',
            'Correo o contraseña inválida',
            'error'
          )
        }
      }
    })
  });*/

  //MENU PRINCIPAL AUDITOR

  //Modal Agregar
  $('.btnAgregar').click(function () {
    $.ajax({
      url: 'get_dataAdd.php',
      type: 'post',
      success: function (response) {
        $('.modal-body').html(response);
        $('#custModalEmpresaAgregar').modal('show');
      }
    })
  });

  // AGREGAR
  $('#addempresa').on('submit', function (e) {
    e.preventDefault();
    var datos = $(this).serializeArray();
    $.ajax({
      type: $(this).attr('method'),
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      success: function (data) {
        var resultado = data;
        if (resultado.respuesta == 'exitoso') {
          swal(
            'Correcto',
            'Empresa añadida',
            'success'
          )
          setTimeout(function () {
            location.reload();
          }, 2000)
        } else {
          swal(
            'Error',
            'Datos incompletos',
            'error'
          )
        }
      }
    })
  });

  //Modal Editar
  $('.btnEditar').click(function () {
    var edit = $(this).data('id');
    $.ajax({
      url: 'get_dataedit.php',
      type: 'post',
      data: { edit: edit },
      success: function (response) {
        $('.modal-body1').html(response);
        $('#custModalEmpresaEditar').modal('show');
      }
    })
  });

  // MODIFICAR
  $('#updateempresa').on('submit', function (e) {
    e.preventDefault();
    var datos = $(this).serializeArray();
    $.ajax({
      type: $(this).attr('method'),
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      success: function (data) {
        var resultado = data;
        if (resultado.respuesta == "datos incorrectos") {
          swal(
            'Incorrecto',
            'Empresa no modificada',
            'error'
          )
        }
        else if (resultado.respuesta == "exito") {
          swal(
            'Correcto',
            'Empresa modificada',
            'success'
          )
          setTimeout(function () {
            location.reload();
          }, 2000)
        }
      }
    })
  });

  //Borrar registro
  $('.btnBorrar').on('click', function (e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    var tipo = $(this).attr('data-tipo');
    swal({
      title: '¿Estás seguro?',
      text: "Una empresa se eliminará",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: 'post',
          data: {
            'id': id,
            'registroLista': 'eliminar'
          },
          url: '../controlador/OperacionLista' + tipo + '.php',
          success: function (data) {
            var resultado = JSON.parse(data);
            if (resultado.respuesta == 'exitoso') {
              swal(
                'Eliminado',
                'Empresa eliminada',
                'success'
              )
              jQuery('[data-id="' + resultado.id_borrar + '"]').parents('tr').remove();
              setTimeout(function () {
                location.reload();
              }, 2000)
            } else if (resultado.respuesta == 'eliminacion incorrecta') {
              swal(
                'Error',
                'No se pudo eliminar porque la empresa tiene datos registrados',
                'error'
              )
            }
          }
        });
      } else {
        swal(
          'Acción cancelada',
          '',
          'warning'
        )
      }
    })
  });

  //------APARTADO DE GUIA DE EVALUACIÓN--------//

  //Modal Agregar
  $('.btnAgregarGuia').click(function () {
    var add = $(this).data('id');
    // var add=this.id;
    console.log(add);
    $.ajax({
      url: 'get_GuiadataAdd.php?add=' + add,
      type: 'post',
      data: { add: add },
      success: function (response) {
        $('.modal-body').html(response);
        $('#custModalGuiaAgregar').modal('show');
      }
    })
  });

  // AGREGAR
  $('#addGuia').on('submit', function (e) {
    e.preventDefault();
    var datos = $(this).serializeArray();
    $.ajax({
      type: $(this).attr('method'),
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      success: function (data) {
        var resultado = data;
        if (resultado.respuesta == "exitoso") {
          console.log(data);
          console.log("paso exitoso");
          swal(
            'Correcto',
            'Item añadido',
            'success'
          )
          setTimeout(function () {
            location.reload();
          }, 2000)
        } else {
          console.log("no paso exitoso");
          swal(
            'Error',
            'Datos incompletos',
            'error'
          )
        }
      }
    })
  });

  //Modal Editar
  $('.btnGuiaEditar').click(function () {
    var editGuia = $(this).data('id');
    $.ajax({
      url: 'get_GuiadataEdit.php',
      type: 'post',
      data: { editGuia: editGuia },
      success: function (response) {
        $('.modal-body1').html(response);
        $('#custModalGuiaEditar').modal('show');
      }
    })
  });

  // MODIFICAR
  $('#updateGuia').on('submit', function (e) {
    e.preventDefault();
    var datos = $(this).serializeArray();
    $.ajax({
      type: $(this).attr('method'),
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      success: function (data) {
        var resultado = data;
        if (resultado.respuesta == "datos incorrectos") {

          swal(
            'Incorrecto',
            'Item no modificado',
            'error'
          )
        }
        else {
          console.log(data);
          console.log("paso exitoso");
          swal(
            'Correcto',
            'Item modificado',
            'success'
          )
          setTimeout(function () {
            location.reload();
          }, 2000)
        }
      }
    })
  });

  //Borrar registro
  $('.btnBorrarGuia').on('click', function (e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    var tipo = $(this).attr('data-tipo');
    swal({
      title: '¿Estás seguro?',
      text: "Una Item se eliminará",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: 'post',
          data: {
            'id': id,
            'registroGuia': 'eliminar'
          },
          url: '../controller/OperacionGuia' + tipo + '.php',
          success: function (data) {
            var resultado = JSON.parse(data);
            if (resultado.respuesta == 'exitoso') {
              swal(
                'Eliminado',
                'Item eliminado',
                'success'
              )
              jQuery('[data-id="' + resultado.id_borrar + '"]').parents('tr').remove();
              setTimeout(function () {
                location.reload();
              }, 2000)
            }
          }
        });
      } else {
        swal(
          'Acción cancelada',
          '',
          'warning'
        )
      }
    })
  });

  // Modal de borrar
  $('#deletereferencia').on('submit', function (e) {
    e.preventDefault();
    var datos = $(this).serializeArray();
    $.ajax({
      type: $(this).attr('method'),
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      success: function (data) {
        var resultado = data;
        if (resultado.respuesta == 'exitoso') {
          swal(
            'Correcto',
            'Item eliminado',
            'success'
          )
          setTimeout(function () {
            location.reload();
          }, 2000)
        } else {
          swal(
            'Error',
            'No se pudo eliminar',
            'error'
          )
        }
      }
    })
  });

  //------APARTADO DE INGRESO DE OBJETIVOS--------//
  //Modal Agregar
  $('.btnAgregarObjetivo').click(function () {
    var add = $(this).data('id');
    $.ajax({
      url: 'get_ObjetivodataAdd.php?add=' + add,
      type: 'post',
      data: { add: add },
      success: function (response) {
        $('.modal-body').html(response);
        $('#custModalObjetivoAgregar').modal('show');
      }
    })
  });

  // AGREGAR
  $('#addobjetivo').on('submit', function (e) {
    e.preventDefault();
    var datos = $(this).serializeArray();
    $.ajax({
      type: $(this).attr('method'),
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      success: function (data) {
        var resultado = data;
        if (resultado.respuesta == 'exitoso') {
          swal(
            'Correcto',
            'Objetivo añadido',
            'success'
          )
          setTimeout(function () {
            location.reload();
          }, 2000)
        } else {
          swal(
            'Error',
            'Datos incompletos',
            'error'
          )
        }

      }
    })
  });

  //Modal Editar
  $('.btnEditarObjetivo').click(function () {
    var editObjetivo = $(this).data('id');
    $.ajax({
      url: 'get_ObjetivodataEdit.php',
      type: 'post',
      data: { editObjetivo: editObjetivo },
      success: function (response) {
        $('.modal-body1').html(response);
        $('#custModalObjetivoEditar').modal('show');
      }
    })
  });

  // MODIFICAR
  $('#updateObjetivo').on('submit', function (e) {
    e.preventDefault();
    var datos = $(this).serializeArray();
    $.ajax({
      type: $(this).attr('method'),
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      success: function (data) {
        var resultado = data;
        if (resultado.respuesta == 'exito') {
          swal(
            'Correcto',
            'Objetivo editado',
            'success'
          )
          setTimeout(function () {
            location.reload();
          }, 2000)
        } else {
          swal(
            'Error',
            'Datos incompletos',
            'error'
          )
        }
      }
    })
  });

  //Borrar registro
  $('.btnBorrarObjetivo').on('click', function (e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    var tipo = $(this).attr('data-tipo');
    swal({
      title: '¿Estás seguro?',
      text: "Un objetivo se eliminará",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: 'post',
          data: {
            'id': id,
            'registroElemento': 'eliminar'
          },
          url: '../controller/OperacionObjetivo' + tipo + '.php',
          success: function (data) {
            var resultado = JSON.parse(data);
            if (resultado.respuesta == 'exitoso') {
              swal(
                'Eliminado',
                'Objetivo eliminado',
                'success'
              )
              jQuery('[data-id="' + resultado.id_borrar + '"]').parents('tr').remove();
              setTimeout(function () {
                location.reload();
              }, 2000)
            }
          }
        });
      } else {
        swal(
          'Acción cancelada',
          '',
          'warning'
        )
      }
    })
  });

  /*--------------------------------------------*/
  /*------------------ELEMENTOS-----------------*/
  /*--------------------------------------------*/

  //Modal Agregar
  $('.btnAgregarElemento').click(function () {
    var add = $(this).data('id');
    $.ajax({
      url: 'get_ElementodataAdd.php?add=' + add,
      type: 'post',
      data: { add: add },
      success: function (response) {
        $('.modal-body').html(response);
        $('#custModalElementoAgregar').modal('show');
      }
    })
  });

  // AGREGAR
  $('#addelemento').on('submit', function (e) {
    e.preventDefault();

    var datos = $(this).serializeArray();
    $.ajax({
      type: $(this).attr('method'),
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      success: function (data) {
        var resultado = data;
        if (resultado.respuesta == 'exitoso') {
          swal(
            'Correcto',
            'Elemento añadido',
            'success'
          )
          setTimeout(function () {
            location.reload();
          }, 2000)
        } else {
          swal(
            'Error',
            'Datos incompletos',
            'error'
          )
        }

      }
    })
  });

  //Modal Editar
  $('.btnEditarElemento').click(function () {
    var editElemento = $(this).data('id');
    $.ajax({
      url: 'get_ElementodataEdit.php',
      type: 'post',
      data: { editElemento: editElemento },
      success: function (response) {
        $('.modal-body1').html(response);
        $('#custModalElementoEditar').modal('show');
      }
    })
  });

  // MODIFICAR
  $('#updateElemento').on('submit', function (e) {
    e.preventDefault();
    var datos = $(this).serializeArray();
    $.ajax({
      type: $(this).attr('method'),
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      success: function (data) {
        var resultado = data;
        if (resultado.respuesta == 'exito') {
          swal(
            'Correcto',
            'Elemento editado',
            'success'
          )
          setTimeout(function () {
            location.reload();
          }, 2000)
        } else {
          swal(
            'Error',
            'Datos incompletos',
            'error'
          )
        }
      }
    })
  });

  //Borrar registro
  $('.btnBorrarElemento').on('click', function (e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    var tipo = $(this).attr('data-tipo');
    swal({
      title: '¿Estás seguro?',
      text: "Un elemento se eliminará",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: 'post',
          data: {
            'id': id,
            'registroElemento': 'eliminar'
          },
          url: '../controller/OperacionElemento' + tipo + '.php',
          success: function (data) {
            var resultado = JSON.parse(data);
            if (resultado.respuesta == 'exitoso') {
              swal(
                'Eliminado',
                'Elemento eliminado',
                'success'
              )
              jQuery('[data-id="' + resultado.id_borrar + '"]').parents('tr').remove();
              setTimeout(function () {
                location.reload();
              }, 2000)
            }
          }
        });
      } else {
        swal(
          'Acción cancelada',
          '',
          'warning'
        )
      }
    })
  });


  /*--------------------------------------------*/
  /*------------IMPORTAR ELEMENTO---------------*/
  /*--------------------------------------------*/

  $('.btnEnvioFormulario').click(function () {
    var editGuia = $(this).data('id');
    $.ajax({
      url: 'get_RespuestadataAdd.php',
      type: 'post',
      data: { editGuia: editGuia },
      success: function (response) {
        $('.modal-body').html(response);
        $('#custModalEnvioFormulario').modal('show');
      }
    })
  });

  /*--------------------------------------------*/
  /*-----------------CONCLUSIONES---------------*/
  /*--------------------------------------------*/
  //Modal Agregar
  $('.btnAgregarConclusiones').click(function () {
    var add = $(this).data('id');
    $.ajax({
      url: 'get_ConclusiondataAdd.php?add=' + add,
      type: 'post',
      data: { add: add },
      success: function (response) {
        $('.modal-body').html(response);
        $('#custModalConclusionAgregar').modal('show');
      }
    })
  });

  // AGREGAR
  $('#addconclusion').on('submit', function (e) {
    e.preventDefault();
    var datos = $(this).serializeArray();
    $.ajax({
      type: $(this).attr('method'),
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      success: function (data) {
        var resultado = data;
        if (resultado.respuesta == 'exitoso') {
          swal(
            'Correcto',
            'Conclusion añadida',
            'success'
          )
          setTimeout(function () {
            location.reload();
          }, 2000)
        } else {
          swal(
            'Error',
            'Datos incompletos',
            'error'
          )
        }
      }
    })
  });

  //Modal Editar
  $('.btnEditarConclusiones').click(function () {
    var editConclusion = $(this).data('id');
    $.ajax({
      url: 'get_ConclusiondataEdit.php',
      type: 'post',
      data: { editConclusion: editConclusion },
      success: function (response) {
        $('.modal-body1').html(response);
        $('#custModalConclusionEditar').modal('show');
      }
    })
  });

  // MODIFICAR
  $('#updateConclusion').on('submit', function (e) {
    e.preventDefault();
    var datos = $(this).serializeArray();
    $.ajax({
      type: $(this).attr('method'),
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      success: function (data) {
        var resultado = data;
        if (resultado.respuesta == "datos incorrectos") {
          swal(
            'Incorrecto',
            'Conclusión no modificada',
            'error'
          )
        }
        else if (resultado.respuesta == "exito") {
          swal(
            'Correcto',
            'Conclusión modificada',
            'success'
          )
          setTimeout(function () {
            location.reload();
          }, 2000)
        }
      }
    })
  });

  //Borrar registro
  $('.btnBorrarConclusiones').on('click', function (e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    var tipo = $(this).attr('data-tipo');
    swal({
      title: '¿Estás seguro?',
      text: "Un conclusión se eliminará",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: 'post',
          data: {
            'id': id,
            'registroConclusion': 'eliminar'
          },
          url: '../controller/OperacionConclusion' + tipo + '.php',
          success: function (data) {
            var resultado = JSON.parse(data);
            if (resultado.respuesta == 'exitoso') {
              swal(
                'Eliminado',
                'Conclusión eliminada',
                'success'
              )
              jQuery('[data-id="' + resultado.id_borrar + '"]').parents('tr').remove();
              setTimeout(function () {
                location.reload();
              }, 2000)
            }
          }
        });
      } else {
        swal(
          'Acción cancelada',
          '',
          'warning'
        )
      }
    })
  });

  /*--------------------------------------------*/
  /*----------------RECOMENDACIONES-------------*/
  /*--------------------------------------------*/

  //Modal Agregar
  $('.btnAgregarRecomendaciones').click(function () {
    var add = $(this).data('id');
    $.ajax({
      url: 'get_RecomendaciondataAdd.php?add=' + add,
      type: 'post',
      data: { add: add },
      success: function (response) {
        $('.modal-body2').html(response);
        $('#custModalRecomendacionAgregar').modal('show');
      }
    })
  });

  // AGREGAR
  $('#addrecomendacion').on('submit', function (e) {
    e.preventDefault();
    var datos = $(this).serializeArray();
    $.ajax({
      type: $(this).attr('method'),
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      success: function (data) {
        var resultado = data;
        if (resultado.respuesta == 'exitoso') {
          swal(
            'Correcto',
            'Recomendación añadida',
            'success'
          )
          setTimeout(function () {
            location.reload();
          }, 2000)
        } else {
          swal(
            'Error',
            'Datos incompletos',
            'error'
          )
        }
      }
    })
  });

  //Modal Editar
  $('.btnEditarRecomendaciones').click(function () {
    var editRecomendacion = $(this).data('id');
    $.ajax({
      url: 'get_RecomendaciondataEdit.php',
      type: 'post',
      data: { editRecomendacion: editRecomendacion },
      success: function (response) {
        $('.modal-body3').html(response);
        $('#custModalRecomendacionEditar').modal('show');
      }
    })
  });

  // MODIFICAR
  $('#updateRecomendacion').on('submit', function (e) {
    e.preventDefault();
    var datos = $(this).serializeArray();
    $.ajax({
      type: $(this).attr('method'),
      data: datos,
      url: $(this).attr('action'),
      dataType: 'json',
      success: function (data) {
        console.log(data);
        var resultado = data;
        if (resultado.respuesta == "datos incorrectos") {
          swal(
            'Incorrecto',
            'Recomendación no modificada',
            'error'
          )
        }
        else if (resultado.respuesta == "exito") {
          swal(
            'Correcto',
            'Recomendación modificada',
            'success'
          )
          setTimeout(function () {
            location.reload();
          }, 2000)
        }
      }
    })
  });

  //Borrar registro
  $('.btnBorrarRecomendaciones').on('click', function (e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    var tipo = $(this).attr('data-tipo');
    swal({
      title: '¿Estás seguro?',
      text: "Una recomendación se eliminará",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: 'post',
          data: {
            'id': id,
            'registroRecomendacion': 'eliminar'
          },
          url: '../controller/OperacionRecomendacion' + tipo + '.php',
          success: function (data) {
            var resultado = JSON.parse(data);
            if (resultado.respuesta == 'exitoso') {
              swal(
                'Eliminado',
                'Recomendación eliminada',
                'success'
              )
              jQuery('[data-id="' + resultado.id_borrar + '"]').parents('tr').remove();
              setTimeout(function () {
                location.reload();
              }, 2000)
            }
          }
        });
      } else {
        swal(
          'Acción cancelada',
          '',
          'warning'
        )
      }
    })
  });

/*--------------------------------------------*/
/*-------------------ALCANCE------------------*/
/*--------------------------------------------*/

//Modal Agregar
$('.btnAgregarAlcance').click(function () {
  var add = $(this).data('id');
  var add2 = $(this).data('id2');
  $.ajax({
    url: 'get_AlcancedataAdd.php?add='+add + '&add2=' + add2,
    type: 'post',
    data: { add: add, add2: add2 },
    success: function (response) {
      $('.modal-bodyAdd').html(response);
      $('#custModalAlcanceAgregar').modal('show');
    }
  })
});

// AGREGAR
$('#addAlcance').on('submit', function (e) {
  e.preventDefault();
  var datos = $(this).serializeArray();
  $.ajax({
    type: $(this).attr('method'),
    data: datos,
    url: $(this).attr('action'),
    dataType: 'json',
    success: function (data) {
      var resultado = data;
      if (resultado.respuesta == 'exitoso') {
        swal(
          'Correcto',
          'Descripcion añadida',
          'success'
        )
        setTimeout(function () {
          location.reload();
        }, 2000)
      } else {
        swal(
          'Error',
          'Datos incompletos',
          'error'
        )
      }

    }
  })
});

//Modal Editar
$('.btnEditarAlcance').click(function () {
  var editAlcance = $(this).data('id');
  $.ajax({
    url: 'get_AlcancedataEdit.php',
    type: 'post',
    data: { editAlcance: editAlcance },
    success: function (response) {
      $('.modal-body').html(response);
      $('#custModalAlcanceEditar').modal('show');
    }
  })
});

// MODIFICAR
$('#updateAlcance').on('submit', function (e) {
  e.preventDefault();
  var datos = $(this).serializeArray();
  $.ajax({
    type: $(this).attr('method'),
    data: datos,
    url: $(this).attr('action'),
    dataType: 'json',
    success: function (data) {
      var resultado = data;
      if (resultado.respuesta == 'exito') {
        swal(
          'Correcto',
          'Descripcion editada',
          'success'
        )
        setTimeout(function () {
          location.reload();
        }, 2000)
      } else {
        swal(
          'Error',
          'Datos incompletos',
          'error'
        )
      }
    }
  })
});

//Borrar registro
$('.btnBorrarAlcance').on('click', function (e) {
  e.preventDefault();
  var id = $(this).attr('data-id');
  var tipo = $(this).attr('data-tipo');
  swal({
    title: '¿Estás seguro?',
    text: "Una descripción se eliminará",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, eliminar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        type: 'post',
        data: {
          'id': id,
          'registroAlcance': 'eliminar'
        },
        url: '../controller/OperacionAlcance' + tipo + '.php',
        success: function (data) {
          var resultado = JSON.parse(data);
          if (resultado.respuesta == 'exitoso') {
            swal(
              'Eliminado',
              'Elemento eliminado',
              'success'
            )
            jQuery('[data-id="' + resultado.id_borrar + '"]').parents('tr').remove();
            setTimeout(function () {
              location.reload();
            }, 2000)
          }
        }
      });
    } else {
      swal(
        'Acción cancelada',
        '',
        'warning'
      )
    }
  })
});

/*--------------------------------------------*/
/*-------------CRONOGRAMA---------------------*/
/*--------------------------------------------*/
$('#addcronograma').on('submit', function (e) {
  e.preventDefault();
  var datos = $(this).serializeArray();
  $.ajax({
    type: $(this).attr('method'),
    data: datos,
    url: $(this).attr('action'),
    dataType: 'json',
    success: function (data) {
      var resultado = data;
      if (resultado.respuesta == 'exitoso') {
        console.log(data);
        console.log("paso exitoso");
        swal(
          'Correcto',
          'Cronograma actualizado',
          'success'
        )
        setTimeout(function () {
          location.reload();
        }, 2000)
      } else {
        console.log("error");
        swal(
          'Error',
          'Verificar que fecha inicial sea menor a fecha final',
          'error'
        )
      }
    }
  })
});



});



