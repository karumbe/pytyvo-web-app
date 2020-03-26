const familiaValidador = {

    _codigo: 0,
    _nombre: '',
    _p0: 0.0,
    _p2: 0.0,
    _p3: 0.0,
    _p4: 0.0,
    _p5: 0.0,
    _vigente: false,
    _errorCodigo: '',
    _errorNombre: '',
    _errorP1: '',
    _errorP2: '',
    _errorP3: '',
    _errorP4: '',
    _errorP5: '',
    _errorVigente: '',
    obtenerCodigo: function() {
        return this._codigo;
    },
    obtenerNombre: function() {
        return this._nombre;
    },
    obtenerP1: function() {
        return this._p1;
    },
    obtenerP2: function() {
        return this._p2;
    },
    obtenerP3: function() {
        return this._p3;
    },
    obtenerP4: function() {
        return this._p4;
    },
    obtenerP5: function() {
        return this._p5;
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
    establecerP1: function(p1) {
        this._errorP1 = this._validarP1(p1);
        return this._errorP1 === '' ? true : false;
    },
    establecerP2: function(p2) {
        this._errorP2 = this._validarP2(p2);
        return this._errorP2 === '' ? true : false;
    },
    establecerP3: function(p3) {
        this._errorP3 = this._validarP3(p3);
        return this._errorP3 === '' ? true : false;
    },
    establecerP4: function(p4) {
        this._errorP4 = this._validarP4(p4);
        return this._errorP4 === '' ? true : false;
    },
    establecerP5: function(p5) {
        this._errorP5 = this._validarP5(p5);
        return this._errorP5 === '' ? true : false;
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
    _validarP1: function(p1) {
        if (typeof p1 !== 'number')
            return 'El porcentaje debe ser de tipo número.';

        if (p1 < 0)
            return 'El porcentaje debe ser mayor o igual a cero.';

        if (p1 > 1000)
            return 'El porcentaje debe ser menor a un mil.';

        this._p1 = p1;

        return '';
    },
    _validarP2: function(p2) {
        if (typeof p2 !== 'number')
            return 'El porcentaje debe ser de tipo número.';

        if (p2 < 0)
            return 'El porcentaje debe ser mayor o igual a cero.';

        if (p2 > 1000)
            return 'El porcentaje debe ser menor a un mil.';

        this._p2 = p2;

        return '';
    },
    _validarP3: function(p3) {
        if (typeof p3 !== 'number')
            return 'El porcentaje debe ser de tipo número.';

        if (p3 < 0)
            return 'El porcentaje debe ser mayor o igual a cero.';

        if (p3 > 1000)
            return 'El porcentaje debe ser menor a un mil.';

        this._p3 = p3;

        return '';
    },
    _validarP4: function(p4) {
        if (typeof p4 !== 'number')
            return 'El porcentaje debe ser de tipo número.';

        if (p4 < 0)
            return 'El porcentaje debe ser mayor o igual a cero.';

        if (p4 > 1000)
            return 'El porcentaje debe ser menor a un mil.';

        this._p4 = p4;

        return '';
    },
    _validarP5: function(p5) {
        if (typeof p5 !== 'number')
            return 'El porcentaje debe ser de tipo número.';

        if (p5 < 0)
            return 'El porcentaje debe ser mayor o igual a cero.';

        if (p5 > 1000)
            return 'El porcentaje debe ser menor a un mil.';

        this._p5 = p5;

        return '';
    },
    _validarVigente: function(vigente) {
        if (typeof vigente !== 'boolean')
            return 'Vigente debe ser de tipo lógico.';

        this._vigente = vigente;

        return '';
    },
    validar: function() {
        let codigo, nombre, p1, p2, p3, p4, p5, vigente;

        codigo = parseInt(document.getElementsByName('codigo')[0].value);
        nombre = document.getElementById('nombre').value;
        p1 = parseFloat(document.getElementById('p1').value);
        p2 = parseFloat(document.getElementById('p2').value);
        p3 = parseFloat(document.getElementById('p3').value);
        p4 = parseFloat(document.getElementById('p4').value);
        p5 = parseFloat(document.getElementById('p5').value);
        vigente = document.getElementById('vigente').value;

        if (vigente === 'on')
            vigente = true;
        else
            vigente = false;

        this.establecerCodigo(codigo);
        this.establecerNombre(nombre);
        this.establecerP1(p1);
        this.establecerP2(p2);
        this.establecerP3(p3);
        this.establecerP4(p4);
        this.establecerP5(p5);
        this.establecerVigente(vigente);

        utiles.ocultarElemento('error-nombre');
        utiles.ocultarElemento('error-p1');
        utiles.ocultarElemento('error-p2');
        utiles.ocultarElemento('error-p3');
        utiles.ocultarElemento('error-p4');
        utiles.ocultarElemento('error-p5');

        if (this._esValido())
            return true;

        if (this._errorNombre !== '') {
            this.mostrarErrorNombre();
            utiles.establecerEnfoque('nombre');
        }

        if (this._errorP1 !== '') {
            this.mostrarErrorP1();

            if (this._errorNombre === '')
                utiles.establecerEnfoque('p1');
        }

        if (this._errorP2 !== '') {
            this.mostrarErrorP2();

            if (this._errorNombre === '' &&
                    this._errorP1 === '')
                utiles.establecerEnfoque('p2');
        }

        if (this._errorP3 !== '') {
            this.mostrarErrorP3();

            if (this._errorNombre === '' &&
                    this._errorP1 === '' &&
                    this._errorP2 === '')
                utiles.establecerEnfoque('p3');
        }

        if (this._errorP4 !== '') {
            this.mostrarErrorP4();

            if (this._errorNombre === '' &&
                    this._errorP1 === '' &&
                    this._errorP2 === '' &&
                    this._errorP3 === '')
                utiles.establecerEnfoque('p4');
        }

        if (this._errorP5 !== '') {
            this.mostrarErrorP5();

            if (this._errorNombre === '' &&
                    this._errorP1 === '' &&
                    this._errorP2 === '' &&
                    this._errorP3 === '' &&
                    this._errorP4 === '')
                utiles.establecerEnfoque('p5');
        }

        return false;
    },
    _esValido: function() {
        if (this._errorCodigo === '' &&
                this._errorNombre === '' &&
                this._errorP1 === '' &&
                this._errorP2 === '' &&
                this._errorP3 === '' &&
                this._errorP4 === '' &&
                this._errorP5 === '' &&
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
            console.log("familiaValidador.mostrarErrorNombre(): El id 'error-nombre' no existe.");
    },
    mostrarErrorP1: function() {
        let elemento = document.getElementById('error-p1');

        if (elemento !== null)  {
            elemento.innerHTML = this._errorP1;
            utiles.mostrarElemento('error-p1');
        } else
            console.log("familiaValidador.mostrarErrorP1(): El id 'error-p1' no existe.");
    },
    mostrarErrorP2: function() {
        let elemento = document.getElementById('error-p2');

        if (elemento !== null)  {
            elemento.innerHTML = this._errorP2;
            utiles.mostrarElemento('error-p2');
        } else
            console.log("familiaValidador.mostrarErrorP2(): El id 'error-p2' no existe.");
    },
    mostrarErrorP3: function() {
        let elemento = document.getElementById('error-p3');

        if (elemento !== null)  {
            elemento.innerHTML = this._errorP3;
            utiles.mostrarElemento('error-p3');
        } else
            console.log("familiaValidador.mostrarErrorP3(): El id 'error-p3' no existe.");
    },
    mostrarErrorP4: function() {
        let elemento = document.getElementById('error-p4');

        if (elemento !== null)  {
            elemento.innerHTML = this._errorP4;
            utiles.mostrarElemento('error-p4');
        } else
            console.log("familiaValidador.mostrarErrorP4(): El id 'error-p4' no existe.");
    },
    mostrarErrorP5: function() {
        let elemento = document.getElementById('error-p5');

        if (elemento !== null)  {
            elemento.innerHTML = this._errorP5;
            utiles.mostrarElemento('error-p5');
        } else
            console.log("familiaValidador.mostrarErrorP5(): El id 'error-p5' no existe.");
    }

}