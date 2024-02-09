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
            color: black;
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

        .container {
            width: 90% !important;
        }

        /* #imgDiv img{
            float: none;
            margin: 0 auto;
        }  */

        .postImage {
            float: left;
            margin: 0 auto;
            padding: 15px;
            text-align: center;
        }

        .postImage span {
            font-size: 18px;
            margin-top: 10px;
            margin-right: 20px;
        }

        #imgDiv a {
            all: none;
            color: black;
        }

        .mainProfileWrapper {
            margin-top: 30px;
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }

        .profilePic {
            margin-top: 50px;
            margin-bottom: 10px;
        }

        #displayAllImages img {
            margin-top: 10px;
            margin-bottom: 20px;
            margin-right: 15px;
        }

        .friendListAllImagesDiv {
            border-top: 2px solid black;

            padding: 50px;
            margin-top: 50px;
        }

        .friendLI {
            font-size: 16px;
            margin-bottom: 10px;
        }

        #aboutMe {
            margin-top: 120px;
        }

        #description {
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
            <div class="container-fluid">
                <div id="logoDiv" class="navbar-header welcomeMessageNavBar">
                    <img class="pull-left logo" src="<?php echo base_url() . 'upload/logo.png'; ?>" width="75" height="55" alt="logo">
                    <p class="navbar-brand">Kapture <br>Welcome <?php echo $session['fName']; ?></p>

                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo base_url() . 'index.php/home' ?>">Home</a></li>
                    <li><a href="<?php echo base_url() . 'index.php/myProfile' ?>">View my profile</a></li>
                    <li><a href="<?php echo base_url() . 'index.php/createPost' ?>">Create new Post</a></li>
                    <li><a href="<?php echo base_url() . 'index.php/logout'; ?>">Logout</a>
                </ul>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row mainProfileWrapper" id="imgDiv">
                <h3>View Profile of <?php echo $session['fName']; ?></h3>
                <div class="row">
                    <div class="col-md-2" id="aboutMe">
                        <h4>About Me:</h4>
                        <textarea cols="45" rows="5" id="aboutMeTextarea" placeholder="about me..."></textarea>
                        <button id="aboutMeBtn">Update</button>
                    </div>
                    <div class="col-md-10" id="profilePicDiv">
                    </div>
                </div>

                <div class="row friendListAllImagesDiv">
                    <div class="col-md-2">
                        <h4 style="font-weight: bold;">Your Friends List:</h4>
                        <ul id="friendList" style="list-style-type: none;"></ul>
                    </div>
                    <div class="col-md-10" id="displayAllImages">
                        <h4 style="font-weight: bold;">My Photos:</h4><br>
                    </div>
                </div>
            </div>
        </div>
        <footer class="text-center text-lg-start" style="background-color: black;">
            <div class="text-center text-white p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                <p> &#169; <?php echo date('Y'); ?> Copyright: Cristiano Silva</p>
            </div>
        </footer>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.2/underscore-min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.2/backbone-min.js" type="text/javascript"></script>

    <script>
        $.ajax({
            type: 'GET',
            url: "<?php echo base_url() . 'index.php/image/' . $session['id_user']; ?>",
            dataType: 'json',
            success: function(data) {
                $.each(JSON.parse(data), function(index, item) {
                    $('#displayAllImages').append('<img src="<?php echo base_url(); ?>/upload/' + item.file_name + '" width="300px" disabled>');
                });
            }
        });

        $.ajax({
            type: 'GET',
            url: "<?php echo base_url() . 'index.php/profilePicture/' . $session['id_user']; ?>",
            dataType: 'json',
            success: function(data) {
                $('#profilePicDiv').append('<img id="profilePic" class="profilePic center" src="<?php echo base_url(); ?>/upload/' + data.file_name + '" max-width="900px"><br><input type="text" class="center" id="description" value="' + data.description + '" disabled>');
                $('#aboutMeTextarea').val(data.about_me);
            }
        });

        var Profile = Backbone.Model.extend({
            url: function() {
                var urlRoot = "<?php echo base_url() . 'Restapi/friendList/'; ?>";
                return urlRoot;
            },
            idAttribute: "_id",
            defaults: {
                fName: '',
            }
        });

        var FriendList = Backbone.Collection.extend({
            model: Profile,
            url: "<?php echo base_url() . 'index.php/friendList/' . $session['id_user']; ?>",
        });

        var friends = new FriendList();

        var FriendListView = Backbone.View.extend({
            model: friends,
            el: $('#friendList'),
            initialize: function() {
                friends.fetch({
                    async: false
                });
                this.render();
            },
            render: function() {
                var self = this;
                friends.each(function(f) {
                    var li = "<span class='friendLI'>" + f.get('fName') + "</span><br>";
                    self.$el.append(li)
                });
            }
        });
        var friendList = new FriendListView();


        $('#aboutMeBtn').click(function() {
            var aboutMe = $('#aboutMeTextarea').val();
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url() . 'index.php/setAboutMe'; ?>",
                data: '{ "id_user":' + <?php echo $session['id_user']; ?> + ', "about_me":"' + aboutMe + '" }',
                dataType: 'json',
            });
        });
        $('#logoDiv').click(function() {
            window.location = "<?php echo base_url() . "index.php/home"; ?>";
        });
    </script>
</body>

</html>