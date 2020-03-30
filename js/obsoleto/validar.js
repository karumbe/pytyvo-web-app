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

        if (this.existeElemento('buscar')) {
            buscar = document.getElementById('buscar').value.trim();

            if (buscar.length < 6)
                mensaje = 'Escribe 6 caracteres como mínimo para realizar la búsqueda.';
            else if (buscar.length > 30)
                mensaje = 'Escribe 30 caracteres como máximo para realizar la búsqueda.';
            else
                mensaje = '';

            if (mensaje.length > 0) {
                alert(mensaje);
                return false;
            } else {
                return true;
            }   
        }

        return false;
    }

}