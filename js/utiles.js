const utiles = {

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
    establecerEnfoque: function(id) {
        if (this.existeElemento(id)) {
            let elemento = document.getElementById(id);

            elemento.focus();
            elemento.select();
        } else
            console.log("utiles.establecerEnfoque(): El id '" + id + "' no existe.");
    },
    obtenerCadenaConsulta: function(objeto) {
        // https://howchoo.com/g/nwywodhkndm/how-to-turn-an-object-into-query-string-parameters-in-javascript
        return Object.keys(objeto).map(clave => clave + '=' + objeto[clave]).join('&');
    },
    peticion: function(metodo, url, params = null,
            tipoContenido = 'application/x-www-form-urlencoded', 
            tipoRespuesta = 'json') {
        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.responseType = tipoRespuesta;

            xhr.open(metodo, url, true);
            xhr.setRequestHeader('Content-Type', tipoContenido);
            xhr.onload = function() {
                if (xhr.status === 200)
                    resolve(xhr.response);
                else
                    reject('Los datos no se cargaron correctamente; código de error:' + xhr.statusText);
            };
            xhr.onerror = function() {
                reject('Hubo un error de red.');
            };
            xhr.send(params);
        });
    },
    esJSON: function(cadena) {
        cadena = typeof cadena !== 'string' ? JSON.stringify(cadena) : cadena;

        try {
            JSON.parse(cadena);
        } catch (ex) {
            return false;
        }

        if (typeof cadena === 'object' && cadena !== null)
            return true;

        return false;
    }

}