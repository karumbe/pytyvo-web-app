const ciudadValidador = {

    _codigo: 0,
    _nombre: '',
    _departamen: 0,
    _vigente: false,
    _errorCodigo: '',
    _errorNombre: '',
    _errorDepartamen: '',
    _errorVigente: '',
    obtenerCodigo: function() {
        return this._codigo;
    },
    obtenerNombre: function() {
        return this._nombre;
    },
    obtenerDepartamen: function() {
        return this._departamen;
    },
    estaVigente: function() {
        return this._vigente;
    },
    establecerCodigo: function(codigo) {
        this._errorCodigo = this._validarCodigo(codigo);
        return this._errorCodigo === '' ? true : false;
    },
    establecerNombre: function(nombre) {
        this._errorNombre = this._validarNombre(nombre);
        return this._errorNombre === '' ? true : false;
    },
    establecerDepartamen: function(departamen) {
        this._errorDepartamen = this._validarDepartamen(departamen);
        return this._errorDepartamen === '' ? true : false;
    },
    establecerVigente: function(vigente) {
        this._errorVigente = this._validarVigente(vigente);
        return this._errorVigente === '' ? true : false;
    },
    _validarCodigo: function(codigo) {
        if (typeof codigo !== 'number')
            return 'El código debe ser de tipo número.';

        if (!Number.isInteger(codigo))
            return 'El código debe ser un número entero.';

        if (codigo < 0)
            return 'El código debe ser mayor o igual a cero.';

        if (codigo > 99999)
            return 'El código debe ser menor a cien mil.';

        this._codigo = codigo;

        return '';
    },
    _validarNombre: function(nombre) {
        if (typeof nombre !== 'string')
            return 'El nombre debe ser de tipo texto.';

        if (nombre.length === 0 || nombre.trim() === '')
            return 'El nombre no puede quedar en blanco.';

        if (nombre.length < 6)
            return 'El nombre es demasiado corto (mínimo 6 caracteres).';

        if (nombre.length > 30)
            return 'El nombre es demasiado largo (máximo 30 caracteres).';

        this._nombre = nombre;

        return '';
    },
    _validarDepartamen: function(departamen) {
        if (typeof departamen !== 'number')
            return 'El código de departamento debe ser de tipo número.';

        if (!Number.isInteger(departamen))
            return 'El código de departamento debe ser un número entero.';

        if (departamen <= 0)
            return 'Debe seleccionar un departamento.';

        if (departamen > 999)
            return 'El código de departamento debe ser menor a un mil.';

        this._departamen = departamen;

        return '';
    },
    _validarVigente: function(vigente) {
        if (typeof vigente !== 'boolean')
            return 'Vigente debe ser de tipo lógico.';

        this._vigente = vigente;

        return '';
    },
    validar: function() {
        let codigo, nombre, departamen, vigente;

        codigo = parseInt(document.getElementsByName('codigo')[0].value);
        nombre = document.getElementById('nombre').value;
        departamen = parseInt(document.getElementById('departamen').value);
        vigente = document.getElementById('vigente').value;

        if (vigente === 'on')
            vigente = true;
        else
            vigente = false;

        this.establecerCodigo(codigo);
        this.establecerNombre(nombre);
        this.establecerDepartamen(departamen);
        this.establecerVigente(vigente);

        utiles.ocultarElemento('error-departamen');
        utiles.ocultarElemento('error-nombre');

        if (this._esValido()) {
            if (this.obtenerAccionSolicitada() === 2) {
                if (!utiles.elementoEstaHabilitado('departamen')) {
                    utiles.establecerAtributo('departamen', 'readonly');
                    utiles.habilitarElemento('departamen');
                }
            }

            return true;
        }

        if (this._errorDepartamen !== '') {
            this.mostrarErrorDepartamen();
            utiles.establecerEnfoque('departamen');
        }

        if (this._errorNombre !== '') {
            this.mostrarErrorNombre();

            if (this._errorDepartamen === '')
                utiles.establecerEnfoque('nombre');
        }

        return false;
    },
    _esValido: function() {
        if (this._errorCodigo === '' &&
                this._errorNombre === '' &&
                this._errorDepartamen === '' &&
                this._errorVigente === '')
            return true;
        else
            return false;
    },
    mostrarErrorDepartamen: function() {
        let elemento = document.getElementById('error-departamen');

        if (elemento !== null)  {
            elemento.innerHTML = this._errorDepartamen;
            utiles.mostrarElemento('error-departamen');
        } else
            console.log("ciudadValidador.mostrarErrorDepartamen(): El id 'error-departamen' no existe.");
    },
    mostrarErrorNombre: function() {
        let elemento = document.getElementById('error-nombre');

        if (elemento !== null)  {
            elemento.innerHTML = this._errorNombre;
            utiles.mostrarElemento('error-nombre');
        } else
            console.log("ciudadValidador.mostrarErrorNombre(): El id 'error-nombre' no existe.");
    },
    obtenerAccionSolicitada: function() {
        let accionSolicitada, bandera

        accionSolicitada =
            document.getElementsByName('accion_solicitada')[0].value;

        switch (accionSolicitada) {
            case 'crear':
                bandera = 1;
                break;
            case 'actualizar':
                bandera = 2;
                break;
            default:
                bandera = 0;
        }

        return bandera;
    }

}
