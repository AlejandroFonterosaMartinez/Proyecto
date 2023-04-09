function clickImagen() {
    document.querySelector('#input-imagen').click();
}

function previewImagen() {
    const imagen = document.querySelector('#imagen-perfil');
    const file = document.querySelector('#input-imagen').files[0];
    const reader = new FileReader();

    reader.addEventListener("load", function () {
        imagen.src = reader.result;
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    } else {
        imagen.src = '../imagenes/imagen_mas.png';
    }
}