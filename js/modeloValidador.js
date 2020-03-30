const modeloValidador = {

    _codigo: 0,
    _nombre: '',
    _maquina: 0,
    _marca: 0,
    _vigente: false,
    _errorCodigo: '',
    _errorNombre: '',
    _errorMaquina: '',
    _errorMarca: '',
    _errorVigente: '',
    obtenerCodigo: function() {
        return this._codigo;
    },
    obtenerNombre: function() {
        return this._nombre;
    },
    obtenerMaquina: function() {
        return this._maquina;
    },
    obtenerMarca: function() {
        return this._marca;
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
    establecerMaquina: function(maquina) {
        this._errorMaquina = this._validarMaquina(maquina);
        return this._errorMaquina === '' ? true : false;
    },
    establecerMarca: function(marca) {
        this._errorMarca = this._validarMarca(marca);
        return this._errorMarca === '' ? true : false;
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

        if (nombre.length < 3)
            return 'El nombre es demasiado corto (mínimo 3 caracteres).';

        if (nombre.length > 30)
            return 'El nombre es demasiado largo (máximo 30 caracteres).';

        this._nombre = nombre;

        return '';
    },
    _validarMaquina: function(maquina) {
        if (typeof maquina !== 'number')
            return 'El código de máquina debe ser de tipo número.';

        if (!Number.isInteger(maquina))
            return 'El código de máquina debe ser un número entero.';

        if (maquina <= 0)
            return 'Debe seleccionar una máquina.';

        if (maquina > 999)
            return 'El código de máquina debe ser menor a un mil.';

        this._maquina = maquina;

        return '';
    },
    _validarMarca: function(marca) {
        if (typeof marca !== 'number')
            return 'El código de marca debe ser de tipo número.';

        if (!Number.isInteger(marca))
            return 'El código de marca debe ser un número entero.';

        if (marca <= 0)
            return 'Debe seleccionar una marca.';

        if (marca > 9999)
            return 'El código de marca debe ser menor a diez mil.';

        this._marca = marca;

        return '';
    },
    _validarVigente: function(vigente) {
        if (typeof vigente !== 'boolean')
            return 'Vigente debe ser de tipo lógico.';

        this._vigente = vigente;

        return '';
    },
    validar: function() {
        let codigo, nombre, maquina, marca, vigente;

        codigo = parseInt(document.getElementsByName('codigo')[0].value);
        nombre = document.getElementById('nombre').value;
        maquina = parseInt(document.getElementById('maquina').value);
        marca = parseInt(document.getElementById('marca').value);
        vigente = document.getElementById('vigente').value;

        if (vigente === 'on')
            vigente = true;
        else
            vigente = false;

        this.establecerCodigo(codigo);
        this.establecerNombre(nombre);
        this.establecerMaquina(maquina);
        this.establecerMarca(marca);
        this.establecerVigente(vigente);

        utiles.ocultarElemento('error-maquina');
        utiles.ocultarElemento('error-marca');
        utiles.ocultarElemento('error-nombre');

        if (this._esValido()) {
            if (this.obtenerAccionSolicitada() === 2) {
                if (!utiles.elementoEstaHabilitado('maquina')) {
                    utiles.establecerAtributo('maquina', 'readonly');
                    utiles.habilitarElemento('maquina');
                }

                if (!utiles.elementoEstaHabilitado('marca')) {
                    utiles.establecerAtributo('marca', 'readonly');
                    utiles.habilitarElemento('marca');
                }
            }

            return true;
        }

        if (this._errorMaquina !== '') {
            this.mostrarErrorMaquina();
            utiles.establecerEnfoque('maquina');
        }

        if (this._errorMarca !== '') {
            this.mostrarErrorMarca();

            if (this._errorMaquina === '')
                utiles.establecerEnfoque('marca');
        }

        if (this._errorNombre !== '') {
            this.mostrarErrorNombre();

            if (this._errorMaquina === '' &&
                    this._errorMarca === '')
                utiles.establecerEnfoque('nombre');
        }

        return false;
    },
    _esValido: function() {
        if (this._errorCodigo === '' &&
                this._errorNombre === '' &&
                this._errorMaquina === '' &&
                this._errorMarca === '' &&
                this._errorVigente === '')
            return true;
        else
            return false;
    },
    mostrarErrorMaquina: function() {
        let elemento = document.getElementById('error-maquina');

        if (elemento !== null)  {
            elemento.innerHTML = this._errorMaquina;
            utiles.mostrarElemento('error-maquina');
        } else
            console.log("modeloValidador.mostrarErrorMaquina(): El id 'error-maquina' no existe.");
    },
    mostrarErrorMarca: function() {
        let elemento = document.getElementById('error-marca');

        if (elemento !== null)  {
            elemento.innerHTML = this._errorMarca;
            utiles.mostrarElemento('error-marca');
        } else
            console.log("modeloValidador.mostrarErrorMarca(): El id 'error-marca' no existe.");
    },
    mostrarErrorNombre: function() {
        let elemento = document.getElementById('error-nombre');

        if (elemento !== null)  {
            elemento.innerHTML = this._errorNombre;
            utiles.mostrarElemento('error-nombre');
        } else
            console.log("modeloValidador.mostrarErrorNombre(): El id 'error-nombre' no existe.");
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
