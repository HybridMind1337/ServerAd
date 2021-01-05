<?php
if (@$_SESSION['acc'] == FALSE) {
    Redirect::TO("/home/");
}
$userservers = (new User())->settingsAction();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Контролен панел &bull; <?php echo Config::GET("settings/siteName"); ?></title>
    <?php include("./includes/layouts/MainMetas.php"); ?>
</head>
<body>
<?php include("./includes/layouts/HeaderMain.php"); ?>

<div class="p-7 p-md-5 mb-7 text-white bg-customAnimation shadow-md">
    <div class="container text-center px-0">
        <h3 class="font-italic"><i class="fas fa-cogs"></i> Контролен панел</h3>
    </div>
</div>

<main class="container">

    <div class="row my-4">
        <?php include("./includes/layouts/Menu.php"); ?>
        <div class="col-lg-9">
            <?php if (isset($_GET['id']) && $_GET['action'] == 'edit' && is_numeric($_GET['id'])) { ?>
                <div class="card">
                    <div class="card-header bg-dark text-light"><i class="fas fa-edit"></i> Редактиране на <?php echo $userservers['ip']; ?></div>
                    <div class="card-body">
                        <?php Session::showMessage(); ?>
                        <form method="POST">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa fa-signature"></i></span>
                                <input type="text" name="newip" placeholder="IP:Port на сървъра" value="<?php echo $userservers['ip']; ?>" class="form-control" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa fa-laptop"></i></span>
                                <input type="text" name="newwebiste" placeholder="Уеб сайт" value="<?php echo $userservers['website']; ?>" class="form-control">
                            </div>
                            <input type="submit" name="editServer" value="Редактирай сървъра" class="btn btn-success"/>
                        </form>
                    </div>
                </div>
            <?php } else { ?>
                <div class="card">
                    <div class="card-header bg-dark text-light"><i class="fas fa-cogs"></i> Контролен панел</div>
                    <div class="card-body">
                        <?php Session::showMessage(); ?>
                        <div class="alert alert-primary text-center">От тази страница може да редактиране IP адреса или порта на вашите сървъри, също така може да ги изтриете</div>
                        <?php if ($userservers) { ?>
                            <div class="table-responsive">
                                <table class="table text-center table-sm table-striped table-bordered table-hover">
                                    <thead class="table-dark">
                                    <tr>
                                        <th scope="col" style="width: 1%">№</th>
                                        <th scope="col" style="width: 20%">IP адрес</th>
                                        <th scope="col" style="width: 10%">Игра</th>
                                        <th scope="col" style="width: 10%">Уеб сайт</th>
                                        <th scope="col" style="width: 5%">Добавен</th>
                                        <th scope="col" style="width: 15%">Функции</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($userservers as $Serv) { ?>
                                        <tr>
                                            <td><?php echo $Serv->id; ?></td>
                                            <td><?php echo $Serv->ip; ?></td>
                                            <td><?php echo $Serv->game; ?></td>
                                            <td><?php echo $Serv->website; ?></td>
                                            <td><?php echo date("d.m.Y", $Serv->date); ?></td>
                                            <td>
                                                <a href="<?php echo Config::get("settings/baseURL"); ?>/settings/?action=edit&id=<?php echo $Serv->id; ?>" class="btn btn-outline-primary btn-sm">Редактиране</a>
                                                <a href="<?php echo Config::get("settings/baseURL"); ?>/settings/?action=delete&id=<?php echo $Serv->id; ?>" class="btn btn-outline-danger btn-sm">Изтрий</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-danger text-center">Няма добавени сървъри към системата</div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>

</main>

<?php include("./includes/layouts/FooterMain.php"); ?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>