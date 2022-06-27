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

            $id_session_user = $_SESSION['id'];

            $resultado = $database->select("alumn_asig",[
                "cod_asig"],
                ['cod_alum' => $id_session_user]
            );

            

            // Si no hay resultados..
            if(empty($resultado)){
                
                echo "<div class='cover-container d-flex h-100 p-3 mx-auto flex-column'>";

                        echo "<header class='masthead mb-auto'>";
                        echo "<div class='inner'>";
                            echo "<h3 class='masthead-brand'>ASIGNATURA</h3>";
                            echo "<nav class='nav nav-masthead justify-content-center'>";
                                echo "<a class='nav-link' href='../home.php'>Home</a>";
                                echo "<a class='nav-link' href='../cursos/cursos.php'>Cursos</a>";
                                echo "<a class='nav-link active'>Asignaturas</a>";
                                echo "<a class='nav-link' href='../tareas/tareas.php'>Tareas</a>";
                                echo "<p class='nav-link'> | </p>";
                                echo "<a href='../cerrar.php' class='nav-link'>Cerrar sesión</a>";
                            echo "</nav>";
                        echo "</div>";
                    echo "</header>";

                    echo "<main role='main' class='inner cover'>";
                    echo "<h1 class='cover-heading'>No existen asignaturas.</h1>";
                    echo "<br><br>";
                    echo "<p class='lead'>";
                        echo "<a href='editor_asignaturas.php?cod_asig=-1' class='btn btn-lg btn-primary btn-block'>Crear asignatura</a>";
                    echo "</p>";
                    echo "</main>";

                    echo "<footer class='mastfoot mt-auto'>";
                    echo "<div class='inner'>";
                    echo "<p>By Gabriel Vázquez, Jaime Abad y Antonio Lozano.</p>";
                    echo "<p class='mt-5 mb-3 text-muted'>&copy; 2021-2022</p>";
                    echo "</div>";
                    echo "</footer>";

                echo "</div>";
                       
            // Si hay resultados..
            }else{
                echo "<div class='cover-container d-flex h-100 p-3 mx-auto flex-column'>";
                    echo "<header class='masthead mb-auto'>";
                        echo "<div class='inner'>";
                            echo "<h3 class='masthead-brand'>ASIGNATURA</h3>";
                            echo "<nav class='nav nav-masthead justify-content-center'>";
                                echo "<a class='nav-link' href='../home.php'>Home</a>";
                                echo "<a class='nav-link' href='../cursos/cursos.php'>Cursos</a>";
                                echo "<a class='nav-link active'>Asignaturas</a>";
                                echo "<a class='nav-link' href='../tareas/tareas.php'>Tareas</a>";
                                echo "<p class='nav-link'> | </p>";
                                echo "<a href='../cerrar.php' class='nav-link'>Cerrar sesión</a>";
                            echo "</nav>";
                        echo "</div>";
                    echo "</header>";
        
                    echo "<main role='main' class='inner cover'>";
                        echo "<br><br>";
                            
                        echo "<div class='container'>";
                            echo "<div class='row justify-content-start'>";
                                foreach ($resultado as $key => $row) { 
                                    $asignatura_data = $database->select("asignatura","*",['cod_asig' => $row]);
                                    foreach ($asignatura_data as $key => $row) {
                                        echo "<div class='col-4'>";
                                            echo "<div class='card' style='height: 100%;'>";
                                                echo "<img class='card-img-top' src='https://picsum.photos/700/400?random+".$row["cod_asig"]."' alt='Card image cap'>";
                                                    echo "<div class='card-body d-flex flex-column'>";
                                                        echo "<h5 class='card-title'>".$row["nom_asig"]."</h5>";
                                                        echo "<p class='card-text'>Prof: ".$row["profesor"]."</p>";
                                                        echo "<div class='card-body d-flex flex-row row justify-content-center'>";
                                                            echo "<a href='editor_asignaturas.php?cod_asig=".$row["cod_asig"]."' class='btn btn-primary mt-auto'><i class='bi bi-pencil-square'></i> </a>";
                                                            echo "<button onclick='confirmation(".'"'.$row["nom_asig"].'"'.",".'"'.$row["cod_asig"].'"'.")' href='' class='btn btn-danger mt-auto'><i class='bi bi bi-trash'></i> </button>";
                                                        echo "</div>";
                                                    echo "</div>";
                                            echo "</div>";
                                        echo "</div>";
                                    }
                                }
                            echo "</div>";
                        echo "</div>";
                        echo "<br>";
                        echo "<a href='editor_asignaturas.php?cod_asig=-1' class='btn btn-lg btn-primary btn-block2'><i class='bi bi-plus-circle'></i> Añadir</a>";
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
      <script>
        function confirmation(nom_asig, cod_asig){
            var del=confirm("Are you sure you want to delete this record?\n"+nom_asig);
            if (del==true){
                window.location.href="delete_data.php?cod_asig="+cod_asig;
            }
            return del;
        }
        </script>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>