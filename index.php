<?php
session_start();

include 'src/bdd.php'; // load bdd
?>

<?php require 'inc/head.php';

// trigger alert message for adding one cookie to your cart
if ($_GET) :
    if ($_GET['message'] == 'add') :
        $cookieName = $bdd[$_GET['id']][1];
        ?>
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong><?= $cookieName ?></strong> has been added to your cart ! We hope your stomach like it !
        </div>
        <?php
    endif;

    if ($_GET['message'] == 'hello') :
        $username = $_SESSION['loginname'] ?? 'You';
        ?>
        <div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>Hello <?= $username ?></strong> Have a nice trip in the Cookie Factory !
        </div>
        <?php
    endif;

endif; // endif ($_GET)
?>

<section class="cookies container-fluid">
    <div class="row">

        <?php
        foreach ($bdd as $cake) :
            ?>

            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <figure class="thumbnail text-center">
                    <img src="assets/img/product-<?= $cake[0] ?>.jpeg" alt="cookies choclate chips"
                         class="img-responsive">
                    <figcaption class="caption">
                        <h3><?= $cake[1] ?></h3>
                        <p><?= $cake[2] ?></p>
                        <?php if (isset($_SESSION['loginname'])) : ?>
                            <form action="add.php" method="post">
                                <input type="hidden" value="<?= $cake[0] ?>" name="addCake">
                                <button type="submit" class="btn btn-primary">
                                    <span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Add to cart
                                </button>
                            </form>
                        <?php endif ?>
                    </figcaption>
                </figure>
            </div>

        <?php endforeach ?>

    </div>
</section>
<?php require 'inc/foot.php'; ?>
