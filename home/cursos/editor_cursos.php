<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Menu Principal</title>
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
        
        $cod_curso = $_GET['cod_curso'];

        // Si el dato es -1, muestro la insercción de cursos por defecto.
        if($cod_curso == -1){
          echo "<div class='cover-container d-flex h-100 p-3 mx-auto flex-column'>";

            echo "<header class='masthead mb-auto'>";
              echo "<div class='inner'>";
                echo "<h3 class='masthead-brand'>PRINCIPAL</h3>";
                echo "<nav class='nav nav-masthead justify-content-center'>";
                  echo "<a class='nav-link' href='../home.php'>Home</a>";
                  echo "<a class='nav-link active' href='cursos.php'>Cursos</a>";
                  echo "<a class='nav-link' href='../asignaturas/asignaturas.php'>Asignaturas</a>";
                  echo "<a class='nav-link' href='../tareas/tareas.php'>Tareas</a>";
                  echo "<p class='nav-link'> | </p>";
                  echo "<a href='../cerrar.php' class='nav-link'>Cerrar sesión</a>";
                echo "</nav>";
              echo "</div>";
            echo "</header>";

            echo "<main role='main' class='inner cover'>";
              echo "<form class='form-signin' action='insert_data.php' method='POST'>";
                 echo "<h1 class='h3 mb-3 font-weight-normal'>NUEVO CURSO</h1>";
                 echo "<input name='n_centro' type='text' class='form-control' placeholder='Nombre del centro' required autofocus>";
                 echo "<input name='anio_ini' type='text' class='form-control' placeholder='Año de inicio' required autofocus>";
                 echo "<input name='anio_fin' type='text' class='form-control' placeholder='Año de finalizacion' required autofocus>";
                 echo "<input name='descript' type='text' class='form-control' placeholder='Descripcion' required autofocus>";
                 echo "<input name='cod_curso' type='hidden'value=-1>";
                 echo "<button name='insert_curso' class='btn btn-lg btn-primary btn-block' type='submit'><i class='bi bi-plus-circle'></i> Añadir</button>";
               echo "</form>";
            echo "</main>";

            echo "<footer class='mastfoot mt-auto'>";
              echo "<div class='inner'>";
              echo "<p>By Gabriel Vázquez, Jaime Abad y Antonio Lozano.</p>";
              echo "<p class='mt-5 mb-3 text-muted'>&copy; 2021-2022</p>";
              echo "</div>";
            echo "</footer>";

          echo "</div>";

         
        // Si devuelvo un codigo curso para editar...
        }else{
            $curso_data = $database->select("curso","*",
                ['cod_curso' => $cod_curso]
            );

            echo "<div class='cover-container d-flex h-100 p-3 mx-auto flex-column'>";

              echo "<header class='masthead mb-auto'>";
                echo "<div class='inner'>";
                  echo "<h3 class='masthead-brand'>PRINCIPAL</h3>";
                  echo "<nav class='nav nav-masthead justify-content-center'>";
                    echo "<a class='nav-link' href='../home.php'>Home</a>";
                    echo "<a class='nav-link active' href='cursos.php'>Cursos</a>";
                    echo "<a class='nav-link' href='../asignaturas/asignaturas.php'>Asignaturas</a>";
                    echo "<a class='nav-link' href='../tareas/tareas.php'>Tareas</a>";
                    echo "<p class='nav-link'> | </p>";
                    echo "<a href='../cerrar.php' class='nav-link'>Cerrar sesión</a>";
                  echo "</nav>";
                echo "</div>";
              echo "</header>";

              echo "<main role='main' class='inner cover'>";
                echo "<form class='form-signin' action='insert_data.php' method='POST'>";
                  echo "<h1 class='h3 mb-3 font-weight-normal'>EDITAR CURSO</h1>";
                  echo "<input name='n_centro' type='text' value='".$curso_data[0]["nom_centro"]."' class='form-control' placeholder='Nombre del centro' required autofocus>";
                  echo "<input name='anio_ini' type='text' value='".$curso_data[0]["anio_ini"]."' class='form-control' placeholder='Año de inicio' required autofocus>";
                  echo "<input name='anio_fin' type='text' value='".$curso_data[0]["anio_fin"]."' class='form-control' placeholder='Año de finalizacion' required autofocus>";
                  echo "<input name='descript' type='text' value='".$curso_data[0]["descript_curso"]."' class='form-control' placeholder='Descripcion' required autofocus>";
                  echo "<input name='cod_curso' type='hidden' value='".$curso_data[0]["cod_curso"]."'>";
                  echo "<button name='insert_curso' class='btn btn-lg btn-primary btn-block' type='submit'><i class='bi bi-upload'></i> Actualizar</button>";
                echo "</form>";
              echo "</main>";

              echo "<footer class='mastfoot mt-auto'>";
                echo "<div class='inner'>";
                echo "<p>By Gabriel Vázquez, Jaime Abad y Antonio Lozano.</p>";
                  echo "<p class='mt-5 mb-3 text-muted'>&copy; 2021-2022</p>";
                echo "</div>";
              echo "</footer>";

            echo "</div>";
        }
    ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
  
</html>