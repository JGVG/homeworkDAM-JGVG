<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Menú Principal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <link href="../home.css" rel="stylesheet">
    <script src="jquery.min.js"></script>
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
      
        $cod_tarea = $_GET['cod_tarea'];
        $id_session_user = $_SESSION['id'];

        $resultado = $database->select("alumn_asig",[
          "cod_asig"],
          ['cod_alum' => $id_session_user]
        );
 
        // Si el dato es -1, muestro la insercción de asignaturas por defecto.
        if($cod_tarea == -1){

          echo "<div class='cover-container d-flex h-100 p-3 mx-auto flex-column'>";

            echo "<header class='masthead mb-auto'>";
              echo "<div class='inner'>";
                echo "<h3 class='masthead-brand'>PRINCIPAL</h3>";
                echo "<nav class='nav nav-masthead justify-content-center'>";
                  echo "<a class='nav-link' href='../home.php'>Home</a>";
                  echo "<a class='nav-link' href='../cursos/cursos.php'>Cursos</a>";
                  echo "<a class='nav-link' href='../asignaturas/asignaturas.php'>Asignaturas</a>";
                  echo "<a class='nav-link active' href='tareas.php'>Tareas</a>";
                  echo "<p class='nav-link'> | </p>";
                  echo "<a href='../cerrar.php' class='nav-link'>Cerrar sesión</a>";
                echo "</nav>";
              echo "</div>";
            echo "</header>";

            echo "<main role='main' class='inner cover'>";
              echo "<form class='form-signin' action='insert_data.php' method='POST'>";
                 echo "<h1 class='h3 mb-3 font-weight-normal'>NUEVA TAREA</h1>";
                 echo "<input name='nom_tarea' type='text' class='form-control' placeholder='Nombre tarea' required autofocus>";
                 echo "<select required class='form-control form-control-lg' style='height: 60px' name='cod_asig'>";
                  foreach ($resultado as $key => $row){
                    $asignatura_data = $database->select("asignatura","*",['cod_asig' => $row]);
                    foreach ($asignatura_data as $key => $row) {
                      echo "<option value='".$row["cod_asig"]."'>".$row["nom_asig"]."</option>";
                    }
                  }
                 echo "</select>";
                 echo "<input name='f_limite' type='datetime-local' class='form-control' required autofocus>";
                 echo "<input name='estado' type='hidden' value='Incompleto'>";
                 echo "<input name='descript_tarea' type='text' class='form-control' placeholder='Descripcion de la tarea' required autofocus>";
                 echo "<input name='cod_tarea' type='hidden'value=-1>";
                 echo "<button name='insert_tarea' class='btn btn-lg btn-primary btn-block' type='submit'><i class='bi bi-plus-circle'></i> Añadir</button>";
               echo "</form>";
            echo "</main>";

            echo "<footer class='mastfoot mt-auto'>";
              echo "<div class='inner'>";
              echo "<p>By Gabriel Vázquez, Jaime Abad y Antonio Lozano.</p>";
              echo "<p class='mt-5 mb-3 text-muted'>&copy; 2021-2022</p>";
              echo "</div>";
            echo "</footer>";

          echo "</div>";

         
        // Si devuelvo un codigo asignatura para editar...
        }else{
            $tarea_data = $database->select("tarea","*",['cod_tarea' => $cod_tarea]);
        
            echo "<div class='cover-container d-flex h-100 p-3 mx-auto flex-column'>";

              echo "<header class='masthead mb-auto'>";
                echo "<div class='inner'>";
                  echo "<h3 class='masthead-brand'>PRINCIPAL</h3>";
                  echo "<nav class='nav nav-masthead justify-content-center'>";
                    echo "<a class='nav-link' href='../home.php'>Home</a>";
                    echo "<a class='nav-link' href='../cursos/cursos.php'>Cursos</a>";
                    echo "<a class='nav-link' active' href='../asignaturas/asignaturas.php'>Asignaturas</a>";
                    echo "<a class='nav-link' href='tareas.php'>Tareas</a>";
                    echo "<p class='nav-link'> | </p>";
                    echo "<a href='../cerrar.php' class='nav-link'>Cerrar sesión</a>";
                  echo "</nav>";
                echo "</div>";
              echo "</header>";

              echo "<main role='main' class='inner cover'>";
                echo "<form class='form-signin' action='insert_data.php' method='POST'>";
                  echo "<h1 class='h3 mb-3 font-weight-normal'>EDITAR TAREA</h1>";
                  echo "<input name='nom_tarea' type='text' class='form-control' placeholder='Nombre tarea' value='".$tarea_data[0]["nom_tarea"]."' required autofocus>";
                  echo "<select required class='form-control form-control-lg' style='height: 60px' name='cod_asig'>";
                  foreach ($resultado as $key => $row1){
                    $asignatura_data = $database->select("asignatura","*",['cod_asig' => $row1]);
                    foreach ($asignatura_data as $key => $row) { 
                      if($tarea_data[0]["cod_asig"] == $row["cod_asig"]){
                        echo "<option selected value='".$row["cod_asig"]."'>".$row["nom_asig"]."</option>";
                      }else{
                        echo "<option value='".$row["cod_asig"]."'>".$row["nom_asig"]."</option>";
                      }
                    }
                  }
                  
                  echo "</select>";
                  $date = date("Y-m-d\TH:i:s", strtotime($tarea_data[0]["f_limite"]));
                  echo "<input name='f_limite' type='datetime-local' class='form-control' value='".$date."' required autofocus>";
                  echo "<input name='descript_tarea' type='text' class='form-control' value='".$tarea_data[0]["descript_tarea"]."' placeholder='Descripcion de la tarea' required autofocus>";
                  echo "<input name='cod_tarea' type='hidden'value='".$tarea_data[0]["cod_tarea"]."'>";
                  echo "<button name='insert_asig' class='btn btn-lg btn-primary btn-block' type='submit'><i class='bi bi-upload'></i> Actualizar</button>";
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
    <script type="text/javascript">
      $('#datetimepicker').datetimepicker({
        format:'Y-m-d H:i',
      });
    </script> 
    <link rel="stylesheet" type="text/css" href="jquery.datetimepicker.css"/>
    <script src="jquery.datetimepicker.full.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
  
</html>