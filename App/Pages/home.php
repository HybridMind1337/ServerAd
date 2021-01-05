<?php
$Servers = (new Servers())->getAdServers("10"); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Начална страница &bull; <?php echo Config::GET("settings/siteName"); ?></title>
    <?php include("./includes/layouts/MainMetas.php"); ?>
</head>
<body>
<?php include("./includes/layouts/HeaderMain.php"); ?>

<div class="p-7 p-md-5 mb-7 text-white bg-customAnimation shadow-md">
    <div class="container text-center p-3">
        <h1 class="display-4 font-italic"><?php echo Config::GET("settings/siteName"); ?></h1>
        <p class="lead my-0">Мониторинг на игрови сървъри</p>
    </div>
</div>

<main class="container">

    <div class="col-lg-12">
        <?php if ($getVIPServ) { ?>
            <div class="text-center display-6 fst-italic mb-2 mt-2">V.I.P сървъри</div>
            <div class="table-responsive">
                <table class="table table-sm table-striped table-bordered table-hover">
                    <thead class="table-dark">
                    <tr>
                        <th scope="col" style="width: 1%"></th>
                        <th scope="col" style="width: 1%"></th>
                        <th scope="col" style="width: 40%">Име</th>
                        <th scope="col" style="width: 15%">IP адрес</th>
                        <th scope="col" class="text-center" style="width: 10%">Играчи</th>
                        <th scope="col" class="text-center" style="width: 10%">Карта</th>
                        <th style="width: 1%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($getVIPServ as $VIPS) { ?>
                        <tr>
                            <th class="text-center"><span class="badge bg-primary rounded-0 shadow-sm"><i class="fas fa-crown"></i></span></th>
                            <th class="text-center"><?php if ($VIPS['status'] == 'Online') { ?>
                                    <span class="badge bg-success rounded-0 shadow-sm"><i class="fas fa-check"></i></span>
                                <?php } else { ?>
                                    <span class="badge bg-danger rounded-0 shadow-sm"><i class="fas fa-times"></i></span>
                                <?php } ?></th>
                            <td><img src="<?php echo $VIPS['icon']; ?>" alt="Игра"/> <?php echo Main::truncate_chars($VIPS['hostName'], 50, '...'); ?></td>
                            <td><?php echo $VIPS['serverIP']; ?></td>
                            <td class="text-center"><?php echo $VIPS['onlinePlayers']; ?> / <?php echo $VIPS['maxPlayers']; ?></td>
                            <td><?php echo $VIPS['map']; ?></td>
                            <td><a href="<?php echo Config::GET("settings/baseURL"); ?>/details/<?php echo $VIPS['serverIP']; ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-question"></i></a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
    </div>

    <div class="row">
        <?php include("./includes/layouts/Menu.php"); ?>
        <div class="col-lg-9">
            <?php if ($Servers) { ?>
                <div class="p-3 bg-dark text-light text-center rounded mb-1">Последни 10 добавени сървъри</div>
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered table-hover">
                        <thead class="table-dark">
                        <tr>
                            <th scope="col" style="width: 1%"></th>
                            <th scope="col" style="width: 40%">Име</th>
                            <th scope="col" style="width: 15%">IP адрес</th>
                            <th scope="col" class="text-center" style="width: 10%">Играчи</th>
                            <th scope="col" class="text-center" style="width: 10%">Карта</th>
                            <th style="width: 1%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($Servers as $adServ) { ?>
                            <tr>
                                <th class="text-center"><?php if ($adServ['status'] == 'Online') { ?>
                                        <span class="badge bg-success rounded-0 shadow-sm"><i class="fas fa-check"></i></span>
                                    <?php } else { ?>
                                        <span class="badge bg-danger rounded-0 shadow-sm"><i class="fas fa-times"></i></span>
                                    <?php } ?></th>
                                <td><img src="<?php echo $adServ['icon']; ?>" alt="Игра"/> <?php echo Main::truncate_chars($adServ['hostName'], 50, '...'); ?></td>
                                <td><?php echo $adServ['serverIP']; ?></td>
                                <td class="text-center"><?php echo $adServ['onlinePlayers']; ?> / <?php echo $adServ['maxPlayers']; ?></td>
                                <td><?php echo $adServ['map']; ?></td>
                                <td><a href="<?php echo Config::GET("settings/baseURL"); ?>/details/<?php echo $adServ['serverIP']; ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-question"></i></a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-grid gap-2">
                    <a href="<?php echo Config::GET("settings/baseURL"); ?>/allServers" class="btn btn-outline-primary"><i class="fas fa-list"></i> Виж всички добавени сървъри</a>
                </div>
            <?php } else { ?>
                <div class="alert alert-danger text-center">Няма добавени сървъри към системата</div>
            <?php } ?>
        </div>
    </div>
</main>

<?php include("./includes/layouts/FooterMain.php"); ?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
