const servidor = '/pytyvo-com';

$(function() {
    console.log('JQuery funciona');

    $('#txt-buscar-cliente').keyup(function(event) {
        let expresion = $('#txt-buscar-cliente').val();
        
        $.ajax({
            url: servidor + '/app/obtener_cliente.php',
            type: 'POST',
            data: { expresion },
            success: function(respuesta) {
                let clientes = JSON.parse(respuesta)
                let plantilla = '';

                clientes.forEach(cliente => {
                    plantilla += `
                        
                    `
                });
            }
        })
    });
});





function mostrarClientes() {
    var xhr;

    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    } else {
        xhr = new ActiveXObject('Microsoft.XMLHTTP');
    }

    xhr.onreadystatechange = function() {
        if (xhr.readState === XMLHttpRequest.DONE && xhr.status == 200) {
            resultado.innerHTML = xhr.responseText;
        }
    }

    xhr.open('GET', 'obtener_cliente.php', true);
    xhr.send();
}