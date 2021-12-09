/**
 * Realiza las modificaciones en la lista de productos para comprobar si ya no hay existencias de cada uno de ellos.
 * 
 * @param {boolean} cargando Indica si la página se esta cargando o si la función es llamada desde otra.
 */
function actualizarCantidades(cargando) {
    var carrito = getCookie("carrito");

    //Comprueba si hay elementos en la cookie de carrito
    if (carrito != null && carrito.length != 0) {
        var elemProd, elemCantProd;

        carrito = JSON.parse(getCookie("carrito"));

        //Pasa por todos los elementos del carrito
        carrito.forEach((producto) => {
            elemProd = document.getElementById("prod" + producto[0]);
            elemCantProd = document.getElementById(
                "cantidadProd" + producto[0]
            );
            var max = elemCantProd.attributes["max"].value;
            //Si esta cargando la página
            if (cargando) {
                //Comprueba la cantidad maxima del producto menos la establecida en el carrito sea mayor de 0
                if (max - producto[1] > 0) {
                    //Si lo es cambia el valor maximo
                    max = max - producto[1];
                    elemCantProd.value = 1;
                } else {
                    //Si en el carrito hay el maximo o más, borra el elemento de la tabla
                    elemProd.remove();
                }
            } else {
                //Comprueba la cantidad maxima del producto menos la establecida en el input de cantidad sea mayor de 0
                if (max - elemCantProd.value > 0) {
                    //Si lo es cambia el valor maximo
                    max = max - elemCantProd.value;
                    elemCantProd.value = 1;
                } else {
                    //Si en el carrito hay el maximo o más, borra el elemento de la tabla
                    elemProd.remove();
                }
            }
        });
    }
}

/**
 * Intercambia el type del input de la contraseña elegida por text o password y el icono.
 * 
 * @param {number} campo identificador del input de la contraseña al que se le agrega "contraseña"+campo si es mayor que 0, si es 0 no se agrega.
 */
function mostrarContrasena(campo) {
    var elemento;
    var icono;

    if (campo == 0) {
        elemento = document.getElementById("contrasena");
        icono = document.getElementById("eye");
    } else {
        elemento = document.getElementById("contrasena" + campo);
        icono = document.getElementById("eye" + campo);
    }

    if (elemento.type == "text") {
        elemento.type = "password";
        icono.className = "bi-eye-slash";
    } else {
        elemento.type = "text";
        icono.className = "bi-eye";
    }
}

/**
 * Controla si el div de cambiar la contraseña en modificacion de usuario debe mostrarse o no, intercambiando tambien la obligatoriedad de sus campos.
 */
function cambiarContrasena() {
    var contenedor = document.getElementById("divContrasena");
    var campo1 = document.getElementById("contrasena2");
    var campo2 = document.getElementById("contrasena2");
    var campo3 = document.getElementById("contrasena3");

    if (window.getComputedStyle(contenedor, null).display === "block") {
        contenedor.style.display = "none";
        campo1.removeAttribute("required");
        campo2.removeAttribute("required");
        campo3.removeAttribute("required");
    } else {
        contenedor.style.display = "block";
        campo1.setAttribute("required", "required");
        campo2.setAttribute("required", "required");
        campo3.setAttribute("required", "required");
    }
}

/**
 * Controla si el div de empleado en registro y modificacion de usuario debe mostrarse o no, intercambiando tambien la obligatoriedad de sus campos.
 */
function esEmpleado() {
    var formDiv = document.getElementById("formEmpleado");
    var form = document.getElementById("form");
    var display = window.getComputedStyle(formDiv, null).display;

    if (display === "block" || display === "flex") {
        formDiv.style.display = "none";
        form["dni"].removeAttribute("required");
        form["cargo"].removeAttribute("required");
        form["sueldo"].removeAttribute("required");
    } else {
        formDiv.style.display = "block";
        form["dni"].setAttribute("required", "required");
        form["cargo"].setAttribute("required", "required");
        form["sueldo"].setAttribute("required", "required");
    }
}

/**
 * Agrega el id y la cantidad del producto especificado al carrito.
 * 
 * @param {number} id Id del producto.
 * @param {number} cantidadMax Cantidad máxima permitida del producto.
 * @param {string} nombre Nombre del producto.
 */
function agregarAlCarrito(id, cantidadMax, nombre) {
    var cantidad = parseInt(document.getElementById("cantidadProd" + id).value);
    var carrito;
    var cantidadActual = cantidad;

    //Comprueba si existe la cookie de carrito o si esta vacía
    if (getCookie("carrito") == null || getCookie("carrito").length == 0) {
        carrito = new Array(new Array(id, cantidad));
    } else {
        //Lee el carrito
        carrito = JSON.parse(getCookie("carrito"));
        var existe = false;

        //Comprueba si ya se encuentra el producto en el carrito. Si ya está, actualiza la cantidad, si no, no hace nada
        carrito.forEach((producto) => {
            if (producto[0] == id) {
                if (producto[1] + cantidad > cantidadMax) {
                    cantidadActual = cantidadMax - producto[1];
                    producto[1] = cantidadMax;
                } else {
                    producto[1] += cantidad;
                }
                existe = true;
            }
        });

        //En el caso de que no esté en el carrito actualmente, lo añade
        if (!existe) {
            carrito.push(new Array(id, cantidad));
        }

        setCookie("carrito", carrito);
    }

    setCookie("carrito", JSON.stringify(carrito), 365);

    //Actualizo la tabla de productos
    actualizarCantidades(false);

    //Muestra un mensaje de confirmación
    alert("Agregado " + cantidadActual + " " + nombre + " al carrito!");
}

/**
 * Mensaje de confirmación para eliminar el producto en el carrito.
 * @param {string} nombre Nombre del producto.
 * @param {number} id Id del producto.
 */
function borrarCarritoMensaje(nombre, id) {
    if (confirm("Seguro que quieres eliminar el producto " + nombre)) {
        quitarElementoCarrito(id);
    }
}

/**
 * Borra el producto especificado del carrito
 * @param {number} id Id del producto. 
 */
function quitarElementoCarrito(id) {
    var carrito, carritoNuevo;
    if ((carrito = getCookie("carrito")) != null) {
        carrito = JSON.parse(carrito);
        carritoNuevo = [];

        //Recorre el carrito actual para cuando encuentre el id del que se quiera borrar no se añada
        carrito.forEach((producto) => {
            if (producto[0] != id) {
                carritoNuevo.push(new Array(producto[0], producto[1]));
            }
        });

        //Si todavía hay elementos en el carrito, sustituye la cookie, si no, la borra
        if (carritoNuevo.length > 0) {
            setCookie("carrito", JSON.stringify(carritoNuevo), 365);
        } else {
            setCookie("carrito", "", -1);
        }
    }
    //Recarga la página para actualizar la tabla del carrito
    location.reload();
}

/**
 * Obtiene la cookie identificada por el nombre.
 * @param {string} nombreBuscar Nombre de la cookie.
 * @returns String con la cookie.
 */
function getCookie(nombreBuscar) {
    var nombreOriginal, valor, cookies = document.cookie.split("; ");

    //Pasa por todos los elementos del array creado separando las cookies por "; "
    for (var i = 0; i < cookies.length; i++) {
        nombreOriginal = cookies[i].substr(0, cookies[i].indexOf("="));

        valor = cookies[i].substr(cookies[i].indexOf("=") + 1);

        //Si el nombre de la cookie coincide con el nombre a buscar devuelve el valor de ella
        if (nombreOriginal == nombreBuscar) {
            return unescape(valor);
        }
    }
}

/**
 * Establece la cookie.
 * @param {string} nombre Nombre de la cookie.
 * @param {string} valor Valor de la cookie.
 * @param {number} dias Días que va a durar la cookie.
 */
function setCookie(nombre, valor, dias) {
    //Crear fecha de caducidad
    var fecha = new Date();
    fecha.setDate(fecha.getDate() + dias);

    //Crar el string de la cookie
    var dato =
        escape(valor) +
        (dias == null ? "" : ";expires = " + fecha.toUTCString());

    //Guarda la cookie
    document.cookie = nombre + "=" + dato + ";path=/";
}