document.querySelectorAll('.actividad').forEach(function(actividad) {
    const fechaInicio = actividad.querySelector('.fecha-inicio');
    const fechaFin = actividad.querySelector('.fecha-fin');

    fechaFin.addEventListener('change', function() {
        if (fechaFin.value < fechaInicio.value) {
            alert("La fecha de finalización no puede ser menor que la fecha de inicio.");
            fechaFin.value = fechaInicio.value;
        }
    });
});
/*-------------CRONOGRAMA----------------*/

document.getElementById('#addcronograma').addEventListener('submit', function(event) {
    //$('#addcronograma').submit(function (e) {
    e.preventDefault(); // Previene el envío estándar del formulario
  
    const formData = new FormData(this);
  
    fetch('../controller/OperacionCronogramaAgregar.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.respuesta === 'exitoso') {
            Swal.fire({
                icon: 'success',
                title: 'Guardado',
                text: 'Se guardaron los datos exitosamente'
            })
            setTimeout(function () {
                location.reload();
              }, 2000)
            .then(() => {
                window.location.href = 'cronograma.php'; // Redirige a la página que desees
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al guardar los datos'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un problema con la conexión al servidor'
        });
    });
  });