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
            font-size: 16px;
        }

        .navText {
            color: lightgray;
        }

        .logo {
            padding: 8px;
            margin-right: 10px;
            margin-top: 3px;
        }

        .welcomeMessageNavBar {
            margin-right: 50px !important;
            width: 350px;
            margin: 0px !important;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .active {
            margin-top: 5px;
        }

        li {
            margin-right: 80px;
        }

        #searchBar {
            margin-top: 12px;
            border-radius: 5px;
            width: 250px;
        }

        .navbar-brand {
            color: white !important;
            margin-top: -5px;
        }

        #formDiv {
            border: 1px solid black;
            margin-top: 100px;
            padding: 20px;
            width: 70%;

        }

        .center {
            float: none;
            margin: 50px auto;

        }

        .btnRow {
            text-align: right;
            margin-right: 180px;
        }
    </style>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
            <div class="container-fluid">
                <div id="logoDiv" class="navbar-header welcomeMessageNavBar">
                    <img class="pull-left logo" src="<?php echo base_url() . 'upload/logo.png'; ?>" width="75" height="55" alt="logo">
                    <p class="navbar-brand">Kapture <br>Welcome <?php echo $fName; ?></p>

                </div>
                <ul class="nav navbar-nav">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?php echo base_url() . 'index.php/home' ?>">Home</a></li>
                        <li><a href="<?php echo base_url() . 'index.php/myProfile' ?>">View my profile</a></li>
                        <li><a href="<?php echo base_url() . 'index.php/createPost' ?>">Create new Post</a></li>
                        <li><a href="<?php echo base_url() . 'index.php/logout'; ?>">Logout</a>
                    </ul>
            </div>
        </nav>

        <div class="container" id="formDiv">
            <h4>Create new Post</h4>
            <form method="post" action=<?php echo base_url() . 'index.php/upload'; ?> enctype="multipart/form-data">
                <div class="row center">
                    <div class="col-sm-3">
                        <label>Upload Image:</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="file" name="fileupload" id="fileupload">
                    </div>
                </div>
                <div class="row center">
                    <div class="col-sm-3">
                        <label>Profile Picture?</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="checkbox" name="profilePic" id="isItProfilePic">
                    </div>
                </div>
                <div class="row center">
                    <div class="col-sm-3">
                        <label>Tag:</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="tag" id="tag">
                    </div>
                </div>
                <div class="row center">
                    <div class="col-sm-3">
                        <label>Description:</label>
                    </div>
                    <div class="col-sm-9">
                        <textarea rows="3" cols="50" name="description" id="description"></textarea>
                    </div>
                </div>
                <div class="row btnRow">
                    <button id="submitBtn">Submit</button>
                </div>
            </form>
        </div>
        <footer class="text-center text-lg-start" style="background-color: black;">
            <div class="text-center text-white p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                <p> &#169; <?php echo date('Y'); ?> Copyright: Cristiano Silva</p>
            </div>
        </footer>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.4.0/backbone-min.js"></script>
</body>
<script>
    $(document).ready(function() {
        $('#logoDiv').click(function() {
            window.location = "<?php echo base_url() . "index.php/home"; ?>";
        });
    });
</script>

</html>