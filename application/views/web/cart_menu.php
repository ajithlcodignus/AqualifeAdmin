<html>

<head>
    <title>Foodveno</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

    <link href="css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style_2.css">
    <link rel="stylesheet" href="<?= base_url() ?>plugins/fontawesome-free/css/all.min.css">
    <style>
       
        .sidenav {
            height: 100%;
           
            width: 0;
            
            position: fixed;
            
            z-index: 1;
           
            top: 0;
            
            left: 0;
            background-color: #111;
           
            overflow-x: hidden;
            
            padding-top: 60px;
           
            transition: 0.5s;
            
        }

        /* The navigation menu links */
        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        /* When you mouse over the navigation links, change their color */
        .sidenav a:hover {
            color: #f1f1f1;
        }

        /* Position and style the close button (top right corner) */
        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        /* Style page content - use this if you want to push the page content to the right when you open the side navigation */
        #main {
            transition: margin-left .5s;
            padding: 20px;
        }

        /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }
    </style>
    <script>
        
    </script>
</head>

<body style="background-color: yellow;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">tex1</div>
        </div>
    </div>

    <div id="mySidenav" style="background-color: white;" class="sidenav">
        <div class="modal" style="display: block;" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="min-height: 100vh;">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button id="closeNav" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Modal body text goes here.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Use any element to open the sidenav -->
    <input type="submit" value="open" id="openNav" />

    <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
    <div id="main">
        ...
    </div>
    <script>
        jQuery(document).ready(function() {
            $(document).on('click', '#openNav', function(e) {
                //document.getElementById("mySidenav").style.width = "250px";
                $("#mySidenav").css({
                    'width': '250px'
                });
                $(".modal").css({
                    'display': 'block'
                });
            });
            $(document).on('click', '#closeNav', function(e) {
                
                $("#mySidenav").css({
                    'width': '0px'
                });
                $(".modal").css({
                    'display': 'none'
                });
            });
        });
    </script>
</body>

</html>
