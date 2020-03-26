let marca = {

    bandera: 0,
    codigo: 0,
    nombre: '',
    vigente: false,
    errorBandera: '',
    errorCodigo: '',
    errorNombre: '',
    errorVigente: '',
    obtenerBandera: function() {
        return this.bandera;
    },
    obtenerCodigo: function() {
        return this.codigo;
    },
    obtenerNombre: function() {
        return this.nombre;
    },
    estaVigente: function() {
        return this.vigente;
    },
    establecerBandera: function(bandera) {
        this.errorBandera = this.validarBandera(bandera);
        return this.errorBandera === '' ? true : false;
    },
    establecerCodigo: function(codigo) {
        this.errorCodigo = this.validarCodigo(codigo);
        return this.errorCodigo === '' ? true : false; 
    },
    establecerNombre: function(nombre) {
        this.errorNombre = this.validarNombre(nombre);
        return this.errorNombre === '' ? true : false;
    },
    establecerVigente: function(vigente) {
        this.errorVigente = this.validarVigente(vigente);
        return this.errorVigente === '' ? true : false;
    },
    validarBandera: function(bandera) {
        if (typeof bandera !== 'number')
            return 'Bandera: Debe ser de tipo número.';

        if (!Number.isInteger(bandera))
            return 'Bandera: Debe ser un número entero.';

        if (bandera < 1 || bandera > 2)
            return 'Bandera: Debe ser un valor entre 1 y 2.';

        this.bandera = bandera;

        return '';
    },
    validarCodigo: function(codigo) {
        if (typeof codigo !== 'number')
            return 'Código: Debe ser de tipo número.';

        if (!Number.isInteger(codigo))
            return 'Código: Debe ser un número entero.';

        if (codigo < 0)
            return 'Código: Debe ser mayor o igual a cero.';

        if (codigo > 9999)
            return 'Código: Debe ser menor a 10 mil.';

        this.codigo = codigo;

        return '';
    },
    validarNombre: function(nombre) {
        if (typeof nombre !== 'string')
            return 'Nombre: Debe ser de tipo texto.';

        if (nombre.length === 0 || nombre.trim() === '')
            return 'Nombre: No puede quedar en blanco.';

        if (nombre.length < 6)
            return 'Nombre: Demasiado corto.';

        if (nombre.length > 30)
            return 'Nombre: Demasiado largo.';

        this.nombre = nombre;

        return '';
    },
    validarVigente: function(vigente) {
        if (typeof vigente !== 'boolean')
            return 'Vigente: Debe ser de tipo lógico.';

        this.vigente = vigente;

        return '';
    },
    validar: function(bandera, codigo, nombre, vigente) {
        this.establecerBandera(bandera);
        this.establecerCodigo(codigo);
        this.establecerNombre(nombre);
        this.establecerVigente(vigente);

        return this.esValido();
    },
    esValido: function() {
        if (this.errorBandera === '' &&
                this.errorCodigo === '' &&
                this.errorNombre === '' &&
                this.errorVigente === '')
            return true;
        else
            return false;
    },
    obtenerErrorBandera: function() {
        return this.errorBandera;
    },
    obtenerErrorCodigo: function() {
        return this.errorCodigo;
    },
    obtenerErrorNombre: function() {
        return this.errorNombre;
    },
    obtenerErrorVigente: function() {
        return this.errorVigente;
    },
    obtenerError: function() {
        let mensajeError = '';

        if (this.errorBandera !== '') {
            if (mensajeError !== '')
                mensajeError += '\n';

            mensajeError += this.errorBandera;
        }

        if (this.errorCodigo !== '') {
            if (mensajeError !== '')
                mensajeError += '\n';

            mensajeError += this.errorCodigo;
        }

        if (this.errorNombre !== '') {
            if (mensajeError !== '')
                mensajeError += '\n';

            mensajeError += this.errorNombre;
        }

        if (this.errorVigente !== '') {
            if (mensajeError !== '')
                mensajeError += '\n';

            mensajeError += this.errorVigente;
        }

        return mensajeError;
    },
    obtenerModelo: function() {
        let modelo = null;

        if (this.esValido())
            modelo = {
                bandera: this.bandera,
                codigo: this.codigo,
                nombre: this.nombre,
                vigente: this.vigente
            }

        return modelo;
    },
    mostrarErrorBandera: function() {
        let elemento = document.getElementById('error-bandera');

        if (elemento !== null)  
            elemento.innerHTML = this.errorBandera;
        else
            console.log("Id 'error-bandera' no existe."); 
    },
    mostrarErrorCodigo: function() {
        let elemento = document.getElementById('error-codigo');

        if (elemento !== null)  
            elemento.innerHTML = this.errorCodigo;
        else
            console.log("Id 'error-codigo' no existe."); 
    },
    mostrarErrorNombre: function() {
        let elemento = document.getElementById('error-nombre');

        if (elemento !== null)  
            elemento.innerHTML = this.errorNombre;
        else
            console.log("Id 'error-nombre' no existe.");
    },
    mostrarErrorVigente: function() {
        let elemento = document.getElementById('error-vigente');

        if (elemento !== null)  
            elemento.innerHTML = this.errorVigente;
        else
            console.log("Id 'error-vigente' no existe.");
    },
    obtenerPorCodigo: function(codigo) {
    }

}