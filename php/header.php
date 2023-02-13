<header>
        <div class="container">

            <div class="infoPag">
                <a href="index.php">
                    <img src="imagenes/Header/Logo.svg" />
                    BricoTeis SL
                </a>
            </div>

            <div class="buscador">
                <form action="search.php" method="get">
                    <div class="cajaTexto">
                        <form action="search.php" method="get">
                            <div class="cajaTexto">
                                <input type="text" name="query" name="query" placeholder="Buscar...">
                                <button type="submit">Buscar</button>
                            </div>
                        </form>
                    </div>
                </form>
            </div>
            <div class="menuPers">
                <?php if (!isset($_SESSION['correo'])) {
                    echo '
                     <div class="cuenta"><img src="imagenes/Header/01Menu/user.svg" />Mi cuenta
                         <div class="submenu">
                             <div class="subdiv"><a href="php/registro.php"><img src="imagenes/Header/01Menu/register.svg" /><div class="subText">Registrarse</div></a>
                             </div>
                             <div class="subdiv"><a href="php/login.php"><img src="imagenes/Header/01Menu/entrance.svg" /><div class="subText">Iniciar Sesión</div></div></a>
                         </div>
                     </div>
                     <div><a href="#"><img src="imagenes/Header/01Menu/heart.svg" />Favoritos</a></div>
                     <div><a href="#"><img src="imagenes/Header/01Menu/shopping-cart.svg" />Carrito</a></div>
                 </div>';
                } else {
                    echo '<div class="cuenta"><a href="#"></a><img src="imagenes/Header/01Menu/user.svg" />' . $_SESSION['correo'] . '
                    <div class="submenu">
                        <div class="subdiv"><a href="php/perfil.php"><img src="imagenes/Header/01Menu/edit.svg" /><div class="subText">Editar Perfil</div></a>
                        </div>
                        <div class="subdiv"><a href="php/logout.php"><img src="imagenes/Header/01Menu/exit.svg" /><div class="subText">Cerrar Sesión</div> ';

                    echo '</div></a>
                    </div>
                </div>
                <div><a href="#"></a><img src="imagenes/Header/01Menu/heart.svg" />Favoritos</div>
                <div><a href="#"></a><img src="imagenes/Header/01Menu/shopping-cart.svg" />Carrito</div>'
                    ;

                } ?>

            </div>
    </header>