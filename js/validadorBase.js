const validadorBase = {

    _codigo: 0,
    _nombre: '',
    _vigente: false,
    _errorCodigo: '',
    _errorNombre: '',
    _errorVigente: '',
    obtenerCodigo: function() {
        return this._codigo;
    },
    obtenerNombre: function() {
        return this._nombre;
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

        if (codigo > 9999)
            return 'El código debe ser menor a diez mil.';

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
    _validarVigente: function(vigente) {
        if (typeof vigente !== 'boolean')
            return 'Vigente debe ser de tipo lógico.';

        this._vigente = vigente;

        return '';
    },
    validar: function() {
        let codigo, nombre, vigente;

        codigo = parseInt(document.getElementsByName('codigo')[0].value);
        nombre = document.getElementById('nombre').value;
        vigente = document.getElementById('vigente').value;

        if (vigente === 'on')
            vigente = true;
        else
            vigente = false;

        this.establecerCodigo(codigo);
        this.establecerNombre(nombre);
        this.establecerVigente(vigente);

        utiles.ocultarElemento('error-nombre');

        if (this._esValido())
            return true;

        if (this._errorNombre !== '') {
            this.mostrarErrorNombre();
            utiles.establecerEnfoque('nombre');
        }

        return false;
    },
    _esValido: function() {
        if (this._errorCodigo === '' &&
                this._errorNombre === '' &&
                this._errorVigente === '')
            return true;
        else
            return false;
    },
    mostrarErrorNombre: function() {
        let elemento = document.getElementById('error-nombre');

        if (elemento !== null)  {
            elemento.innerHTML = this._errorNombre;
            utiles.mostrarElemento('error-nombre');
        } else
            console.log("validadorBase.mostrarErrorNombre(): El id 'error-nombre' no existe.");
    }

}
