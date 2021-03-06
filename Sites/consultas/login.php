<?php 

session_start(); 

require("../config/conexion_91.php");

if (isset($_POST['user']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $uname = validate($_POST['user']);

    $pass = validate($_POST['password']);

    if (empty($uname)) {

        header("Location: ../index.php?error=User is required");

        exit();

    }else if(empty($pass)){

        header("Location: ../index.php?error=Password is required");

        exit();

    }else{

        $sql = "SELECT * FROM usuarios WHERE username='$uname' AND password='$pass'";

        $result = $db->prepare($sql);
        $result->execute();

        $count = $result->rowCount();
        if ($count === 1) {

            $row = $result->fetch(PDO::FETCH_ASSOC);

            if ($row['username'] === $uname && $row['password'] === $pass) {

                echo "Logged in!";

                $_SESSION['username'] = $row['username'];

                $_SESSION['type'] = $row['type'];

                $_SESSION['id'] = $row['id'];

                if ($_SESSION['type'] === "admin") {

                    header("Location: admin.php");
                
                }elseif ($_SESSION['type'] === "aerolinea") {

                    header("Location: compania.php");
                
                }elseif ($_SESSION['type'] === "pasajero") {

                    header("Location: pasajeros.php");
                
                }

                exit();

            }else{

                header("Location: ../index.php?error=Incorrect user or password");

                exit();

            }

        }else{

            header("Location: ../index.php?error=Wrong user or password");

            exit();

        }

    }

}else{

    header("Location: ../index.php");

    exit();

}