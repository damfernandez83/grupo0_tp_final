<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tokyo Dori Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
  </head>
  <body>
    <!--header-->
    <nav id="header" class="navbar navbar-expand-lg sticky-top">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="./img/Logo-Web-Top.png" alt="Tokyodori logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#miembros">Sobre nosotros</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#next-event">Próximos eventos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#tiendas">Tiendas internacionales</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Portfolio
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="https://medibang.com/mpc/titles/d72212200440212290024395695/"
                    target="_blank">Erudami's Adventure</a></li>
                <li><a class="dropdown-item" href="https://medibang.com/mpc/titles/6t2308280231202630024395695/"
                    target="_blank">Meganeman</a></li>
                <li><a class="dropdown-item" href="https://dribbble.com/DamTorres" target="_blank">Diseño Gráfico</a></li>
                <li><a class="dropdown-item" href="https://www.artstation.com/tokyodori" target="_blank">Ilustraciones</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
      <!-- Modal de Login -->
      <div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLoginLabel">Iniciar Sesión</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <!-- Formulario de Login -->
              <form id="loginForm" action="login.php" method="post">
                <div class="mb-3">
                  <label for="username" class="form-label">Usuario:</label>
                  <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Contraseña:</label>
                  <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Botón para Abrir el Modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalLogin">
        Iniciar Sesión
      </button>
      
      <?php
      // Obtén el rol del usuario (puedes obtenerlo después de la autenticación)
      $rolUsuario = 'admin'; // Reemplaza esto con el rol real del usuario

      // Muestra el botón del CRUD solo si el usuario es un administrador
      if ($rolUsuario === 'admin') {
          echo '<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCRUD">Agregar Evento</button>';
      }
    ?>
    </nav>
    <!--main-->
    <main id="main">
      <div id="carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-pause="false">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="./img/carousel01.png" class="d-block w-100" alt="Erudami adventure">
          </div>
          <div class="carousel-item">
            <img src="./img/carousel02.png" class="d-block w-100" alt="Meganeman">
          </div>
          <div class="carousel-item">
            <img src="./img/carousel03.png" class="d-block w-100" alt="Skate girl">
          </div>
          <div class="carousel-item">
            <img src="./img/carousel04.png" class="d-block w-100" alt="molinetes de estación de tren japonesa">
          </div>
          <div class="overlay">
            <div class="container">
              <div class="row">
                <div class="col-md-6">
                  <h1>Bienvenido a la página de Tokyo Dori</h1>
                  <p>Ilustraciones de personajes originales, manga online, videojuegos (muy pronto) y tienda online.</p>
                  <a href="https://tokyodoristudio.empretienda.com.ar/" target="_blank" class="btn btn-outline-warning">Entrar a la tienda</a>
                  <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalMensaje">Pedí tu comisión</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Modal de CRUD -->
    <div class="modal fade" id="modalCRUD" tabindex="-1" aria-labelledby="modalCRUDLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCRUDLabel">Agregar Evento</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Formulario para agregar evento -->
            <form id="agregarEventoForm">
              <div class="mb-3">
                <label for="imagenEvento" class="form-label">Imagen del Evento:</label>
                <input type="file" class="form-control" id="imagenEvento" name="imagenEvento" accept="image/*" required>
              </div>
              <div class="mb-3">
                <label for="nombreEvento" class="form-label">Nombre del Evento:</label>
                <input type="text" class="form-control" id="nombreEvento" name="nombreEvento" required>
              </div>
              <div class="mb-3">
                <label for="fechaEvento" class="form-label">Fecha del Evento:</label>
                <input type="date" class="form-control" id="fechaEvento" name="fechaEvento" required>
              </div>
              <div class="mb-3">
                <label for="descripcionEvento" class="form-label">Descripción del Evento:</label>
                <textarea class="form-control" id="descripcionEvento" name="descripcionEvento" rows="4" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Agregar Evento</button>
            </form>

            <!-- Contenido del CRUD aquí -->
            <!-- Puedes agregar formularios similares para editar, eliminar, etc. -->
          </div>
        </div>
      </div>
    </div>
    <!--miembros-->
    <section id="miembros" class="mt-4 mb-4">
      <div class="container">
        <div class="row">
          <div class="col text-center text-uppercase">
            <h2 class="section-title">Sobre nosotros</h2>
          </div>
        </div>
        <div class="row justify-content-evenly">
          <div class="col-12 col-md-4 mb-2">
            <div class="card">
              <img src="./img/Dam300x300.jpg" class="card-img-top" alt="Imagen de Dam">
              <div class="card-body">
                <h5 class="card-title">Dam</h5>
                <p class="card-text">Ilustrador, diseñador gráfico y músico. Le gusta la pizza, la estética japonesa y las series Tokusatsu. Sus pasatiempos son dibujar y hacer música.</p>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-4 offset-md-1 mb-2">
            <div class="card">
              <img src="./img/Pri300x300.jpg" class="card-img-top" alt="Imagen de Pri">
              <div class="card-body">
                <h5 class="card-title">Pri</h5>
                <p class="card-text">Desarrolladora Front-end. Bueno, está estudiando todavía. Le gusta el chipá, el anime y los gatos. Sus pasatiempos son jugar videojuegos y cocinar.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--proximos eventos-->
    <section id="next-event" class="mt-4 mb-4">
      <div class="container-fluid">
        <div class="row">
          <div class="col text-center text-uppercase">
            <h2 class="section-title">Próximos eventos</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-md-6 ps-0 pe-0" id="eventos">
            <img src="./img/ilustrades2023.jpg" alt="logo de ilustrades">
          </div>
          <div class="col-12 col-md-6 pt-2 pb-2" id="eventos">
            <h2>
              Ilustrades - Noviembre 2023
            </h2>
            <p>
              Décima edición de Ilustrades, Feria de Ilustración y Arte Gráfico en todas sus formas. Estaremos presentes con nuestro arte original en stickers, posters y prints.
            </p>
            <a class="btn btn-outline-light" href="https://ilustrades.com/" target="_blank">Conoce más</a>
          </div>
        </div>
      </div>
    </section>
    <!--tiendas-->
    <section id="tiendas">
      <div class="container">
        <div class="row">
          <div class="col text-center text-uppercase">
            <h2 class="section-title">Nuestras tiendas internacionales</h2>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-12 col-md-4 mt-2">
            <div class="card border-warning">
              <div class="card-body">
                <div class="badges">
                  <span class="badge rounded-pill text-bg-success">Europe</span>
                </div>
                <a href="https://supergeek.de/en/tokyodoristudio/" class="card-link" target="_blank">Supergeek Store</a>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-4 mt-2">
            <div class="card border-warning">
              <div class="card-body">
                <div class="badges">
                  <span class="badge text-bg-danger">Australia & New Zealand</span>
                  <span class="badge text-bg-warning">Asia Pacific</span>
                </div>
                <a href="https://threadheads.com.au/collections/tokyo-dori-studio" class="card-link" target="_blank">Threadheads Store</a>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-4 mt-2">
            <div class="card border-warning">
              <div class="card-body">
                <div class="badges">
                  <span class="badge text-bg-primary">UK</span>
                  <span class="badge text-bg-success">Europe</span>
                  <span class="badge text-bg-info">USA & Canada</span>
                </div>
                <a href="https://threadheads.co.uk/collections/tokyo-dori-studio" class="card-link" target="_blank">Threadheads Store</a>
              </div>
            </div>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-12 col-md-4 mt-2">
            <div class="card border-warning">
              <div class="card-body">
                <div class="badges">
                  <span class="badge text-bg-info">USA & Canada</span>
                  <span class="badge text-bg-dark">Worldwide</span>
                </div>
                <a href="https://tokyodori.threadless.com/" class="card-link" target="_blank">Threadless Store</a>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-4 mt-2">
            <div class="card border-warning">
              <div class="card-body">
                <div class="badges">
                  <span class="badge text-bg-info">USA & Canada</span>
                  <span class="badge text-bg-dark">Worldwide</span>
                </div>
                <a href="https://www.redbubble.com/es/people/MoustacheRobot/shop" class="card-link" target="_blank">Redbubble Store</a>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-4 mt-2">
            <div class="card border-warning">
              <div class="card-body">
                <div class="badges">
                  <span class="badge text-bg-info">USA & Canada</span>
                  <span class="badge text-bg-dark">Worldwide</span>
                </div>
                <a href="https://www.teepublic.com/user/tokyodori" class="card-link" target="_blank">Teepublic Store</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--contactanos-->
    <section id="contactanos" class="mt-4 mb-4">
      <div class="container">
        <div class="row">
          <div class="col text-center text-uppercase">
            <h2 class="section-title">Charlemos</h2>
          </div>
        </div>
        <div class="row">
          <div class="col text-center">
            <p>Dejanos tus datos de contacto así podemos hacerte el presupuesto.</p>
          </div>
        </div>
        <form class="row">
          <div class="form-label col-12 col-md-4">
            <input type="text" class="form-control" placeholder="Nombre" aria-label="Nombre">
          </div>
          <div class="form-label col-12 col-md-4">
            <input type="text" class="form-control" placeholder="Email" aria-label="Email">
          </div>
          <div class="form-label col-12 col-md-4">
            <input type="text" class="form-control" placeholder="Telefono" aria-label="Telefono">
          </div>
        </form>
        <form class="row">
          <div class="form-label col">
            <textarea name="text" class="form-control" placeholder="Deja tu mensaje aqui"></textarea>
          </div>
        </form>
        <div class="row">
          <div class="col">
            <button type="button" class="btn btn-dark col-12">Enviar</button>
          </div>
        </div>
      </div>
    </section>
    <!--footer-->
    <footer id="footer" class="pb-4 pt-4">
        <div class="container">
            <div class="row text-center">
                <div class="col-12 col-lg">
                    <a href="https://www.facebook.com/tokyodoristudio" target="_blank">Facebook</a>
                </div>
                <div class="col-12 col-lg">
                    <a href="https://twitter.com/tokyodoristudio" target="_blank">Twitter</a>
                </div>
                <div class="col-12 col-lg">
                    <a href="https://www.behance.net/tokyodori" target="_blank">Behance</a>
                </div>
                <div class="col-12 col-lg">
                  <a href="https://www.instagram.com/tokyodoristudio" target="_blank">Instagram</a>
                </div>
            </div>
          </div>
    </footer>
    <!--modal-->
    <div class="modal fade" id="modalMensaje" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Comisión de Retrato</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <div class="row">
                  <div class="col">
                      <p>Podés pedir comisiones de tu retrato, tené en cuenta que cada pedido tiene un tiempo distinto de entrega.</p>
                  </div>
              </div>
              <div class="row">
                  <div class="col text-center">
                      <p class="fs-3 fw-semibold">VALOR DE COMISIÓN $2000</p>
                  </div>
              </div>
              <div class="row">
                  <div class="col">
                      <div class="card p-2 text-center border-danger">
                          <h5 class="card-title">Busto</h5>
                          <br>
                          <p class="card-text">30% descuento</p>
                      </div>
                  </div>
                  <div class="col">
                      <div class="card p-2 text-center border-info">
                          <h5 class="card-title">Medio <br>cuerpo</h5>
                          <p class="card-text">20% descuento</p>
                      </div>
                  </div>
                  <div class="col">
                      <div class="card p-2 text-center border-warning">
                          <h5 class="card-title">Cuerpo entero</h5>
                          <p class="card-text">Precio full</p>
                      </div>
                  </div>
              </div>
              <form class="row">
                  <div class="col-12 my-3">
                      <input type="text" class="form-control" placeholder="Nombre y apellido" aria-label="Nombre y apellido">
                  </div>
                  <div class="col-12 mb-3">
                      <input type="email" class="form-control" id="form-email" placeholder="Email" aria-label="Email">
                  </div>
                  <div class="col-12 col-md-6 mb-3">
                      <label class="visually-hidden" for="autoSizingSelect">Cantidad</label>
                      <input type="number" class="form-control" id="quantity-tickets" placeholder="Cantidad" aria-label="Cantidad">
                  </div>
                  <div class="col-12 col-md-6 mb-3">
                      <label class="visually-hidden" for="autoSizingSelect">Tipo de retrato</label>
                      <select class="form-select" id="discount-choice">
                          <option selected>Elegir</option>
                          <option value="0.3">Busto</option>
                          <option value="0.2">Medio cuerpo</option>
                          <option value="0">Cuerpo entero</option>
                      </select>
                  </div>
              </form>
              <div class="alert alert-info" id="final-price" role="alert">
                  Total: $
              </div>
              <div class="modal-footer">
                  <button type="reset" class="btn btn-secondary" id="reset-button">Borrar</button>
                  <button type="submit" class="btn btn-primary" id="confirm-button">Confirmar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

  <script src="./main.js"></script>
  </body>
</html>