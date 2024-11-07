/*document.addEventListener('DOMContentLoaded', function() {
    const btnAnadir = document.getElementById('btnAnadir');
    const modal = document.getElementById('miModal');
    const span = document.getElementsByClassName("close")[0];

    btnAnadir.addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
        if (checkboxes.length > 0) {
            const tipo = checkboxes[0].dataset.tipo;
            document.getElementById('tipoDetalle').value = tipo;
            modal.style.display = "block";
        } else {
            alert('Por favor, seleccione al menos una opción.');
        }
    });

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    document.getElementById('formDetalle').addEventListener('submit', function(e) {
        e.preventDefault();
        const tipo = document.getElementById('tipoDetalle').value;
        const descripcion = document.getElementById('descripcionDetalle').value;

        // Aquí deberías hacer la petición AJAX para guardar en la base de datos
        console.log('Tipo:', tipo, 'Descripción:', descripcion);

        // Cierra el modal después de enviar
        modal.style.display = "none";
    });
});*/


/*--------------OPCION 2----------------*/
/*document.getElementById('btnAnadir').addEventListener('click', function() {
    // Verificar qué checkbox está seleccionado
    const checkboxes = document.querySelectorAll('.alcance-item input[type="checkbox"]');
    let selectedCheckbox = null;

    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            selectedCheckbox = checkbox;
        }
    });

    // Si se seleccionó un checkbox
    if (selectedCheckbox) {
        const tipo = selectedCheckbox.getAttribute('data-tipo');
        
        // Configurar el valor del campo oculto en el formulario del modal
        document.getElementById('tipoDetalle').value = tipo;

        // Abrir el modal
        const modal = document.getElementById('miModal');
        modal.style.display = "block";
    } else {
        alert('Por favor, seleccione una opción antes de añadir.');
    }
});

// Cerrar el modal cuando el usuario hace clic en la "x"
document.querySelector('.close').addEventListener('click', function() {
    const modal = document.getElementById('miModal');
    modal.style.display = "none";
});

// Cerrar el modal si el usuario hace clic fuera del modal
window.addEventListener('click', function(event) {
    const modal = document.getElementById('miModal');
    if (event.target === modal) {
        modal.style.display = "none";
    }
});*/

/*-----------OPCION 3-------*/
$(document).ready(function(){
    // Al hacer clic en el botón Añadir
    $('#btnAnadir').click(function(){
        var selected = $('input[type="checkbox"]:checked');
        
        if(selected.length > 0){
            var tipo = selected.data('tipo');
            $('#tipoDetalle').val(tipo); // Configurar el valor del tipo en el campo oculto
            $('#miModal').show(); // Mostrar el modal
        } else {
            alert('Por favor selecciona un elemento.');
        }
    });

    // Cerrar el modal al hacer clic en la "x"
    $('.close').click(function(){
        $('#miModal').hide();
    });

    // Cerrar el modal si se hace clic fuera de él
    $(window).click(function(event){
        if(event.target.id === 'miModal'){
            $('#miModal').hide();
        }
    });
});
