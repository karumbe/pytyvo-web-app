const validar = {

    existeElemento: function(id) {
        let elemento = document.getElementById(id);

        if (elemento !== null)
            return true;
        else
            return false;
    },
    ocultarElemento: function(id) {
        if (this.existeElemento(id))
            document.getElementById(id).style.display = 'none';
    },
    mostrarElemento: function(id) {
        if (this.existeElemento(id))
            document.getElementById(id).style.display = 'block';
    },
    buscarCliente: function() {
        let buscar, mensaje;

        if (this.existeElemento('buscar') && this.existeElemento('error')) {
            buscar = document.getElementById('buscar').value.trim();

            if (buscar.length < 6)
                mensaje = '6 caracteres m&#237;nimo.'
            else if (buscar.length > 30)
                mensaje = '30 caracteres m&#225;ximo.'
            else
                mensaje = '';

            document.getElementById('error').innerHTML = mensaje;

            if (mensaje.length > 0) {
                this.mostrarElemento('error');
                alert(mensaje);
                return false;
            } else {
                this.ocultarElemento('error');
                return true;
            }   
        }

        return false;
    }

}