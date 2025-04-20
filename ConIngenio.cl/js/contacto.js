document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.contact-form');
    const mensajeEnvio = document.getElementById('mensaje-envio');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Mostrar mensaje de carga
        mensajeEnvio.style.display = 'block';
        mensajeEnvio.textContent = 'Enviando mensaje...';
        mensajeEnvio.className = 'mensaje-envio';

        // Obtener datos del formulario
        const formData = new FormData(form);

        // Enviar datos al servidor
        fetch('mail/enviar.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                mensajeEnvio.className = 'mensaje-envio success';
                form.reset();
            } else {
                mensajeEnvio.className = 'mensaje-envio error';
            }
            mensajeEnvio.textContent = data.message;
        })
        .catch(error => {
            mensajeEnvio.className = 'mensaje-envio error';
            mensajeEnvio.textContent = 'Hubo un error al enviar el mensaje. Por favor, inténtalo de nuevo más tarde.';
        });
    });
}); 