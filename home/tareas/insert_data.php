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

    $nom_tarea = $_POST['nom_tarea'];
    $cod_tarea = $_POST['cod_tarea'];
    $cod_asig = $_POST['cod_asig'];
    $f_limite = $_POST['f_limite'];
    $estado = $_POST['estado'];
    $descript_tarea = $_POST['descript_tarea'];

    // Si se pasa un nulo, se insertan datos nuevos
    if($cod_tarea == -1){
      
      $database->insert("tarea", [
          "cod_asig" => $cod_asig,
          "nom_tarea" => $nom_tarea,
          "f_limite" => $f_limite,
          "estado" => "pendiente",
          "descript_tarea" => $descript_tarea
      ]);

      $tarea_data = $database->select("tarea",
        ["cod_tarea"],
        ["ORDER" => ["cod_tarea" => "DESC"], "LIMIT" => 1]
      );

      $cod_tarea = $tarea_data[0]["cod_tarea"];

      $database->insert("alum_tarea", [
          "cod_alum" => $id_session_user,
          "cod_asig" => $cod_asig,
          "cod_tarea" => $cod_tarea
      ]);

      header("Location: tareas.php");
      

    // Si se pasa una tarea, se actualizan los datos con los nuevos obtenidos.
    }else{
      
        //No se actualiza ni el nombre de la tarea ni se permitirá reasignar una tarea a otra asignatura (el estado se cambia desde tarea.php).
        $database->update("tarea", [
            "nom_tarea" => $nom_tarea,
            "cod_asig" => $cod_asig,
            "f_limite" => $f_limite,
            "descript_tarea" => $descript_tarea
        ],["cod_tarea" => $cod_tarea]);

        header("Location: tareas.php");
    }

?>