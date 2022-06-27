<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Menú Principal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link href="../home.css" rel="stylesheet">
  </head>
  <body class="text-center">  
<?php
    include "../../init_meedo.php";
    session_start();
    if(empty($_SESSION['id'])){
        echo "<div class='cover-container d-flex h-100 p-3 mx-auto flex-column'>";

        echo "<header class='masthead mb-auto'>";
          echo "<div class='inner'>";
          echo "</div>";
        echo "</header>";

        echo "<main role='main' class='inner cover'>";
          echo "<h1 class='cover-heading'>Inicie sesión por favor...</h1>";
          echo "<br>";
          echo "<p class='lead'>";
            echo "<a href='../../login/login.php' class='btn btn-lg btn-primary btn-block'><i class='bi bi-box-arrow-in-right'></i>  Iniciar sesión</a>";
          echo "</p>";
        echo "</main>";

        echo "<footer class='mastfoot mt-auto'>";
          echo "<div class='inner'>";
          echo "<p>By Gabriel Vázquez, Jaime Abad y Antonio Lozano.</p>";
          echo "</div>";
        echo "</footer>";
      
      echo "</div>";

      exit();

    }

    $cod_asig = $_GET['cod_asig'];

    $database->delete("alum_tarea", 
        ["cod_asig" => $cod_asig]
    );

    $database->delete("tarea", 
        ["cod_asig" => $cod_asig]
    );

    $database->delete("curso_asig", 
        ["cod_asig" => $cod_asig]
    );

    $database->delete("alumn_asig", 
        ["cod_asig" => $cod_asig]
    );

    $database->delete("asignatura", 
        ["cod_asig" => $cod_asig]
    );

    //header("Location: asignaturas.php");
    echo '<script type="text/javascript">alert("Borrado con exito");
    window.location.href="asignaturas.php";</script>';
    

?>

<script>
        function confirmation(){
            
        //alert("Borrado con exito");
        window.location.href="asignaturas.php";
            
        }
        </script>
              <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>