<?php
$boost = (new Servers())->boost($URL[1]);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Boost &bull; <?php echo Config::GET("settings/siteName"); ?></title>
    <?php include("./includes/layouts/MainMetas.php"); ?>
</head>
<body>
<?php include("./includes/layouts/HeaderMain.php"); ?>

<div class="p-7 p-md-5 mb-7 text-white bg-customAnimation shadow-md">
    <div class="container text-center px-0">
        <h3 class="font-italic"><i class="fas fa-fire"></i> Boost</h3>
    </div>
</div>

<main class="container">

    <div class="row my-4">
        <?php include("./includes/layouts/Menu.php"); ?>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header bg-dark text-light"><i class="fas fa-fire"></i> Boost</div>
                <div class="card-body">
                    <div class='alert alert-primary text-center'>За да направите VIP сървърът, изпратете SMS с текст <?php echo Config::GET("boost/text"); ?> на номер <?php echo Config::GET("boost/nomer"); ?> (<?php echo Config::GET("boost/price"); ?>. с ддс). Услугата важи 7 дни, след това трябва да подновите сървъра си.<br />
                        За да рекламирате сървър, той трябва вече да е добавен в сайта (необходима е регистрация).</div>

                    <form method="POST">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-signature"></i></span>
                            <input type="text" name="ip" class="form-control" placeholder="IP:Port на сървъра" value="<?php echo $boost->ip; ?>" required>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-money-bill"></i></span>
                            <input type="text" name="sms" class="form-control" placeholder="SMS Код">
                        </div>

                        <button type="submit" name="boost" class="btn btn-outline-success"><i class="fas fa-fire"></i> Boost</button>
                    </form>
                    <?php Session::showMessage(); ?>
                </div>
            </div>
        </div>

    </div>

</main>

<?php include("./includes/layouts/FooterMain.php"); ?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>