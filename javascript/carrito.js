const cantidades = document.querySelectorAll('[id^="cantidad"]');
cantidades.forEach(cantidad => {
    cantidad.onchange = actualizar_cantidad;
});

function actualizar_cantidad() {
    const productos = document.querySelectorAll('[id^="prod_"]');
    var suma = 0;
    var totalProductos = 0;

    productos.forEach(element => {
        const clave_unica = element.querySelector('[name="clave_unica"]').value;
        const cantidad = parseInt(element.querySelector(`#cantidad_${clave_unica}`).value);
        const precio = parseFloat(element.querySelector(`#precio_${clave_unica}`).textContent);

        suma += cantidad * precio;
        totalProductos += cantidad;

        // Enviamos la cantidad actualizada al servidor a través de AJAX
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'actualizar_cantidad.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            console.log(xhr.responseText);
        };
        xhr.send(`clave_unica=${clave_unica}&cantidad=${cantidad}`);
    });

    document.getElementById('preciototal').innerHTML = suma.toFixed(2) + " €";
    actualizarContadorCarrito(totalProductos);
}




function actualizarPrecio(precio) {
    const precioTotal = document.getElementById('preciototal');
    const precioNumerico = parseFloat(precioTotal.textContent.replace('€', ''));
    const nuevoPrecio = precioNumerico + precio;
    precioTotal.textContent = nuevoPrecio.toFixed(2) + '€';
}

function eliminarProducto(event, claveUnica) {
    event.preventDefault();
    const botonBorrar = event.target;
    const divProducto = botonBorrar.closest('.border.rounded');
    const precioProducto = divProducto.querySelector('.precio').textContent;
    const cantidadTotal = document.getElementById(`cantidad_${claveUnica}`);
    const precioNumerico = parseFloat(precioProducto.replace('€', ''));
    const cantidad = divProducto.querySelector('.cantidad').value;

    // Enviar una petición AJAX al servidor para eliminar la variable de sesión
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'eliminar_producto.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Si la petición fue exitosa, actualizar el precio y remover el producto del DOM
                actualizarPrecio(-precioNumerico * cantidad);
                divProducto.remove();
                actualizarContadorCarrito(); // Llamar a la función para actualizar el contador del carrito
                // Llamar a la función para actualizar el contador de productos
            } else {
                // Si la petición falló, mostrar un mensaje de error
                alert('Error al eliminar el producto');
            }
        }
    };
    xhr.send(`clave_unica=${claveUnica}`);
}

function actualizarContadorCarrito(totalProductos) {
    const contadorCarrito = document.querySelector('.contador');
    contadorCarrito.textContent = totalProductos;
}