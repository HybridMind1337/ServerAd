<?php
if (@$_SESSION['acc'] == TRUE) {
    Redirect::TO("/home/");
}
$RegSubmit = (new User())->RegSubmit();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Регистрация в сайта &bull; <?php echo Config::GET("settings/siteName"); ?></title>
    <?php include("./includes/layouts/MainMetas.php"); ?>
</head>
<body>
<?php include("./includes/layouts/HeaderMain.php"); ?>

<div class="p-7 p-md-5 mb-7 text-white bg-customAnimation shadow-md">
    <div class="container text-center px-0">
        <h3 class="font-italic"><i class="fas fa-user-plus"></i> Регистрация в сайта</h3>
    </div>
</div>

<main class="container">

    <div class="row my-4">
        <?php include("./includes/layouts/Menu.php"); ?>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header bg-dark text-light"><i class="fas fa-user-plus"></i> Регистрация в сайта</div>
                <div class="card-body">
                    <div class='alert alert-primary'>Сайта използва gravatar, за да сложите аватар, моля - влезте в gravatar и сложете аватар на емейла с който сте се регистрирали!</div>

                    <form method="POST">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-signature"></i></span>
                            <input type="text" name="username" class="form-control" placeholder="Потребителско име">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                            <input type="password" name="password" class="form-control" placeholder="Парола" required>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                            <input type="password" name="pass" class="form-control" placeholder="Повтори паролата" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="E-Mail адрес">
                        </div>
                        <button type="submit" name="RegSubmit" class="btn btn-outline-success"><i class="fas fa-plus"></i> Регистрация</button>
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