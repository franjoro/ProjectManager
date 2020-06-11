<?php
session_start();
if (isset($_SESSION['user'])) {
    session_destroy();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión **</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/form-elements.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


</head>

<body class="w3-animate-opacity">
    <style type="text/css">
    body {
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        font-weight: 300;
        color: #888;
        line-height: 30px;
        text-align: center;
        background: url('https://source.unsplash.com/1600x900/?construction');
        background-position: top;
        background-repeat: no-repeat;
        background-size: 100% 100%;
        background-attachment: fixed;
        overflow: hidden;
    }
    </style>
    <!-- Top content -->
    <div class="top-content">
        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-sm-offset-3 form-box">
                        <div class="form-top">
                            <div class="form-top-left d-none d-lg-block">
                                <strong>
                                    <h3>Log in</h3>
                                    <p>
                                        Fill in the information to continue</p>
                                </strong>
                            </div>
                            <div class="form-top-right d-none d-lg-block">
                                <img height="90px;" src="img/logo.png">
                            </div>
                            <div class="d-lg-none">
                                <img height="90px;" src="img/logo.png">
                            </div>
                        </div>
                        <div class="form-bottom">
                            <form id="userForm">
                                <div class="form-group">
                                    <label class="sr-only">User</label>
                                    <input type="text" name="pin" placeholder="User"
                                        class="form-username form-control" id="form-username">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">Password</label>
                                    <input type="password" name="pass" placeholder="Password"
                                        class="form-password form-control" id="form-password" autocomplete>
                                </div>
								<button style="width: 100%" type="submit" id="sub" class="btn">Log in</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
	<script src="vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	
    <script>
    const badpass = () => {
        Swal.fire({
            icon: "error",
            title: "User / pass wrong",
            text: "Please contact with the administrator",
        });
    };

    $("#userForm").submit((event) => {
        event.preventDefault();
        const serializedData = $("#userForm").serialize();
        $.ajax({
            url: "php/login.php",
            data: serializedData,
            type: "POST",
        }).done((data) => {
            console.log(data)
            if (data === 'NotAccess') {
                return badpass()
            };
            if (data === 'ok') {
                return window.location.href = 'dashboard.php'
            };
            if (data === 'okE') {
                return window.location.href = './empleados/'
            };


        });
    });
    </script>
</body>

</html>