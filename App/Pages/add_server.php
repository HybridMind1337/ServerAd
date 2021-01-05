<?php
if (@$_SESSION['acc'] == FALSE) {
    Redirect::TO("/home/");
}
$addServer = (new Servers())->addServer();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Добавяне на сървър &bull; <?php echo Config::GET("settings/siteName"); ?></title>
    <?php include("./includes/layouts/MainMetas.php"); ?>
</head>
<body>
<?php include("./includes/layouts/HeaderMain.php"); ?>

<div class="p-7 p-md-5 mb-7 text-white bg-customAnimation shadow-md">
    <div class="container text-center px-0">
        <h3 class="font-italic"><i class="fas fa-plus"></i> Добавяне на сървър</h3>
    </div>
</div>

<main class="container">

    <div class="row my-4">
        <?php include("./includes/layouts/Menu.php"); ?>
        <div class="col-sm-9">
            <div class="card">
                <div class="card-header bg-dark text-light"><i class="fas fa-plus"></i> Добавяне на сървър</div>
                <div class="card-body">
                    <?php if (@$_SESSION['acc'] == TRUE) {
                        Session::showMessage(); ?>
                        <div class="alert alert-primary text-center">Попълнете IP адреса и типа на сървъра, останалата информация ще бъде автоматично извлечена от него и записана в базата данни.</div>
                        <form method="POST">
                            <input type="hidden" name="owner" value="<?php echo $_SESSION['acc']; ?>" />
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-server"></i></span>
                                <input type="text" name="IPAdress" class="form-control" placeholder="IP:Port на сървъра" required>
                            </div>

                            <div class="mb-3">
                                <div class="input-group mb-3">
                                    <label class="input-group-text"><i class="fas fa-gamepad"></i></label>
                                    <select name="type" class="form-select">
                                        <option selected>Избери...</option>
                                        <option value="cs16">Counter-Strike 1.6</option>
                                        <option value="csgo">Counter-Strike Global Offensive</option>
                                        <option value="css">Counter-Strike Source</option>
                                        <option value="minecraft">Minecraft</option>
                                        <option value="mta">Multi Theft Auto</option>
                                        <option value="samp">San Andreas Multiplayer</option>
                                        <option value="teamspeak3">Teamspeak 3</option>
                                        <option value="tf2">Team Fortress 2</option>
                                    </select>
                                </div>
                            </div>

                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-desktop"></i></span>
                                <input type="text" name="website" class="form-control" placeholder="Уеб сайт">
                            </div>
                            <div class="form-text">Може да оставите полето празно, системата автоматично ще го задеде, че няма уеб сайт.</div>
                            <br/>
                            <button type="submit" name="addServer" class="btn btn-outline-success"><i class="fas fa-plus"></i> Добави сървъра</button>
                        </form>
                    <?php } else { ?>
                        <div class="alert alert-danger text-center">Моля, влезте в акаунта си или си направете такъв.</div>
                    <?php } ?>
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