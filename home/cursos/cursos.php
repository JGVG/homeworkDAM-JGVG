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

            $id_session_user = $_SESSION['id'];

            $resultado = $database->select("alum_curso",[
                "cod_curso"],
                ['cod_alum' => $id_session_user]
            );

            // Si no hay resultados..
            if(empty($resultado)){
                
                header("Location: editor_cursos.php?cod_curso=-1");
                       
            // Si hay resultados..
            }else{
                echo "<div class='cover-container d-flex h-100 p-3 mx-auto flex-column'>";
                
                    echo "<header class='masthead mb-auto'>";
                        echo "<div class='inner'>";
                            echo "<h3 class='masthead-brand'>CURSOS</h3>";
                            echo "<nav class='nav nav-masthead justify-content-center'>";
                                echo "<a class='nav-link' href='../home.php'>Home</a>";
                                echo "<a class='nav-link active'>Cursos</a>";
                                echo "<a class='nav-link' href='../asignaturas/asignaturas.php'>Asignaturas</a>";
                                echo "<a class='nav-link' href='../tareas/tareas.php'>Tareas</a>";
                                echo "<p class='nav-link'> | </p>";
                                echo "<a href='../cerrar.php' class='nav-link'>Cerrar sesión</a>";
                            echo "</nav>";
                        echo "</div>";
                    echo "</header>";
        
                    echo "<main role='main' class='inner cover'>";
                        echo "<br><br>";
                            
                        echo "<div class='container'>";
                            echo "<div class='row justify-content-center'>";
                                foreach ($resultado as $key => $row) { 
                                    $curso_data = $database->select("curso","*",['cod_curso' => $row]);
                                    foreach ($curso_data as $key => $row) {
                                        echo "<div class='col-4 col-6'>";
                                            echo "<div class='card' style='height: 100%;'>";
                                                echo "<img class='card-img-top' src='https://picsum.photos/700/400?random+".$row["cod_curso"]."' alt='Card image cap'>";
                                                    echo "<div class='card-body d-flex flex-column'>";
                                                        echo "<h5 class='card-title'>".$row["nom_centro"]." ".$row["anio_ini"]."/".$row["anio_fin"]."</h5>";
                                                        echo "<p class='card-text'>".$row["descript_curso"]."</p>";
                                                    echo "<a href='editor_cursos.php?cod_curso=".$row["cod_curso"]."' class='btn btn-primary mt-auto'><i class='bi bi-pencil-square'></i> Editar</a>";
                                                echo "</div>";
                                            echo "</div>";
                                        echo "</div>";
                                    }
                                }
                            echo "</div>";
                        echo "</div>";
                        echo "<br>";
                        echo "<a href='editor_cursos.php?cod_curso=-1' class='btn btn-lg btn-primary btn-block2'><i class='bi bi-plus-circle'></i> Añadir</a>";
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