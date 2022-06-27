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
   
    $nom_asig = $_POST['nom_asig'];
    $cod_curso = $_POST['cod_curso'];
    $n_horas = $_POST['n_horas'];
    $profesor = $_POST['profesor'];
    $cod_asig = $_POST['cod_asig'];

    $curso_data = $database->select("curso",
        "*",
        ['cod_curso' => $cod_curso]
    );

    // Si se pasa un nulo, se insertan datos nuevos
    if($cod_asig == -1){

        $database->insert("asignatura", [
            "nom_asig" => $nom_asig,
            "curs_anio" => $curso_data[0]["anio_ini"],
            "n_horas" => $n_horas,
            "profesor" => $profesor
        ]);

        $asig_data = $database->select("asignatura",
            ["cod_asig"],
            ["ORDER" => ["cod_asig" => "DESC"], "LIMIT" => 1]
        );

        $cod_asig = $asig_data[0]["cod_asig"];

        $database->insert("alumn_asig", [
            "cod_alum" => $id_session_user,
            "cod_asig" => $cod_asig,
        ]);

        
        $database->insert("curso_asig", [
            "cod_asig" => $cod_asig,
            "cod_curso" => $cod_curso,
        ]);


        header("Location: asignaturas.php");

    // Si se pasa un curso, se actualizan los datos con los nuevos obtenidos.
    }else{
        $database->update("asignatura", [
            "nom_asig" => $nom_asig,
            "curs_anio" => $curso_data[0]["anio_ini"],
            "n_horas" => $n_horas,
            "profesor" => $profesor
        ],["cod_asig" => $cod_asig]);

        $database ->update("curso_asig", [
            "cod_curso" => $cod_curso
            ],["cod_asig" => $cod_asig]
        );


        header("Location: asignaturas.php");


    }




    

?>