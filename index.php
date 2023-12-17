<?php
require_once('database.php');
session_start();

// Verificar si el usuario está autenticado
$authUsuario = isset($_SESSION['authUsuario']) ? $_SESSION['authUsuario'] : false;

// Variable de sesión para almacenar el estado de autenticación del usuario
$_SESSION['authUsuario'] = $authUsuario;

// Verificar el rol del usuario autenticado
$rolUsuario = $authUsuario && isset($_SESSION['rolUsuario']) ? $_SESSION['rolUsuario'] : '';

// Variable de sesión para almacenar el rol del usuario
$_SESSION['rolUsuario'] = $rolUsuario;

?>
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
  <!-- Header navigation -->
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
          <!-- Navigation items... -->
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

    <!-- Display the "Agregar Evento" button based on user role -->
    <?php
    if ($authUsuario && $rolUsuario === "admin")  
    ?>
      <button id="agregarEventoBtn" class="button2 type1" data-bs-toggle="modal" data-bs-target="#modalCRUD">Agregar Eventos</button>
      <button id="crudEventosBtn" class="button3 type2" onclick="window.location.href='tablaAdmin.php'">Crud Eventos</button>
    <?php

    //   echo'  <button type="button" id="loginBtn" data-bs-toggle="modal" data-bs-target="#modalLogin">
    //     <svg height="36px" width="36px" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
    //         <rect fill="#fdd835" y="0" x="0" height="36" width="36"></rect>
    //         <path d="M38.67,42H11.52C11.27,40.62,11,38.57,11,36c0-5,0-11,0-11s1.44-7.39,3.22-9.59 c1.67-2.06,2.76-3.48,6.78-4.41c3-0.7,7.13-0.23,9,1c2.15,1.42,3.37,6.67,3.81,11.29c1.49-0.3,5.21,0.2,5.5,1.28 C40.89,30.29,39.48,38.31,38.67,42z" fill="#e53935"></path>
    //         <path d="M39.02,42H11.99c-0.22-2.67-0.48-7.05-0.49-12.72c0.83,4.18,1.63,9.59,6.98,9.79 c3.48,0.12,8.27,0.55,9.83-2.45c1.57-3,3.72-8.95,3.51-15.62c-0.19-5.84-1.75-8.2-2.13-8.7c0.59,0.66,3.74,4.49,4.01,11.7 c0.03,0.83,0.06,1.72,0.08,2.66c4.21-0.15,5.93,1.5,6.07,2.35C40.68,33.85,39.8,38.9,39.02,42z" fill="#b71c1c"></path>
    //         <path d="M35,27.17c0,3.67-0.28,11.2-0.42,14.83h-2C32.72,38.42,33,30.83,33,27.17 c0-5.54-1.46-12.65-3.55-14.02c-1.65-1.08-5.49-1.48-8.23-0.85c-3.62,0.83-4.57,1.99-6.14,3.92L15,16.32 c-1.31,1.6-2.59,6.92-3,8.96v10.8c0,2.58,0.28,4.61,0.54,5.92H10.5c-0.25-1.41-0.5-3.42-0.5-5.92l0.02-11.09 c0.15-0.77,1.55-7.63,3.43-9.94l0.08-0.09c1.65-2.03,2.96-3.63,7.25-4.61c3.28-0.76,7.67-0.25,9.77,1.13 C33.79,13.6,35,22.23,35,27.17z" fill="#212121"></path>
    //         <path d="M17.165,17.283c5.217-0.055,9.391,0.283,9,6.011c-0.391,5.728-8.478,5.533-9.391,5.337 c-0.913-0.196-7.826-0.043-7.696-5.337C9.209,18,13.645,17.32,17.165,17.283z" fill="#01579b"></path>
    //         <path d="M40.739,37.38c-0.28,1.99-0.69,3.53-1.22,4.62h-2.43c0.25-0.19,1.13-1.11,1.67-4.9 c0.57-4-0.23-11.79-0.93-12.78c-0.4-0.4-2.63-0.8-4.37-0.89l0.1-1.99c1.04,0.05,4.53,0.31,5.71,1.49 C40.689,24.36,41.289,33.53,40.739,37.38z" fill="#212121"></path>
    //         <path d="M10.154,20.201c0.261,2.059-0.196,3.351,2.543,3.546s8.076,1.022,9.402-0.554 c1.326-1.576,1.75-4.365-0.891-5.267C19.336,17.287,12.959,16.251,10.154,20.201z" fill="#81d4fa"></path>
    //         <path d="M17.615,29.677c-0.502,0-0.873-0.03-1.052-0.069c-0.086-0.019-0.236-0.035-0.434-0.06 c-5.344-0.679-8.053-2.784-8.052-6.255c0.001-2.698,1.17-7.238,8.986-7.32l0.181-0.002c3.444-0.038,6.414-0.068,8.272,1.818 c1.173,1.191,1.712,3,1.647,5.53c-0.044,1.688-0.785,3.147-2.144,4.217C22.785,29.296,19.388,29.677,17.615,29.677z M17.086,17.973 c-7.006,0.074-7.008,4.023-7.008,5.321c-0.001,3.109,3.598,3.926,6.305,4.27c0.273,0.035,0.48,0.063,0.601,0.089 c0.563,0.101,4.68,0.035,6.855-1.732c0.865-0.702,1.299-1.57,1.326-2.653c0.051-1.958-0.301-3.291-1.073-4.075 c-1.262-1.281-3.834-1.255-6.825-1.222L17.086,17.973z" fill="#212121"></path>
    //         <path d="M15.078,19.043c1.957-0.326,5.122-0.529,4.435,1.304c-0.489,1.304-7.185,2.185-7.185,0.652 C12.328,19.467,15.078,19.043,15.078,19.043z" fill="#e1f5fe"></path>
    //     </svg>
    //     <span class="now">now!</span>
    //     <span class="play">LOGIN</span>
    //     </button>'
      
    // ?>
  </nav>

    <!-- Modal para iniciar sesión -->
    <div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Iniciar Sesión</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Formulario para iniciar sesión -->
            <form id="loginForm" action="login.php" method="post">
              <!-- Campos del formulario -->
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
            <form id="agregarEventoForm" enctype="multipart/form-data" method="post" action="eventos.php">
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

            <div id="editModal" class="modal">
                            <!-- Formulario para editar evento -->
                <form id="editarEventoForm" class="d-none" enctype="multipart/form-data" method="post"
                    action="eventos.php">
                    <input type="hidden" id="editEventoId" name="editarEvento">
                    <div class="mb-3">
                        <label for="editImagenEvento" class="form-label">Nueva Imagen del Evento:</label>
                        <input type="file" class="form-control" id="editImagenEvento" name="imagenEvento" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="editNombreEvento" class="form-label">Nombre del Evento:</label>
                        <input type="text" class="form-control" id="editNombreEvento" name="nombreEvento" required>
                    </div>
                    <div class="mb-3">
                        <label for="editFechaEvento" class="form-label">Fecha del Evento:</label>
                        <input type="date" class="form-control" id="editFechaEvento" name="fechaEvento" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDescripcionEvento" class="form-label">Descripción del Evento:</label>
                        <textarea class="form-control" id="editDescripcionEvento" name="descripcionEvento" rows="4"
                            required></textarea>
                    </div>
                    <button type="button" id="saveEditBtn" class="btn btn-success">Guardar Cambios</button>
              </form>
              </div>
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
      <div id="eventosContainer" class="mt-4 mb-4"></div>
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