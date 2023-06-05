<?php
define('QUADODO_IN_SYSTEM', true);
require_once('includes/header.php');
if ($qls->user_info['username'] != '')
{

  header ("location: index.php");    
} 
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>OTDAV - Dashboard</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://flutter.tn/wp-content/uploads/2019/07/cropped-otdav-180x180.png">
    <link rel="shortcut icon" href="https://flutter.tn/wp-content/uploads/2019/07/cropped-otdav-180x180.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>
<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    
                        <img class="align-content" src="images/OTDAV.jpg" alt="">
                    
                </div>
                <div class="login-form">
                    <form action="login_process.php" method="post">
                      <input type="hidden" name="process" value="true" />
                        <div class="form-group">
                            <label>Login</label>
                            <input type="text" name="username" maxlength="<?php echo $qls->config['max_username']; ?>" />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" maxlength="<?php echo $qls->config['max_password']; ?>" />
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                            <label class="pull-right">
                                <a href="#">Forgotten Password?</a>
                            </label>

                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                        <?php
if (isset($_GET['f'])) {
?>
        <br />
        <span style="color:#ff524a;">
<?php
    switch ($_GET['f']) {
        default:
            break;
        case 0:
            echo LOGIN_NOT_ACTIVE_USER;
            break;
        case 1:
            echo LOGIN_USER_BLOCKED;
            break;
        case 2:
            echo LOGIN_PASSWORDS_NOT_MATCHED;
            break;
        case 3:
            echo LOGIN_NO_TRIES;
            break;
        case 4:
            echo LOGIN_USER_INFO_MISSING;
            break;
        case 5:
            echo LOGIN_NOT_ACTIVE_ADMIN;
            break;
    }
?>
        </span>
<?php
}
?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>
