<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Menú Principal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
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

            $resultado = $database->select("alum_tarea",[
                "cod_tarea"],
                ['cod_alum' => $id_session_user]
            );

            // Si no hay resultados..
            if(empty($resultado)){
                
                header("Location: editor_tareas.php?cod_tarea=-1");
                       
            // Si hay resultados..
            }else{
                echo "<div class='cover-container d-flex h-100 p-3 mx-auto flex-column'>";
                    echo "<header class='masthead mb-auto'>";
                        echo "<div class='inner'>";
                            echo "<h3 class='masthead-brand'>TAREA</h3>";
                            echo "<nav class='nav nav-masthead justify-content-center'>";
                                echo "<a class='nav-link' href='../home.php'>Home</a>";
                                echo "<a class='nav-link' href='../cursos/cursos.php'>Cursos</a>";
                                echo "<a class='nav-link' href='../asignaturas/asignaturas.php'>Asignaturas</a>";
                                echo "<a class='nav-link active'>Tareas</a>";
                                echo "<p class='nav-link'> | </p>";
                                echo "<a href='../cerrar.php' class='nav-link'>Cerrar sesión</a>";
                            echo "</nav>";
                        echo "</div>";
                    echo "</header>";
        
                    echo "<main role='main' class='inner cover'>";
                        echo "<br><br>";
                            
                        echo "<div class='container'>";
                            echo "<div class='row justify-content-start'>";
                                
                            $tarea_data = $database->query("select * from tarea where cod_tarea in (select cod_tarea from alum_tarea where cod_alum = $id_session_user) order by estado;")->fetchAll();
                                    foreach ($tarea_data as $key => $row) {
                                        echo "<div class='col-4'>";

                                            // Si el dia tope para la tarea es superado...
                                            if($row["f_limite"] <= date("Y-m-d H:i:s")){

                                                if($row["estado"] == "pendiente"){
                                                    $database->update("tarea", [
                                                        "estado" => "RETRASO"
                                                    ],["cod_tarea" => $row["cod_tarea"]]);
                                                    echo "<meta http-equiv=\"refresh\" content=\"0;URL=tareas.php\">";
                                            
                                                }elseif(($row["estado"] == "completo")){
                                                    $database->update("tarea", [
                                                        "estado" => "ENTREGADO"
                                                    ],["cod_tarea" => $row["cod_tarea"]]);
                                                    echo "<meta http-equiv=\"refresh\" content=\"0;URL=tareas.php\">";
                                            
                                                }

                                                echo "<div class='card' style='height: 100%;'>";
                                                    echo "<div class='card-body d-flex flex-column'>";
                                                        echo "<h3 class='card-title'>".$row["nom_tarea"]."</h3>";
                                                        echo "<h5 class='card-title'>".$row["f_limite"]."</h5>";
                                                        $asignatura_data = $database->select("asignatura","*",['cod_asig' => $row["cod_asig"]]);
                                                        foreach ($asignatura_data as $key => $row1) {
                                                            echo "<p class='card-text'>".$row1["nom_asig"]."</p>";
                                                            echo "<p class='card-text'>".$row["descript_tarea"]."</p>";
                                                        }
                                                        echo "<div class='card-body d-flex flex-row row justify-content-center'>";
                                                            echo "<a href='editor_tareas.php?cod_tarea=".$row["cod_tarea"]."' class='btn btn-primary mt-auto'><i class='bi bi-pencil-square'></i> </a>";
                                                            echo "<button onclick='confirmation(".'"'.$row["nom_tarea"].'"'.",".'"'.$row["cod_tarea"].'"'.",".'"'.$row1["nom_asig"].'"'.")' href='' class='btn btn-danger mt-auto'><i class='bi bi bi-trash'></i> </button>";
                                                        echo "</div>";

                                                        echo "<div class='custom-control custom-switch'>";
                                                        if($row["estado"] == "RETRASO"){
                                                            echo "<input type='checkbox' disabled onClick='change(".'"'.$row["estado"].'"'.",".'"'.$row["cod_tarea"].'"'.")' class='custom-control-input' id='".$row["cod_tarea"]."'>
                                                            <label class='custom-control-label' for='".$row["cod_tarea"]."'>".$row["estado"]."</label>";
                                                        }else{
                                                            echo "<input disabled onClick='change(".'"'.$row["estado"].'"'.",".'"'.$row["cod_tarea"].'"'.")' type='checkbox' class='custom-control-input' id='".$row["cod_tarea"]."'>
                                                            <label class='custom-control-label' for='".$row["cod_tarea"]."'>".$row["estado"]."</label>";
                                                        }
                                                        echo "</div>";

                                                    
                                            echo "</div>";
                                        echo "</div>";
                                        
                                    //Si la tarea sigue abierta...
                                    }else{

                                        if($row["estado"] == "RETRASO"){
                                            $database->update("tarea", [
                                                "estado" => "pendiente"
                                            ],["cod_tarea" => $row["cod_tarea"]]);
                                            echo "<meta http-equiv=\"refresh\" content=\"0;URL=tareas.php\">";
                                    
                                        }elseif(($row["estado"] == "ENTREGADO")){
                                            $database->update("tarea", [
                                                "estado" => "completo"
                                            ],["cod_tarea" => $row["cod_tarea"]]);
                                            echo "<meta http-equiv=\"refresh\" content=\"0;URL=tareas.php\">";
                                    
                                        }

                                        echo "<div class='card' style='height: 100%;'>";
                                            echo "<div class='card-body d-flex flex-column'>";
                                                echo "<h3 class='card-title'>".$row["nom_tarea"]."</h3>";
                                                echo "<h5 class='card-title'>".$row["f_limite"]."</h5>";
                                                $asignatura_data = $database->select("asignatura","*",['cod_asig' => $row["cod_asig"]]);
                                                foreach ($asignatura_data as $key => $row1) {
                                                    echo "<p class='card-text'>".$row1["nom_asig"]."</p>";
                                                    echo "<p class='card-text'>".$row["descript_tarea"]."</p>";
                                                }
                                                echo "<div class='card-body d-flex flex-row row justify-content-center'>";
                                                    echo "<a href='editor_tareas.php?cod_tarea=".$row["cod_tarea"]."' class='btn btn-primary mt-auto'><i class='bi bi-pencil-square'></i> </a>";
                                                    echo "<button onclick='confirmation(".'"'.$row["nom_tarea"].'"'.",".'"'.$row["cod_tarea"].'"'.",".'"'.$row1["nom_asig"].'"'.")' href='' class='btn btn-danger mt-auto'><i class='bi bi bi-trash'></i> </button>";
                                                echo "</div>";
                                                echo "<div class='custom-control custom-switch'>";
                                                    if($row["estado"] == "pendiente"){
                                                        echo "<input type='checkbox' onClick='change(".'"'.$row["estado"].'"'.",".'"'.$row["cod_tarea"].'"'.")' class='custom-control-input' id='".$row["cod_tarea"]."'>
                                                        <label class='custom-control-label' for='".$row["cod_tarea"]."'>".$row["estado"]."</label>";
                                                    }else{
                                                        echo "<input checked onClick='change(".'"'.$row["estado"].'"'.",".'"'.$row["cod_tarea"].'"'.")' type='checkbox' class='custom-control-input' id='".$row["cod_tarea"]."'>
                                                        <label class='custom-control-label' for='".$row["cod_tarea"]."'>".$row["estado"]."</label>";
                                                    }
                                                echo "</div>";
                                            echo "</div>";
                                        echo "</div>";
                                    }
                                echo "</div>";
                                    }
                                }
                            echo "</div>";
                        echo "</div>";
                        echo "<br>";
                        echo "<a href='editor_tareas.php?cod_tarea=-1' class='btn btn-lg btn-primary btn-block2'><i class='bi bi-plus-circle'></i> Añadir</a>";
                    echo "</main>";

                    echo "<footer class='mastfoot mt-auto'>";
                        echo "<div class='inner'>";
                        echo "<p>By Gabriel Vázquez y Antonio Lozano.</p>";
                        echo "<p class='mt-5 mb-3 text-muted'>&copy; 2021-2022</p>";
                        echo "</div>";
                    echo "</footer>";
                echo "</div>";
            
        
            
      ?>
    <script>
        function confirmation(nom_tarea, cod_tarea, nom_asig){
            var del=confirm("Are you sure you want to delete this record?\n"+nom_tarea+" de la asignatura "+nom_asig);
            if (del==true){
                window.location.href="delete_data.php?cod_tarea="+cod_tarea;
            }
            return del;
        }
    </script>
    <script>
        function change(estado, cod_tarea){
            if (estado=="pendiente"){
                window.location.href="insert_estado.php?cod_tarea="+cod_tarea+"&estado=true";

            }else{
                window.location.href="insert_estado.php?cod_tarea="+cod_tarea+"&estado=false";

            }
        }
    </script>
        
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>