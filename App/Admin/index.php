<?php
$allusers = (new Role())->getAllUsers();
$giverole = (new Role())->giveRole();
$removerole = (new Role())->removeRole();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Добавяне на роля към потребител &bull; <?php echo Config::GET("settings/siteName"); ?></title>
    <?php include("./includes/layouts/MainMetas.php"); ?>
</head>
<body>
<?php include("./includes/layouts/HeaderMain.php"); ?>

<div class="p-7 p-md-5 mb-7 text-white bg-customAnimation shadow-md">
    <div class="container text-center px-0">
        <h3 class="font-italic"><i class="fas fa-lock"></i> Добавяне на роля към потребител</h3>
    </div>
</div>

<main class="container">

    <div class="row my-4">
        <?php include("./includes/layouts/Menu.php"); ?>

        <div class="col-lg-9">
            <?php Session::showMessage(); ?>
            <div class="card">
                <div class="card-header bg-dark text-light"><i class="fas fa-lock"></i> Добавяне на роля към потребител</div>
                <div class="card-body">
                    <form method="POST">
                        <div class="input-group mb-3">
                            <label class="input-group-text">Избери потребител</label>
                            <select class="form-select" name="user">
                                <?php foreach ($allusers as $user) { ?>
                                    <option value="<?php echo $user->id; ?>"><?php echo $user->username; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" name="role" class="btn btn-outline-success">Добави</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-dark text-light"><i class="fas fa-lock"></i> Премахване на роля</div>
                <div class="card-body">
                    <form method="POST">
                        <div class="input-group mb-3">
                            <label class="input-group-text">Избери потребител</label>
                            <select class="form-select" name="user">
                                <?php foreach ($allusers as $user) { ?>
                                    <option value="<?php echo $user->id; ?>"><?php echo $user->username; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" name="removerole" class="btn btn-outline-success">Добави</button>
                    </form>
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