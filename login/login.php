<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    <!-- Custom styles for this template -->
    <link href="login.css" rel="stylesheet">
    </head>
    <body class="text-center">
        <form class="form-signin" action="login.php" method="POST">
            <h1 class="h3 mb-3 font-weight-normal">Inicio de sesión</h1>
                <input name="n_user" type="text" class="form-control" placeholder="Usuario" required autofocus>
                <input name="password" type="password" class="form-control" placeholder="Contraseña" required>
                <button class="btn btn-lg btn-primary btn-block" name="access_home" type="submit"><i class="bi bi-box-arrow-in-right"></i>  Iniciar sesión</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2021-2022</p>
        </form>

        <?php
            include "../init_meedo.php";

            if(isset($_POST["access_home"])){
                $n_user = $_POST['n_user'];
                $password = $_POST['password'];

                // Método que me permite la autentificación.
                login($database, $n_user, $password);
            }
            
            function login($database, $n_user, $password) {
                $pass_login = false;
                
                // SELECT contraseña FROM alumno WHERE nom_alum = $n_user; 
                $resultado = $database->select("alumno",[
                    "cod_alum",
                    "password"],
                    ['nom_alum' => $n_user]
                );

                if(empty($resultado)){
                    echo '<script>alert("No existe el usuario, inténtelo de nuevo.");</script>';
                }else{
                    if($resultado[0]["password"] == $password){
                        $pass_login = true;
                        $id_session_user = $resultado[0]["cod_alum"];
                    }

                    if($pass_login){
                        session_start();
                        $_SESSION['id'] = $id_session_user;
                        // Redirección a la página de home con la Id del usuario de la sesión actual.
                        header("Location: ../home/home.php");

                    }else{
                        echo '<script>alert("Contraseña errónea, inténtelo de nuevo.");</script>';
                    }
                }
                
            }
        ?>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>

</html>