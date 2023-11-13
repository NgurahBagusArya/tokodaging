<?php 

    require 'function.php';

    if (isset($_POST['login'])){

        $email = $_POST["email"];
        $password = $_POST["password"];

       $result = mysqli_query($conn, "SELECT * FROM pengguna WHERE email = '$email'");

       // cek user name
       if(mysqli_num_rows($result) === 1){
           
           $row = mysqli_fetch_assoc($result);
           // cek password
        if ( password_verify($password, $row["password"])) {
            header ("location: aboutdaging.php");
            exit;
        }
       }
       $error = true;
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">



            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row justify-content-center">

                    <div class="col-lg-5">
                        <img class="w-100" src="img/gambar.png" alt="" styles="">
                    </div>

                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Login</h1>

                                <?php if( isset ($error)) : ?>
                                    <p styles="color: red; font-style: italic;"></p>user name / password salah</p>
                                <?php endif; ?>
                            
                                <form action="" method="post">

                                    <div class="form-group">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="exampleInputEmail" name="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="exampleInputEmail" name="password" placeholder="Password">
                                    </div>

                                    <button type="submit" class="btn btn-primary" name="login">Submit</button>

                                    <!-- <a href="login.php" class="btn btn-primary btn-user btn-block" name="registrasi">
                                        registrasi
                                    </a> -->
                                    <hr>
                                    <p>
                                       Don't have an account? <a href="register.php">registrasi</a>
                                    </p>

                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

</body>

</html>