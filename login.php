<?php
session_start();

if (isset($_SESSION['loginname'])) {
    header('Location: index.php');
    exit;
}

// recept user login and redirect to index.php
if (isset($_POST)) {
    if (!empty($_POST['loginname'])) {
        $_SESSION['loginname'] = $_POST['loginname'];

        // create personal reference cookie for user if not exist
        if (!isset($_COOKIE[$username . 'articles'])) {
            $cookieEntry = $username . 'articles';
            setcookie($cookieEntry, serialize([]), time() + 7 * 86400);
        }

        header('Location: index.php?message=hello');
        exit;
    }

}

require 'inc/head.php';

// trigger alert message for log
if ($_GET) :
    if ($_GET['message'] == 'log') :?>
        <div class="alert alert-info alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Hello you !</strong> You must be looged to visit our delicious cookies ! Don't be shy and tell me
            your
            name.
        </div>
        <?php
    endif;

    if ($_GET['message'] == 'logout') :?>
        <div class="alert alert-info alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Goodbye <?= ($_GET['username']) ?? '' ?> !</strong> Thank you for your visit.
        </div>
        <?php
    endif;

endif; // endif ($_GET)
?>

<div class="container" style="margin-top:40px">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong> Sign in to continue</strong>
                </div>
                <div class="panel-body">
                    <form role="form" action="#" method="POST">
                        <fieldset>
                            <div class="row">
                                <div class="center-block">
                                    <img class="profile-img"
                                         src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                                         alt="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                    <div class="form-group">
                                        <div class="input-group">
                    <span class="input-group-addon">
                      <i class="glyphicon glyphicon-user"></i>
                    </span>
                                            <input class="form-control" placeholder="Username" name="loginname"
                                                   type="text" autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-lg btn-primary btn-block" value="Sign in">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="panel-footer ">
                    Don't have an account ? <a href="#" onClick="">Too bad !</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'inc/foot.php' ?>
