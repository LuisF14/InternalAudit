// Función para manejar el cambio de estado del toggle
function toggleStatus(id, cumplido) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '';

    const inputId = document.createElement('input');
    inputId.type = 'hidden';
    inputId.name = 'toggle';
    inputId.value = id;

    const inputCumplido = document.createElement('input');
    inputCumplido.type = 'hidden';
    inputCumplido.name = 'cumplido';
    inputCumplido.value = cumplido;

    form.appendChild(inputId);
    form.appendChild(inputCumplido);
    document.body.appendChild(form);

    form.submit();
}
