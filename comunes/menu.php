<input type="hidden" id="nivelUsuario" value="<?php echo isset($_SESSION['nivel']) ? $_SESSION['nivel'] : ''; ?>">

<nav id="menu_top" class="navbar fixed-top">
    <div class="container-fluid">
        <button class="menu-hamburguesa" id="menu-hamburguesa" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="icon">
                <svg viewBox="0 0 175 80" width="40" height="40">
                    <rect width="80" height="15" fill="#f0f0f0" rx="10"></rect>
                    <rect y="30" width="80" height="15" fill="#f0f0f0" rx="10"></rect>
                    <rect y="60" width="80" height="15" fill="#f0f0f0" rx="10"></rect>
                </svg>
            </span>
            <span class="text">MENU</span>
        </button>

        <!-- <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->
        <h5 class="brand">Café Cardenal</h5><img id="logo" src="./img/logo1.png" alt="" style="height: 60px; width: 66px; filter: drop-shadow(0 2px 5px rgba(0, 0, 0, 0.7));">

        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="background: #962828; color:white;">
            <div class="offcanvas-header">
                <img id="logo" src="./img/logo1.png" alt="" style="height: 60px; width: 66px; filter: drop-shadow(0 2px 5px rgba(0, 0, 0, 0.7))">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel" style="color: white">Menú Principal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="menu">
                    <li class="active">
                        <a href="?pagina=inicio">
                            <p1 class="icon-home3"></p1>
                            <span>Inicio</span>
                        </a>
                    </li>

                    <li id="proveedor-lista">
                        <a href="?pagina=proveedor">
                            <p1 class="icon-users"></p1>
                            <span>Proveedores</span>
                        </a>
                    </li>
                    <li>
                        <a href="?pagina=materia_prima">
                            <p1 class="icon-truck"></p1>
                            <span>Materia prima</span>
                        </a>
                    </li>
                    <li>
                        <a href="?pagina=cafe_tostado">
                            <p1 class="icon-contrast"></p1>
                            <span>Café tostado</span>
                        </a>
                    </li>
                    <li>
                        <a href="?pagina=cafe_final">
                            <p1 class="icon-mug"></p1>
                            <span>Café Final</span>
                        </a>
                    </li>
                    <li>
                        <a href="?pagina=reporte">
                            <p1 class="icon-file-text2"></p1>
                            <span>Reportes</span>
                        </a>
                    </li>
                    <li id="usuario-lista">
                        <a href="?pagina=usuario">
                            <p1 class="icon-user-tie"></p1>
                            <span>Usuarios</span>
                        </a>
                    </li>
                    <li class="logout">
                        <a href="?pagina=logout">
                            <p1 class="icon-reply1"></p1>
                            <span>Salir</span>
                        </a>
                    </li>
                </ul>
                </ul>

            </div>
        </div>
    </div>
</nav>