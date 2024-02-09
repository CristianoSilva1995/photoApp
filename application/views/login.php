<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kapture</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <style>
        body {
            padding-top: 70px;
            margin-bottom: 50px;
        }


        .loginWrapper {
            border: 1px solid black;
            background-color: lightgray;
            width: 50%;
            float: none;
            margin: 0px auto;
            padding-top: 40px;
            border-radius: 5px;
        }

        .loginInput {
            padding-left: 0px;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .loginLabel {
            padding-top: 22px;
            padding-bottom: 20px;
        }

        .welcomeTitle {
            padding: 25px;
        }

        footer {
            background-color: black;
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            margin-bottom: 0px;
            padding: 5px;
            color: lightgray;
        }

        .navText {
            color: lightgray;
        }

        .loginInput input {
            width: 80%;
        }

        #loginBtn {
            width: 70px !important;
            border-radius: 5px;
        }

        .logo {
            padding: 8px;
            margin-right: 10px;
            margin-top: 3px;
        }
    </style>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
            <div class="container">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <img class="pull-left logo" src="<?php echo base_url() . 'upload/logo.png';?>" width="75" height="55" alt="logo">
                        <p class="navbar-brand navText">
                            Kapture
                        </p>
                        <p class="navbar-brand navText">
                        </p>
                    </div>
                </div>
            </div>
        </nav>
        <div class='row welcomeTitle'>
            <div class="col-md-12">
                <h2>Welcome to kapture!</h2>
            </div> <!-- col-md-8 -->

        </div> <!-- row -->
        <div class="row loginWrapper">
            <form id="loginform" action=<?php echo base_url() . "index.php/auth";?> method="POST">
                <div class="col-sm-3 loginLabel">
                    <label for="email">Email:</label>
                    <label style="margin-top: 23px" for="password">Password:</label>

                </div>
                <div class="col-sm-9 loginInput">
                    <input type="email" id="email" name="email">
                    <input style="margin-top: 20px;" id="password" type="password" name="password">
                    <input type="submit" value="Login" id="loginBtn">
                    <div id="errorDiv"></div>
                    <a href=<?php echo base_url() . "index.php/signUp"; ?>>Create new Account</a>
                    
                </div>
            </form>
        </div>
    </div> <!-- container -->
    <div class="container my-5">

        <footer class="text-center text-lg-start" style="background-color: black;">
            <div class="text-center text-white p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                <p> &#169; <?php echo date('Y'); ?> Copyright: Cristiano Silva</p>
            </div>
        </footer>
        
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.4.0/backbone-min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginBtn').click(function(event) {
                $('#errorDiv').empty();
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url() . "index.php/auth";?>",
                    data: '{ "email":"' + $('#email').val() + '", "password":"'+ $('#password').val() +'" }',
                    dataType: 'json',
                    success: function(data) {
                        if (data.res != 0) {
                            window.location = "<?php echo base_url() . "index.php/home"; ?>";
                        } else {
                            $('#errorDiv').append('<span class="alert-danger">Wrong Credentials!</span>')
                        }
                    }
                });
                // stop the form from submitting the normal way and refreshing the page
                event.preventDefault();
            });
        });

    </script>

</body>

</html>