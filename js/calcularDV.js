let calcularDV = {

    calcular: function(numero, baseMax = 11) {
        if (typeof numero !== 'string')
            throw "ERROR: El par\u00e1metro 'numero' del m\u00e9todo 'calcular' en el espacio de nombre 'calcularDV', debe ser de tipo cadena.";

        numero = numero.trim();

        if (numero.length === 0 || numero === '')
            throw "ERROR: El par\u00e1metro 'numero' del m\u00e9todo 'calcular' en el espacio de nombre 'calcularDV', no puede estar en blanco.";

        let numeroAl, caracter, codigo, k, total, numeroAux, resto, digito;

        numeroAl = '';

        for (let i = 0; i < numero.length; i++) {
            caracter = numero.substr(i, 1).toUpperCase();
            codigo = caracter.charCodeAt();

            if (codigo >= 48 && codigo <= 57) {    // de 0 a 9.
                numeroAl += caracter;
            } else {
                numeroAl += codigo;
            }
        }

        k = 2;
        total = 0;

        for (let i = --numeroAl.length; i >= 0; i--) {
            if (k > baseMax)
                k = 2;

            numeroAux = parseInt(numeroAl.substr(i, 1));
            total += numeroAux * k++;
        }

        resto = total % 11;

        if (resto > 1)
            digito = 11 - resto;
        else
            digito = 0;

        return digito;
    }

}