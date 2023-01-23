<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>BricoMark</title>
        <link href="css/header.css"
              rel="stylesheet" type="text/css">
        <script src="javascript/script.js"></script>
        <style>
            /* Estilos para el contenedor principal */
            .categorias {
                display: flex; /* Habilita Flexbox */
                flex-wrap: wrap; /* Permite que los elementos se ajusten automáticamente a la pantalla */
                justify-content: center; /* Alinea los elementos en el centro del contenedor */
                align-items: center; /* Centra los elementos verticalmente */
            }

            /* Estilos para los elementos dentro del contenedor */
            .item {
                flex: 1; /* Permite que los elementos ocupen el mismo espacio */
                margin: 10px; /* Agrega margen entre los elementos */
                text-align: center; /* Centra el texto dentro de los elementos */
            }
        </style>
    </head>
    <body>
        <header>
            <nav>
                <div class="container">
                    <div class="                    logo">Mi Sitio</div>
                    <form class="search-form">
                        <input type="text" placeholder="Buscar...">
                        <button type="submit">Buscar</button>
                    </form>

                    <ul class="nav-links">
                        <li><a href="#">Inicio</a></li>
                        <li><a href="#">Acerca de</a></li>
                        <li><a href="#">Contacto</a></li>
                        <li><a href="#">Mi Cuenta</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="categorias">
            <div class="item"><img src="imagenes/Logos/carretilla.png"/></div>
            <div class="item"><img src="imagenes/Logos/ArenasYgravas.png" /></div>
            <div class="item"><img src="imagenes/Logos/Cemento.png"/></div>
            <div class="item"><img src="imagenes/Logos/carretilla.png"/></div>
            <div class="item"><img src="imagenes/Logos/carretilla.png"/></div>
            <div class="item"><img src="imagenes/Logos/carretilla.png"/></div>
            <div class="item"><img src="imagenes/Logos/carretilla.png"/></div>
            <div class="item"><img src="imagenes/Logos/carretilla.png"/></div>
        </div>
    </body>
</html>