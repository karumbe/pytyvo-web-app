const utiles = {

    _urlBase: 'http://localhost/pytyvo',
    obtenerUrlBase: function() {
        return this._urlBase;
    },
    existeElemento: function(id) {
        if (typeof id !== 'string')
            throw "El par\u00e1metro 'id' del m\u00e9todo 'existeElemento' en el espacio de nombre 'utiles', debe ser de tipo cadena.";

        let elemento = document.getElementById(id);

        if (elemento !== null)
            return true;
        else
            return false;
    },
    ocultarElemento: function(id) {
        if (typeof id !== 'string')
            throw "El par\u00e1metro 'id' del m\u00e9todo 'ocultarElemento' en el espacio de nombre 'utiles', debe ser de tipo cadena.";

        if (this.existeElemento(id))
            document.getElementById(id).style.display = 'none';
    },
    mostrarElemento: function(id) {
        if (typeof id !== 'string')
            throw "El par\u00e1metro 'id' del m\u00e9todo 'mostrarElemento' en el espacio de nombre 'utiles', debe ser de tipo cadena.";

        if (this.existeElemento(id))
            document.getElementById(id).style.display = 'block';
    },
    establecerEnfoque: function(id) {
        if (typeof id !== 'string')
            throw "El par\u00e1metro 'id' del m\u00e9todo 'establecerEnfoque' en el espacio de nombre 'utiles', debe ser de tipo cadena.";

        if (this.existeElemento(id)) {
            let elemento = document.getElementById(id);

            elemento.focus();

            if (elemento.type === 'text')
                elemento.select();
        } else
            console.log("utiles.establecerEnfoque(): El id '" + id + "' no existe.");
    },
    habilitarElemento: function(id) {
        if (typeof id !== 'string')
            throw "El par\u00e1metro 'id' del m\u00e9todo 'habilitarElemento' en el espacio de nombre 'utiles', debe ser de tipo cadena.";

        if (this.existeElemento(id)) {
            let elemento = document.getElementById(id);

            switch (elemento.type) {
                case 'select-one':
                    elemento.disabled = false;
                    break;
                default:
                    console.log("utiles.habilitarElemento(): El tipo de elemento '" + elemento.type + "' no está soportado.");
            }
        } else
            console.log("utiles.habilitarElemento(): El id '" + id + "' no existe.");
    },
    elementoEstaHabilitado: function(id) {
        if (typeof id !== 'string')
            throw "El par\u00e1metro 'id' del m\u00e9todo 'elementoEstaHabilitado' en el espacio de nombre 'utiles', debe ser de tipo cadena.";

        if (this.existeElemento(id)) {
            let elemento = document.getElementById(id);

            switch (elemento.type) {
                case 'select-one':
                    return !elemento.disabled;
                    break;
                default:
                    console.log("utiles.elementoEstaHabilitado(): El tipo de elemento '" + elemento.type + "' no está soportado.");
                    return false;
            }
        } else {
            console.log("utiles.elementoEstaHabilitado(): El id '" + id + "' no existe.");
            return false;
        }
    },
    establecerAtributo: function(id, atributo, valor = '') {
        // inicio { validaciones de parámetros }
        if (typeof id !== 'string')
            throw "El par\u00e1metro 'id' del m\u00e9todo 'establecerAtributo' en el espacio de nombre 'utiles', debe ser de tipo cadena.";

        if (typeof atributo !== 'string')
            throw "El par\u00e1metro 'atributo' del m\u00e9todo 'establecerAtributo' en el espacio de nombre 'utiles', debe ser de tipo cadena.";

        if (typeof valor !== 'string')
            throw "El par\u00e1metro 'valor' del m\u00e9todo 'establecerAtributo' en el espacio de nombre 'utiles', debe ser de tipo cadena.";
        // fin { validaciones de parámetros }

        if (this.existeElemento(id)) {
            let elemento = document.getElementById(id);
            elemento.setAttribute(atributo, valor);
        } else
            console.log("utiles.establecerAtributo(): El id '" + id + "' no existe.");
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
    },
    cargarOpcionesMenuCiudad: function() {
        let url = this.obtenerUrlBase() + '/ajax/ciudad-obtener-todos-vigente-filtrado-por-depar';
        let departamen = parseInt($('#departamen').val());

        $.getJSON(url, {"departamen": departamen})
        .done(function(datos) {
            $('#ciudad').empty().append('<option value="0"></option>');

            if (datos.info.ok && datos.info.resultados > 0) {
                $.each(datos.resultados, function(indice, resultado) {
                    $('#ciudad').append('<option value="' + resultado.codigo + '">' + resultado.nombre + '</option>');
                });
            }
        })
        .fail(function(jqxhr, textoEstado, error) {
                let err = textoEstado + ', ' + error;
                console.log('Solicitud fallida: ' + err);
        });
    }

}
