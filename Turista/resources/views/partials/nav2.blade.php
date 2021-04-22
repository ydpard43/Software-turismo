	    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <ul class="navbar-nav">
            <!-- Avatar -->
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle d-flex align-items-center hidden-arrow"
                href="#"
                id="navbarDropdownMenuLink"
                role="button"
                data-mdb-toggle="dropdown"
                aria-expanded="false"
              >
              <button type="button" id="menu" class="btn btn-primary btn-lg btn-floating">
                <i class="fas fa-align-justify"></i></button>
              </a>
              <ul class="dropdown-menu text-center" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="perfil" ><img src="img/perfil.png"></a></li>
                  <li><a class="dropdown-item" href="pois" ><img src="img/marcador.png"></a></li>
                  <li><a class="dropdown-item" id="rt" ><img src="img/ruta.png"></a></li>
                  <li><a class="dropdown-item ocultar" id="rt1" href="nuevar" ><img class="icon2" src="img/mas.png"></a></li>
                  	@if(session()->has('nombre'))
                    <li><a class="dropdown-item ocultar" id="rt2" href="rutas" ><img class="icon2"  src="img/configuraciones.png"></a></li>
                    @endif
                    	@if(session()->has('nombre'))
                        <li><a class="dropdown-item" href="salir" ><img src="img/puerta.png"></a></li>
                        @else
                        <li><a class="dropdown-item" href="iniciar" ><img  src="img/entrar.png"></a></li>
                        @endif

              </ul>
            </li>
          </ul>
        </div>
    </nav>