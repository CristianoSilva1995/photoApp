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

        .container {
            width: 90% !important;
        }

        #imgDiv img {
            max-width: 1000px;
        }

        .center {
            margin-left: auto;
            margin-right: auto;
            width: 90%;
            max-width: 1200px;
            text-align: center;
            padding: 10px;
            margin-bottom: 80px;
        }

        .center img,
        span {
            margin-left: auto;
            margin-right: auto;
            display: block;
        }

        .center span {
            font-size: 20px;
            margin-right: 50px;
        }

        #description {
            width: 1000px;
            margin-bottom: 20px;
        }

        #addComment {
            margin-top: 20px;
        }

        #publishBtn {
            text-align: center;
            vertical-align: middle !important;
        }

        .addCommentBox {
            width: 85%;
            margin: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btnDiv {
            top: 50%;
        }

        .inputComment_Description {
            font-size: 18px;
            padding: 10px;
            margin-bottom: 10px;
        }

        span:hover {
            color: black;
            cursor: pointer;
        }

        span {
            margin-bottom: 25px;
        }

        #friendOperation {
            margin-left: 500px;
        }
    </style>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
            <div class="container-fluid">
                <div id="logoDiv" class="navbar-header welcomeMessageNavBar">
                    <img class="pull-left logo" src="<?php echo base_url() . 'upload/logo.png';?>" width="75" height="55" alt="logo">
                    <p class="navbar-brand">Kapture <br>Welcome <?php echo $session['fName']; ?></p>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo base_url() . 'index.php/home'?>">Home</a></li>
                    <li><a href="<?php echo base_url() . 'index.php/myProfile'?>">View my profile</a></li>
                    <li><a href="<?php echo base_url() . 'index.php/createPost'?>">Create new Post</a></li>
                    <li><a href="<?php echo base_url() . 'index.php/logout';?>">Logout</a>                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="row center" id="imgDiv">
                <img class="" src="<?php echo base_url();?>/upload/<?php echo $file_name ?>" alt='try'><br>
                <span id="friendSpan">Posted by: <?php echo $postFName; ?><button id="friendOperation">Add Friend</button></span>
                <input type="text" class="inputComment_Description" id="description" disabled value="<?php echo $description; ?>"><br>
                <span id="like" class="glyphicon glyphicon-thumbs-up">(<?php echo $number_of_likes ?>)</span>
                <span id="dislike" class="glyphicon glyphicon-thumbs-down">(<?php echo $number_of_dislikes ?>)</span>
                <span class="glyphicon glyphicon-comment comment" id="spanComment">(<?php echo $num_comments ?>)</span><br>
                <div class="row addCommentBox ">
                    <div class="col-md-10">
                        <textarea id="commentTextarea" cols="120" rows="2" placeholder="Add a comment..."></textarea>
                    </div>
                    <div class="col-md-2 btnDiv">
                        <input type="button" id="publishBtn" value="Publish">
                    </div>
                </div>
                <h3>Comments</h3>
                <div id="commentsDiv"></div>
            </div>
            <div class="row" id="imgDiv">

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

    <script>
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                url: "<?php echo base_url() ?>index.php/restComment/<?php echo $post_id; ?>",
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(index, item) {
                        var comment = item.comment;
                        $('#commentsDiv').append('<input type="text" class="inputComment_Description" value="' + comment + '" size="139px" disabled>');
                    });
                }
            });

            $('#publishBtn').click(function() {
                var comment = $('#commentTextarea').val();
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url(); ?>index.php/restComment",
                    data: '{ "post_id":' + <?php echo $post_id; ?> + ', "comment":"' + comment + '" }',
                    dataType: 'json',
                });
                $('#commentTextarea').val('');
                $('#commentsDiv').empty();
                $.ajax({
                    type: 'GET',
                    url: "<?php echo base_url() ?>index.php/restComment/<?php echo $post_id; ?>",
                    data: '{ "post_id":' + <?php echo $post_id; ?> + '" }',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(index, item) {
                            var comment = item.comment;
                            $('#commentsDiv').append('<input type="text" class="inputComment_Description" value="' + comment + '" size="139px" disabled>');
                        });
                    }
                });
                
                $.ajax({
                    type: 'GET',
                    url: "<?php echo base_url() ?>index.php/numComments/<?php echo $post_id; ?>",
                    dataType: 'json',
                    success: function(data) {
                        var commentSpan = document.getElementById("spanComment");
                        commentSpan.innerText = "("+data.num_comments+")";
                    }
                });
            });

            $('#like').on('click', function() {
                var num_likes = $('#like').text();
                num_likes = num_likes.replace(/\(/g, '');
                num_likes = num_likes.replace(/\)/g, '');
                num_likes = (parseInt(num_likes));
                if (!($('#like').hasClass('activated'))) {
                    num_likes++;
                    $('#like').addClass('activated');

                } else {
                    num_likes--;

                    $('#like').removeClass('activated');

                }
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url() ?>index.php/like",
                    data: '{ "post_id":' + <?php echo $post_id; ?> + ', "number_of_likes":"' + num_likes + '" }',
                    dataType: 'json',
                    success: function(data) {
                        $('#like').text('(' + (num_likes) + ')');

                    }
                });
            });

            $('#dislike').on('click', function() {
                var num_dislikes = $('#dislike').text();
                num_dislikes = num_dislikes.replace(/\(/g, '');
                num_dislikes = num_dislikes.replace(/\)/g, '');
                num_dislikes = (parseInt(num_dislikes));
                if (!($('#dislike').hasClass('activated'))) {
                    num_dislikes++;
                    $('#dislike').addClass('activated');
                } else {
                    num_dislikes--;
                    $('#dislike').removeClass('activated');
                }
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url() ?>index.php/dislike",
                    data: '{ "post_id":' + <?php echo $post_id; ?> + ', "number_of_dislikes":"' + num_dislikes + '" }',
                    dataType: 'json',
                    success: function(data) {
                        $('#dislike').text('(' + (num_dislikes) + ')');
                    }
                });
            });

            $('#friendOperation').click(function() {
                $('.spanErrorFriends').empty()
                $.ajax({
                    type: 'GET',
                    url: "<?php echo base_url() . "index.php/addFriend/" . $post_id; ?>",
                    dataType: 'json',
                    success: function(friend_id) {
                        if (friend_id != <?php echo $session['id_user']; ?>) {
                            $.ajax({
                                type: 'POST',
                                url: "<?php echo base_url() ?>index.php/addFriend/" + <?php echo $session['id_user']; ?> + "/" + friend_id,
                                dataType: 'json',
                                success: function(data) {
                                    if (data.res < 1) {
                                        $('#friendSpan').append('<span class="alert-danger spanErrorFriends">You are already friends friends</span>');
                                    } else {
                                        $('#friendSpan').append('<span class="alert-success spanErrorFriends">You are now friends friends</span>');
                                    }

                                },
                            });
                        }
                    }
                });
            });
            $('#logoDiv').click(function(){
                window.location = "<?php echo base_url() . "index.php/home"; ?>";
            });
        });
    </script>

</body>

</html>