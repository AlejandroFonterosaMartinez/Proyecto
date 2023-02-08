window.onload = function () {
    const IMAGENES = [
        'imagenes/Banner/BannerEj01.png',
        'imagenes/Banner/BannerEj02.png',
        'imagenes/Banner/BannerEj03.png'
    ];
    const TIEMPO_INTERVALO_MILESIMAS_SEG = 2000;
    let posicionActual = 0;
    let $imagen = document.querySelector('#imagen');
    let intervalo;

    function pasarFoto() {
        if (posicionActual >= IMAGENES.length - 1) {
            posicionActual = 0;
        } else {
            posicionActual++;
        }
        renderizarImagen();
    }

    function retrocederFoto() {
        if (posicionActual <= 0) {
            posicionActual = IMAGENES.length - 1;
        } else {
            posicionActual--;
        }
        renderizarImagen();
    }

    function renderizarImagen() {
        $imagen.style.backgroundImage = `url(${IMAGENES[posicionActual]})`;
    }

    renderizarImagen();
    intervalo = setInterval(pasarFoto, TIEMPO_INTERVALO_MILESIMAS_SEG);
}
