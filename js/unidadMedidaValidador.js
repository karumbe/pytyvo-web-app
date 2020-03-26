const unidadMedidaValidador = {

    _codigo: 0,
    _nombre: '',
    _simbolo: '',
    _divisible: false,
    _vigente: false,
    _errorCodigo: '',
    _errorNombre: '',
    _errorSimbolo: '',
    _errorDivisible: '',
    _errorVigente: '',
    obtenerCodigo: function() {
        return this._codigo;
    },
    obtenerNombre: function() {
        return this._nombre;
    },
    obtenerSimbolo: function() {
        return this._simbolo;
    },
    esDivisible: function() {
        return this._divisible;
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
    establecerSimbolo: function(simbolo) {
        this._errorSimbolo = this._validarSimbolo(simbolo);
        return this._errorSimbolo === '' ? true : false;
    },
    establecerDivisible: function(divisible) {
        this._errorDivisible = this._validarDivisible(divisible);
        return this._errorDivisible === '' ? true : false;
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
            return 'El código debe ser menor a 10 mil.';

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
    _validarSimbolo: function(simbolo) {
        if (typeof simbolo !== 'string')
            return 'El símbolo debe ser de tipo texto.';

        if (simbolo.length === 0 || simbolo.trim() === '')
            return 'El símbolo no puede quedar en blanco.';

        if (simbolo.length < 1)
            return 'El símbolo es demasiado corto (mínimo 1 caracter).';

        if (simbolo.length > 5)
            return 'El símbolo es demasiado largo (máximo 5 caracteres).';

        this._simbolo = simbolo;

        return '';
    },
    _validarDivisible: function(divisible) {
        if (typeof divisible !== 'boolean')
            return 'Divisible debe ser de tipo lógico.';

        this._divisible = divisible;

        return '';
    },
    _validarVigente: function(vigente) {
        if (typeof vigente !== 'boolean')
            return 'Vigente debe ser de tipo lógico.';

        this._vigente = vigente;

        return '';
    },
    validar: function() {
        let codigo, nombre, simbolo, divisible, vigente;

        codigo = parseInt(document.getElementsByName('codigo')[0].value);
        nombre = document.getElementById('nombre').value;
        simbolo = document.getElementById('simbolo').value;
        divisible = document.getElementById('divisible').value;
        vigente = document.getElementById('vigente').value;

        if (divisible === 'on')
            divisible = true;
        else
            divisible = false;

        if (vigente === 'on')
            vigente = true;
        else
            vigente = false;

        this.establecerCodigo(codigo);
        this.establecerNombre(nombre);
        this.establecerSimbolo(simbolo);
        this.establecerDivisible(divisible);
        this.establecerVigente(vigente);

        utiles.ocultarElemento('error-nombre');
        utiles.ocultarElemento('error-simbolo');

        if (this._esValido())
            return true;

        if (this._errorNombre !== '') {
            this.mostrarErrorNombre();
            utiles.establecerEnfoque('nombre');
        }

        if (this._errorSimbolo !== '') {
            this.mostrarErrorSimbolo();

            if (this._errorNombre === '')
                utiles.establecerEnfoque('simbolo');
        }

        return false;
    },
    _esValido: function() {
        if (this._errorCodigo === '' &&
                this._errorNombre === '' &&
                this._errorSimbolo === '' &&
                this._errorDivisible === '' &&
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
            console.log("unidadMedidaValidador.mostrarErrorNombre(): El id 'error-nombre' no existe.");
    },
    mostrarErrorSimbolo: function() {
        let elemento = document.getElementById('error-simbolo');

        if (elemento !== null)  {
            elemento.innerHTML = this._errorSimbolo;
            utiles.mostrarElemento('error-simbolo');
        } else
            console.log("unidadMedidaValidador.mostrarErrorSimbolo(): El id 'error-simbolo' no existe.");
    }

}