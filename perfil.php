<?php
session_start();

if (!isset($_SESSION['id'])) {
    // Usuario no autenticado, redirigir al inicio de sesión
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prueba";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$idUsuario = $_SESSION['id'];
$query = "SELECT * FROM usuarios WHERE id = $idUsuario";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombreUsuario = $row['first_name'];
    $last_name = $row['last_name'];
    $email = $row['email'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="img/logo.png">

    <title>RecSys</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
    <link href="css/perfil.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Incluye Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <!-- Incluye Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/144e03a4af.js" crossorigin="anonymous"></script>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background-image: url(img/4.jpg);background-size: 100% 100%; background-attachment: fixed; visibility: visible;">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon "><br>
                    <img class="mt-4" src="img/logo.png" height="120PX" width="130px">
                </div>
                <div class="sidebar-brand-text mx-3"><sup></sup></div>
            </a><br>
            <br>
            

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-hand-holding-water"></i>
                    <span>Panel de Control</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Secciones
            </div>

            <!-- Nav Item - Pages Collapse Menu -->

            <?php
            // Verificar el rol del usuario

                if (isset($_SESSION['rol'])) {
                    // Si el usuario ha iniciado sesión, mostrar las opciones según su rol
                    if ($_SESSION['rol'] === 'ejecutivo' || $_SESSION['rol'] === 'general') {
                        // Mostrar opciones para administrador
                        echo '

                            <li class="nav-item">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fa-solid fa-coins"></i>
                                    <span>Administración y <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Finanzas</span>
                                </a>
                                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
                                    <div class="bg-white py-2 collapse-inner rounded">
                                        <h6 class="collapse-header">Datos Generales:</h6>
                                        <a class="collapse-item" href="actas.php">Actas de sesiones</a>
                                        <a class="collapse-item" href="documentos.php">Docuemntos de finanzas</a>
                                        <a class="collapse-item" href="listado_socios.php">Socios AIA</a>
                                        <a class="collapse-item" href="mantenedor_socios.php">Mantenedor Socios</a>
                                        <a class="collapse-item" href="baja_socios.php">Listado de Baja-socios</a>
                                        
                                    </div>
                                </div>
                            </li>';
                                    
                                } elseif ($_SESSION['rol'] === 'visualizador') {
                                    
                                }
                                
                    }
            ?>
            
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-fw fa-person-booth"></i>
                    <span>Personal</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Datos Generales:</h6>
                        <a class="collapse-item" href="listado-personal.php">Información del Personal</a>
                        <a class="collapse-item" href="nuevo_personal.php">Ingreso nuevo Personal</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-people-carry"></i>
                    <span>Comité Paritario</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Información Actual:</h6>
                        <a class="collapse-item" href="comite.php">Personal Vigente</a>
                        <a class="collapse-item" href="reuniones.php">Reuniones</a>
                        <a class="collapse-item" href="extintores2.php">C. Extintores</a>
                        <a class="collapse-item" href="monitores.php">Monitores Emer.</a>
                        <a class="collapse-item" href="simulacros.php">Registro simulacro.</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSix"
                    aria-expanded="true" aria-controls="collapseSix">
                    <i class="fa-solid fa-arrow-right"></i>
                    <span>Permisos ADM</span>
                </a>
                <div id="collapseSix" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Opciones:</h6>
                        <a class="collapse-item" href="solicitudes.php">Permisos ADM</a>
                        <a class="collapse-item" href="mis_solicitudes.php">Mis permisos</a>
                        <?php
                        // Verificar el rol del usuario

                        if (isset($_SESSION['rol'])) {
                            // Si el usuario ha iniciado sesión, mostrar las opciones según su rol
                            if ($_SESSION['rol'] === 'admin' || $_SESSION['rol'] === 'ejecutivo' || $_SESSION['rol'] === 'general') {
                                // Mostrar opciones para administrador
                                echo '<a class="collapse-item" href="VistaSolicitudes.php">Permisos Internos</a>
                                <a class="collapse-item" href="aprueba.php">Aprovar permiso</a>
                                <a class="collapse-item" href="mantenedorJefe.php">Mantenedor Jefaturas</a>';
                                
                            } elseif ($_SESSION['rol'] === 'visualizador') {
                                
                            }
                            
                        }
                        ?>

                    </div>
                </div>
            </li>
            
            <?php
            // Verificar el rol del usuario

            if (isset($_SESSION['rol'])) {
                // Si el usuario ha iniciado sesión, mostrar las opciones según su rol
                if ($_SESSION['rol'] === 'admin' || $_SESSION['rol'] === 'ejecutivo' || $_SESSION['rol'] === 'general') {
                    // Mostrar opciones para administrador
                    echo '<li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                                aria-expanded="true" aria-controls="collapseThree">
                                <i class="fas fa-fw fa-network-wired"></i>
                                <span>Inventario</span>
                            </a>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h6 class="collapse-header">Opciones de Inventario</h6>
                                    <a class="collapse-item" href="Nuevo-Producto.php">Ingreso Inventario</a>
                                    <a class="collapse-item" href="Listado-productos.php">Listado Inventario</a>
                                    <a class="collapse-item" href="Listado-bajas.php">Listado Bajas</a>
                                    <a class="collapse-item" href="listados.php">Información Adicional</a>
                                    <a class="collapse-item" href="#collapseMantenedor" data-toggle="collapse" aria-expanded="false">
                                        <span>Mantenedor</span>
                                        <span class="arrow"><i class="fas fa-angle-down"></i></span>
                                    </a>
                                    <div class="collapse" id="collapseMantenedor">
                                        <a class="collapse-item" href="mantenedor.php">Mantenedor Equipos</a>
                                        <a class="collapse-item" href="mantenedor_dis.php">Mantenedor dispositivos</a>
                                        <a class="collapse-item" href="mantenedor_soft.php">Mantenedor Software</a>
                                        <a class="collapse-item" href="mantenedor_extintores.php">Mantenedor Extintores</a>
                                    <a class="collapse-item" href="mantenedor_monitores.php">Mantenedor Monitores</a>
                                    </div>
                                </div>
                            </div>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
                                aria-expanded="true" aria-controls="collapseFour">
                                <i class="fa-brands fa-creative-commons-nd"></i>
                                <span>Mantenciones</span>
                            </a>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h6 class="collapse-header">Listado de Mantenciones:</h6>
                                    <a class="collapse-item" href="mantenciones.php">Listado de Mantenciones</a>
                                    <a class="collapse-item" href="#">Programar Mantención</a>
                                </div>
                            </div>
                        </li>';
                } elseif ($_SESSION['rol'] === 'visualizador') {
                    
                }
                
            }
            ?>


            <!-- Divider -->
            <hr class="sidebar-divider"><br>
            <br>

            <?php
            if (isset($_SESSION['rol'])) {
                // Si el usuario ha iniciado sesión, mostrar las opciones según su rol
                if ($_SESSION['rol'] === 'admin' || $_SESSION['rol'] === 'ejecutivo' || $_SESSION['rol'] === 'general') {
                    // Mostrar opciones para administrador
                    echo'<div class="sidebar-heading">
                        Administración
                    </div>';
                } elseif ($_SESSION['rol'] === 'visualizador') {
                    echo'<div class="sidebar-heading">
                    Que tengas un lindo día!!!
                    </div>' ;    
                }
                
            }
            ?>

            <?php
            // Verificar el rol del usuario

            if (isset($_SESSION['rol'])) {
                // Si el usuario ha iniciado sesión, mostrar las opciones según su rol
                if ($_SESSION['rol'] === 'admin' || $_SESSION['rol'] === 'ejecutivo' || $_SESSION['rol'] === 'general') {
                    // Mostrar opciones para administrador
                    echo '<li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                            aria-expanded="true" aria-controls="collapseUtilities">
                            <i class="fas fa-fw fa-wrench"></i>
                            <span>Usuarios</span>
                        </a>
                        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Custom Utilities:</h6>
                                <a class="collapse-item" href="usuarios.php">Usuarios</a>
                                <a class="collapse-item" href="comentarios.php">Comentarios</a>
                                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                                <a class="collapse-item" href="utilities-other.html">Other</a>
                            </div>
                        </div>
                    </li>';
                } elseif ($_SESSION['rol'] === 'visualizador') {
                            
                }
                
            }
            ?>

            

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" style="background-image: url(img/Abstract_background_15.jpg);background-size: 100% 100%; background-attachment: fixed; visibility: visible;">

            <!-- Main Content -->
            <div id="content" >

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style="background-image: url(img/Abstract_background_15.jpg);background-size: 100% 100%; background-attachment: fixed; visibility: visible;">


                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                

                    
                    
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Agregar imágenes responsivas -->
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.sistemasicep.cl" target="_blank">
                                <img src="img/Marca-AIA.png" class="img-fluid" alt="Imagen 1" style="width: 90px; height: 55px;">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.aia.cl" target="_blank">
                                <img src="img/aia.png" class="img-fluid" alt="Imagen 2" style="width: 130px; height: 55px;">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.exponor.cl" target="_blank">
                                <img src="img/exponor.png" class="img-fluid" alt="Imagen 3" style="width: 120px; height: 55px;">
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="https://www.codetia.cl" target="_blank">
                                <img src="img/codetia2.png" class="img-fluid" alt="Imagen 3" style="width: 80px; height: 55px;">
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>
                        

                        <!-- Nav Item - User Information -->
                        <?php include 'navbar.php'; ?>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Administrador de Perfil</h1>

                    <div class="row">

                        <div class="col-lg-12">

                            <!-- Circle Buttons -->
                            
                            <div class="card shadow mb-4" style="background-image: url(img/5.jpg);background-size: 100% 100%; background-attachment: fixed; visibility: visible;">
                                <div class="card-header py-3" style="background-color: transparent;">
                                    <h6 class="m-0 font-weight-bold text-primary">Tus Datos son:</h6>
                                </div>
                                <div class="container mt-5" >
                                    <?php
                                    if (isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])) {
                                        $nombreUsuario = $_SESSION['usuario'];
                                        $rutaImagenCompleta = $_SESSION['imagen_perfil'];
                                        $last_name = $_SESSION['last_name'];
                                        $email = $_SESSION['email'];
                                    } else {
                                        $nombreUsuario = "Usuario";
                                        $rutaImagenCompleta = "img/fotos/default.jpg";
                                        $last_name = "";
                                        $email = "";
                                    }
                                    ?>

                                    <h2 style="color:white;">Bienvenido: <?php echo $nombreUsuario; ?></h2><br>

                                    <div class="profile-container" >
                                        <img class="profile-image" src="<?php echo $rutaImagenCompleta; ?>" alt="Imagen de perfil"><br>
                                        <!-- Agrega este botón para abrir el modal -->
                                        <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#cambiarImagenModal">
                                            Cambiar Imagen de Perfil
                                        </button>

                                        <!-- Modal para cambiar imagen de perfil -->
                                        <div class="modal fade" id="cambiarImagenModal" tabindex="-1" role="dialog" aria-labelledby="cambiarImagenModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="cambiarImagenModalLabel">Cambiar Imagen de Perfil</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="profile-container">
                                                            <img class="profile-image" src="<?php echo $rutaImagenCompleta; ?>" alt="Imagen de perfil"><br>
                                                            <form action="cambiar_imagen.php" method="post" enctype="multipart/form-data">
                                                                <div class="form-group">
                                                                    <label for="nuevaImagen">Seleccionar Nueva Imagen:</label>
                                                                    <input type="file" class="form-control-file" id="nuevaImagen" name="nuevaImagen" accept="image/*" required>
                                                                </div><br>
                                                                <br>
                                                                <button type="submit" class="btn btn-primary mt-3">Subir Nueva Imagen</button>
                                                            </form>
                                                        </div><br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>

                                </div>
                            </div>

                            <div class="row">
                                <!-- Primer bloque de comentarios -->
                                <div class="col-md-6">
                                    <div class="comments-container">
                                        <h2>Mis Sugerencias </h2>
                                        <?php
                                        $servername = "localhost";
                                        $username = "root";
                                        $password_bd = "";
                                        $database = "prueba";

                                        $conn = new mysqli($servername, $username, $password_bd, $database);

                                        if ($conn->connect_error) {
                                            die("Error en la conexión a la base de datos: " . $conn->connect_error);
                                        }

                                        if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
                                            $id_usuario = $_SESSION['id'];

                                            $query = "SELECT comentario, fecha_creacion FROM comentarios WHERE id_usuario = $id_usuario";
                                            $result = $conn->query($query);

                                            if ($result) {
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        $comentario = $row['comentario'];
                                                        $fecha_creacion = $row['fecha_creacion'];
                                                        echo '<div class="comment">';
                                                        echo '<p><strong>Comentario:</strong> ' . $comentario . '</p>';
                                                        echo '<p><strong>Fecha:</strong> ' . $fecha_creacion . '</p>';
                                                        echo '</div>';
                                                    }
                                                } else {
                                                    echo '<p>Aún no hay comentarios para mostrar.</p>';
                                                }
                                            } else {
                                                echo "Error en la consulta: " . $conn->error;
                                            }
                                        } else {
                                            echo "ID de usuario no definido en la sesión.";
                                        }

                                        $conn->close();
                                        ?>
                                        <!-- Columna de agregar comentario -->
                                        <div class="col-md-6"><br>
                                       
                                            <h2>Agregar Sugerencia para el sistema</h2><br>
                                         
                                            <!-- Botón para abrir el modal -->
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarComentarioModal">
                                                Crear un nuevo comentario
                                            </button>

                                            <!-- Modal para agregar nuevo comentario -->
                                            <div class="modal fade" id="agregarComentarioModal" tabindex="-1" role="dialog" aria-labelledby="agregarComentarioModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="agregarComentarioModalLabel">Agregar Nuevo Comentario</h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="formAgregarComentario" action="agregar_comentario.php" method="post">
                                                                <div class="form-group">
                                                                    <label for="nuevoComentario">Nuevo Comentario</label>
                                                                    <textarea class="form-control" id="nuevoComentario" name="comentario" rows="4" cols="50" required></textarea>
                                                                </div>
                                                                <button type="submit" class="btn btn-success">Agregar Comentario</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="col-md-6">
                                    <div class="comments-container2">
                                        <?php
                                        $servername = "localhost";
                                        $username = "root";
                                        $password = "";
                                        $dbname = "prueba";
                                       
                                        $usuarioLogeadoId = $_SESSION['id']; // Cambia esto según cómo almacenes el ID en la sesión

                                        $conn = new mysqli($servername, $username, $password, $dbname);
                                        if ($conn->connect_error) {
                                            die("Conexión fallida: " . $conn->connect_error);
                                        }

                                        $query = "SELECT first_name, last_name, email, password FROM usuarios WHERE id = $usuarioLogeadoId";
                                        $result = $conn->query($query);

                                        if ($result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                        ?>
                                        <h2>Mis Datos internos</h2>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <table class="table table-striped">
                                                    <tr>
                                                        <th scope="row">Nombre:</th>
                                                        <td><?php echo $row['first_name']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">apellido:</th>
                                                        <td><?php echo $row['last_name']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Email:</th>
                                                        <td><?php echo $row['email']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Contraseña Actual:</th>
                                                        <td><?php echo $row['password']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <button type="button" class="btn btn-primary btn-sm " data-toggle="modal" data-target="#modificarUsuarioModal<?php echo $usuarioLogeadoId; ?>" data-id="<?php echo $usuarioLogeadoId; ?>">Modificar</button>
                                                            <a href="#" class="btn btn-info btn-sm">Correcto!</a>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <!-- Resto del código del modal -->
                                            </div>
                                        </div>
                                        <?php
                                        } else {
                                            echo "No se encontraron datos del usuario.";
                                        }
                                        $conn->close();
                                        ?>
                                  

                                            
                                        <!-- Modal para modificar usuario -->
                                        <?php
                                        $conn_modal = new mysqli($servername, $username, $password, $dbname);
                                        if ($conn_modal->connect_error) {
                                            die("Conexión fallida: " . $conn_modal->connect_error);
                                        }

                                        $query_modal = "SELECT id, usuario, email, password FROM usuarios";
                                        $result_modal = $conn_modal->query($query_modal);

                                        while ($row_modal = $result_modal->fetch_assoc()) {
                                            $usuario_id = $row_modal['id'];
                                            echo '<div class="modal fade" id="modificarUsuarioModal' . $usuario_id . '" tabindex="-1" role="dialog" aria-labelledby="modificarUsuarioModalLabel' . $usuario_id . '" aria-hidden="true">';
                                            echo '<div class="modal-dialog" role="document">';
                                            echo '<div class="modal-content">';
                                            echo '<div class="modal-header">';
                                            echo '<h5 class="modal-title" id="modificarUsuarioModalLabel' . $usuario_id . '">Modificar Usuario</h5>';
                                            echo '<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">';
                                            echo '<span aria-hidden="true">&times;</span>';
                                            echo '</button>';
                                            echo '</div>';
                                            echo '<div class="modal-body">';
                                            echo '<form action="modificarUsuario.php" method="POST">';
                                            echo '<input type="hidden" name="id" value="' . $usuario_id . '">';
                                            echo '<div class="form-group">';
                                            echo '<label for="usuario">Usuario:</label>';
                                            echo '<input type="text" class="form-control" id="usuario" name="usuario" value="' . $row_modal['usuario'] . '">';
                                            echo '</div>';
                                            echo '<div class="form-group">';
                                            echo '<label for="email">Email:</label>';
                                            echo '<input type="email" class="form-control" id="email" name="email" value="' . $row_modal['email'] . '">';
                                            echo '</div>';
                                            echo '<div class="form-group">';
                                            echo '<label for="password">Contraseña:</label>';
                                            echo '<input type="password" class="form-control" id="password" name="password" value="' . $row_modal['password'] . '">';
                                            echo '</div>';
                                            echo '<div class="modal-footer">';
                                            echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
                                            echo '<button type="submit" class="btn btn-primary">Guardar cambios</button>';
                                            echo '</div>';
                                            echo '</form>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                        $result_modal->close();
                                        $conn_modal->close();
                                        ?>
                                            
                                        
                                    </div>
                                </div>

                                <script>
                                    <?php
                                    $conn_modal = new mysqli($servername, $username, $password, $dbname);
                                    if ($conn_modal->connect_error) {
                                        die("Conexión fallida: " . $conn_modal->connect_error);
                                    }

                                    $result_modal = $conn_modal->query($query_modal);

                                    while ($row_modal = $result_modal->fetch_assoc()) {
                                        $usuario_id = $row_modal['id'];
                                        echo "$('#modificarUsuarioModal$usuario_id').on('show.bs.modal', function (event) {";
                                        echo "var button = $(event.relatedTarget);";
                                        echo "var idUsuario = button.data('id');";
                                        // ... (aquí puedes cargar los datos del usuario en los campos del formulario)
                                        echo "$('#idUsuarioModificar$usuario_id').val(idUsuario);";
                                        // ... (resto del script para los modales)
                                        echo "});";
                                    }
                                    $result_modal->close();
                                    $conn_modal->close();
                                    ?>
                                </script>


                                

                                
                            </div>

                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->
                <!-- Footer -->
                <footer class="sticky-footer bg-white" style="background-image: url(img/Abstract_background_15.jpg);background-size: 100% 100%; background-attachment: fixed; visibility: visible;">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span><img src="img/logo.png" style="width: 40px; height: 60px;">RecSys &copy; www.sicep.cl</span>
                        </div>
                    </div>
                </footer>

            </div>
            <!-- End of Main Content -->
           
            

        </div>
        <!-- End of Content Wrapper -->
        
        
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Esta seguro?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.</div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 


</body>

</html>