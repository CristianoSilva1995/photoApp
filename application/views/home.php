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
            padding: 30px;
            text-align: center;
            border: 2px solid #222222;
            border-radius: 10px;
            margin-left: 20px;
            margin-right: 20px;
            margin-bottom: 10px;
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

        span:hover {
            cursor: pointer;
        }

        .modalImg {
            margin-left: 15px;
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
                    <li class="active"><a href="<?php echo base_url() . 'index.php/home' ?>">Home</a></li>
                    <li><a href="<?php echo base_url() . 'index.php/myProfile' ?>">View my profile</a></li>
                    <li><a href="<?php echo base_url() . 'index.php/createPost' ?>">Create new Post</a></li>
                    <li><input type="text" placeholder="Search by tag" id="searchBar"><button id="tagSearchBtn">Search</button></li>
                    <li><a href="<?php echo base_url() . 'index.php/logout'; ?>">Logout</a>
                </ul>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row" id="imgDiv"></div>
        </div>

        <div class="modal fade" id="Mymodal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Search Results</h4>
                    </div>
                    <div class="modal-body row">
                        <div id="imgDivModal"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.4.0/backbone-min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: "<?php echo base_url() ?>index.php/loadImages",
                dataType: 'json',
                success: function(data) {
                    $.each(JSON.parse(data), function(index, item) {
                        var photo_id = item.photo_id;
                        var file_name = item.file_name;
                        var num_likes = item.number_of_likes;
                        var num_dislikes = item.number_of_dislikes;
                        var num_of_comments = item.num_comments;
                        var fName = item.fName;
                        var tag = item.tag;
                        $('#imgDiv').append('<div class="postImage"><span id="postedUserName">Posted by: ' + fName + '<br>Tag: ' + tag + '</span><br><a href="<?php echo base_url() . "index.php/fetchImg/" ?>' + photo_id + '"><img id="getImg" src="<?php echo base_url() . '/upload/'; ?>' + file_name + '" height="300px" width="300px"/><br><span id="like" class="glyphicon glyphicon-thumbs-up">(' + num_likes + ')</span><span id="dislike" class="glyphicon glyphicon-thumbs-down">(' + num_dislikes + ')</span><span class="glyphicon glyphicon-comment comment">(' + num_of_comments + ')</span></a></div>');
                    });
                }
            });

            $('#tagSearchBtn').on('click', function() {
                var tag = $('#searchBar').val();
                if (tag != '') {
                    $('#imgDivModal').empty();
                    $.ajax({
                        type: 'GET',
                        url: "<?php echo base_url() ?>index.php/search/" + tag,
                        dataType: 'json',
                        success: function(data) {
                            $('#Mymodal').modal('show');
                            if (jQuery.isEmptyObject(data[0])) {
                                $('#imgDivModal').append('<h2 class="modalImg">No results found!</h2>');
                            } else {
                                $('#imgDivModal').append('<h2 class="modalImg">Results for ('+tag+')</h2><br>');
                                $.each((data), function(index, item) {
                                    var file_name = item.file_name;
                                    $('#imgDivModal').append('<img class="modalImg" src="<?php echo base_url() . '/upload/'; ?>' + file_name + '" height="300px" width="300px"/>');
                                });
                            }

                        }
                    });
                    $('#searchBar').val('');
                }
            });
            $('#logoDiv').click(function(){
                window.location = "<?php echo base_url() . "index.php/home"; ?>";
            });
        });
    </script>

</body>

</html>