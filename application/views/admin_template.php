<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="<?=base_url()?>assets/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?=base_url()?>assets/images/favicon.ico" type="image/x-icon">

    <title>{title}</title>
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/font-awesome.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/theme-organic.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/gijgo.min.css" rel="stylesheet">

    <!-- style sheets specific to the page -->
    {_styles}

</head>

<body>
    <div class="container-fluid" id="wrapper">
        <div class="row">
            <nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-3 bg-faded sidebar-style-1">
                <h1 class="site-title">
                    <a href="#">
                    <div class="brand">
                        <img src="<?=base_url()?>assets/images/logo.png">
                    </div>
                        <span>Basketball League</span>
                    </a>
                </h1>
                <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">
                    <em class="fa fa-bars"></em>
                </a>
                {menu}
                <a href="<?=base_url()?>auth/logout" class="logout-button">
                    <em class="fa fa-power-off"></em> Signout</a>
            </nav>

            <main class="col-xs-12 col-sm-8 offset-sm-4 col-lg-9 offset-lg-3 col-xl-9 offset-xl-3 pt-3 pl-4">
            <header class="page-header row justify-center">
                <div class="col-md-6 col-lg-8" >
                    <h1 class="float-left text-center text-md-left"><?= $menuTitle ?></h1>
                </div>
                
                <div class="dropdown user-dropdown col-md-6 col-lg-4 text-md-right text-right">
                    <!-- <img src="<?=base_url()?>assets/images/logo.jpg" alt="profile photo" class="circle float-left profile-photo" width="50" height="auto">
                     -->
                   
                    <div class="username mt-1">
                        <div class="user-logo text-center mr-2">   
                            <i class="fa fa-user fa-1x"></i>
                        </div>
                       
                        <div class="user-section">
                            <h4 class="mb-1"><?= $this->session->userdata('name'); ?></h4>
                            <h6 class="text-muted"><?= $this->session->userdata('identity'); ?></h6>
                        </div> 
                    </div>
                
                </div>
                
                <div class="clear"></div>
            </header>
                {content}
            </main>
        </div>
    </div>

    <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?=base_url()?>assets/js/sweetalert2.all.js"></script>
    <script src="<?=base_url()?>assets/js/gijgo.min.js"></script>

    <script src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyAHKjT4AfdZ8p8s_ccUAwWsqUVaAMZ3mVI"></script>
    
    <script src="<?=base_url()?>assets/js/jquery.geocomplete.js"></script>

    <script>
    $(document).ready(function() {
        var table = $('#dataTable').DataTable();
    } );
    {_scripts}
    </script>
    <!-- js files specific to the page -->


</body>

</html>