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
   
    $nom_centro = $_POST['n_centro'];
    $anio_ini = $_POST['anio_ini'];
    $anio_fin = $_POST['anio_fin'];
    $descript = $_POST['descript'];
    $cod_curso = $_POST['cod_curso'];

    // Si se pasa un nulo, se insertan datos nuevos
    if($cod_curso == -1){
        $database->insert("curso", [
            "nom_centro" => $nom_centro,
            "anio_ini" => $anio_ini,
            "anio_fin" => $anio_fin,
            "descript_curso" => $descript
        ]);

        $curso_data = $database->select("curso",
            ["cod_curso"],
            ["ORDER" => ["cod_curso" => "DESC"], "LIMIT" => 1]
        );

        $cod_curso = $curso_data[0]["cod_curso"];

        $database->insert("alum_curso", [
            "cod_curso" => $cod_curso,
            "cod_alum" => $id_session_user,
        ]);

        header("Location: cursos.php");

    // Si se pasa un curso, se actualizan los datos con los nuevos obtenidos.
    }else{
        $database->update("curso", [
            "nom_centro" => $nom_centro,
            "anio_ini" => $anio_ini,
            "anio_fin" => $anio_fin,
            "descript_curso" => $descript
        ],["cod_curso" => $cod_curso]);

        header("Location: cursos.php");


    }




    

?>