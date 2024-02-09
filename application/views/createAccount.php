<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kapture</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
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

        .loginLabel label {
            margin-bottom: 20px;
        }

        .loginInput input {
            width: 80%;
            margin-bottom: 15px;
        }

        .welcomeTitle {
            padding: 25px;
        }

        .loginBtn {
            width: 70px !important;
            border-radius: 5px;
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
                    <div id="logoDiv" class="navbar-header">
                        <img class="pull-left logo" src="<?php echo base_url() . 'upload/logo.png'; ?>" width="75" height="55" alt="logo">
                        <p class="navbar-brand navText">
                            Kapture
                        </p>
                    </div>
                </div>
            </div>
        </nav>
        <div class='row welcomeTitle'>
            <div class="col-md-12">
                <h2>Welcome to kapture!</h2>
                <h6>Create your account</h6>
            </div> <!-- col-md-8 -->

        </div> <!-- row -->
        <div class="row loginWrapper">

            <form action=<?php echo base_url() . "index.php/newUser" ?> method="POST" onsubmit="return verifyPassword()">
                <div class="col-sm-3 loginLabel">
                    <label for="fName">Frist name:</label>
                    <label for="lName">Last name:</label>
                    <label for="email">Email:</label>
                    <label for="password">Password:</label>
                    <label for="confirmPassword">Confirm Password:</label>
                </div>
                <div class="col-sm-9 loginInput">
                    <input type="text" name="fName" id="fName" required>
                    <input type="text" name="lName" id="lName" required>
                    <input type="email" name="email" id="email" required>
                    <input type="password" name="password" id="pass" required>
                    <input type="password" name="confirmPassword" id="passConf" required>
                    <input id="submitBtn" class="loginBtn" type="submit" value="Submit">
                    <div id="errorDiv"></div>
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
        function verifyPassword() {
            var pass = document.getElementById('pass').value;
            var passConf = document.getElementById('passConf').value;
            if (pass != passConf) {
                return "Password does not match!";
            } else {
                if (pass.length >= 6) {
                    return "";
                } else {
                    return "Password must contain 6 characters or more!";
                }
            }

        }

        $(document).ready(function() {
            $('#submitBtn').click(function(event) {
                $('#errorDiv').empty();
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url() . "index.php/verifyEmail"; ?>",
                    data: '{"email":"' + $('#email').val() + '"}',
                    dataType: 'json',
                    success: function(data) {
                        if (data.emailExists < 1) {
                            var msg = verifyPassword();
                            if (msg == "") {
                                $.ajax({
                                    type: 'POST',
                                    url: "<?php echo base_url() . "index.php/newUser"; ?>",
                                    data: '{ "fName":"' + $('#fName').val() + '", "lName":"' + $('#lName').val() + '", "email":"' + $('#email').val() + '", "password":"' + $('#password').val() + '" }',
                                    dataType: 'json',
                                    success: function(data) {
                                        if (data.res != 0) {
                                            window.location = "<?php echo base_url() . "index.php/login"; ?>";
                                        } else {
                                            $('#errorDiv').append('<span class="alert-danger">Wrong Credentials!<br>Please, enter a different one</span>')
                                        }
                                    }
                                });
                            } else {
                                $('#errorDiv').empty();
                                $('#errorDiv').append('<span class="alert-danger">'+msg+'</span>')
                            }
                        } else {
                            $('#errorDiv').empty();
                            $('#errorDiv').append('<span class="alert-danger">Email already in use!</span>')
                        }
                    }
                });


                // stop the form from submitting the normal way and refreshing the page
                event.preventDefault();
            });

            $('#logoDiv').click(function(){
                window.location = "<?php echo base_url() . "index.php/login"; ?>";
            });
        });
    </script>

</body>

</html>