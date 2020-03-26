let validarNombre = new Promise((resolve, reject) => {
    let bandera, codigo, nombre;

    bandera = obtenerAccionSolicitada();
    codigo = parseInt(document.getElementsByName('codigo')[0].value);
    nombre = document.getElementById('nombre').value;

    mensajeError = ''

    if (typeof nombre !== 'string')
        reject('Nombre: Debe ser de tipo texto.');

    if (nombre.length === 0 || nombre.trim() === '')
        reject('Nombre: No puede quedar en blanco.');

    if (nombre.length < 6)
        reject('El nombre es demasiado corto (mínimo 6 caracteres).');

    if (nombre.length > 30)
        reject('Nombre: Demasiado largo.');

    resolve('');
});

let nombreExiste = new Promise((resolve, reject) => {
    let bandera, codigo, nombre, params, respuesta;

    bandera = obtenerAccionSolicitada();
    codigo = parseInt(document.getElementsByName('codigo')[0].value);
    nombre = document.getElementById('nombre').value;
    params = utiles.obtenerCadenaConsulta(
        {"bandera": bandera, "codigo": codigo, "nombre": nombre});

    utiles.peticion(
        'POST', config.ajax + config.modulo + '-nombre-existe', params)
    .then((respuesta) => {
        if (typeof respuesta === 'object' &&
                typeof respuesta.nombre_existe !== 'undefined') {
console.log('realizando peticion');
            if (respuesta.nombre_existe)
                reject('Nombre: Ya existe.');
            else
                resolve('');
        } else            
            reject('Nombre: Ya existe.');
    })
    .catch((razon) => {
        console.log(razon);
        this._nombreExiste = true;
    });

});


function validar() {
    validarNombre().then(mensaje => {
        console.log(mensaje);

    }).catch(error => {
        console.error(error);
    });

    return false;
}


function obtenerAccionSolicitada() {
    let accionSolicitada, bandera

    accionSolicitada = document.getElementsByName('accion_solicitada')[0].value;

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

var promise = new Promise(function(resolve, reject) {
  
  function sayHello() {
    resolve('Hello World!')
  }

  setTimeout(sayHello, 5000)

})

console.log(promise)