<?php
session_start();

include 'src/bdd.php'; // load bdd
?>

<?php require 'inc/head.php';

// trigger alert message for havin deleted article
if ($_GET) :
    if ($_GET['message'] == 'delete') :
        $cookieName = $bdd[$_GET['id']][1];
        ?>
        <div class="alert alert-warning alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong><?= $cookieName ?></strong> have been deleted from your basket. Don't be sorry, we have many other customers !
        </div>
        <?php
    endif;

    if ($_GET['message'] == 'deleteMany') :
        $number = $_GET['number'];
        ?>
        <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong><?= $number ?> poor little cookies have been deleted from your basket</strong> Don't be sorry, we have many other customers !
        </div>
        <?php
    endif;


endif; // endif ($_GET)
?>

<section class="cookies container-fluid">
    <div class="row">
        <?php
        $username = $_SESSION['loginname'];
        $tab = unserialize($_COOKIE[$username . 'articles']);
        if (!count($tab)) : ?>
            <div class="alert alert-danger">
                Votre panier est vide, tout comme votre estomac !
            </div>
        <?php endif;

        foreach ($tab as $cake_id) :
            $cake = $bdd[$cake_id[0]]; // infos
            $nb = $cake_id[1] // number of article in basket
            ?>

            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <figure class="thumbnail text-center">
                    <img src="assets/img/product-<?= $cake[0] ?>.jpeg" alt="cookies choclate chips"
                         class="img-responsive">
                    <figcaption class="caption">
                        <h3><?= $cake[1] ?></h3>
                        <p><?= $cake[2] ?></p>
                        <p>Number of article : <?= $nb ?></p>
                        <form action="delete.php" method="post">
                            <input type="hidden" value="<?= $cake[0] ?>" name="deleteCake">
                            <button type="submit" class="btn btn-danger">
                                <span class="glyphicon glyphicon-minus" aria - hidden="true"></span> Delete to cart
                            </button>
                        </form>
                    </figcaption>
                </figure>
            </div>

        <?php endforeach ?>

    </div>
</section>

<!-- trash basket button -->
<form action="delete.php" method="post" role="form" style="position: fixed; bottom: 10px; right: 10px;z-index: 1">
    <div class="form-group">
        <input type="hidden" class="form-control" name="deleteCake" value="all">
    </div>

    <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
</form>


<?php require 'inc/foot.php'; ?>


