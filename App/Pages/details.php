<?php
$details = (new Servers())->getDetails($URL[1])[0];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Всички добавени сървъри &bull; <?php echo Config::GET("settings/siteName"); ?></title>
    <?php include("./includes/layouts/MainMetas.php"); ?>
</head>
<body>
<?php include("./includes/layouts/HeaderMain.php"); ?>

<div class="p-7 p-md-5 mb-7 text-white bg-customAnimation shadow-md">
    <div class="container text-center px-0">
        <h3 class="fst-italic"><img src="<?php echo $details['icon']; ?>" alt=""/> <?php echo $details['hostName']; ?></h3>
        <h6>Сървър Информация</h6>
    </div>
</div>

<main class="container">

    <div class="row my-4">
        <?php include("./includes/layouts/Menu.php"); ?>
        <div class="col-lg-9">
            <div class="card mb-3">
                <div class="card-header bg-dark text-light">Сървър информация</div>
                <div class="card-body">
                    <img class="img-responsive float-end mr-5" height="150" width="200" src="https://image.gametracker.com/images/maps/160x120/cs/<?php echo $details['map']; ?>.jpg"/>
                    IP: <b><?php echo $details['serverIP']; ?></b><br/>
                    Игра: <b><?php echo $details['game']; ?></b><br/>
                    Карта: <b><?php echo $details['map']; ?></b><br/>
                    Статус: <?php if ($details['status'] == 'Online') { ?> <span class="badge bg-success"><i class="fas fa-check"></i></span> <?php } else { ?><span class="badge bg-danger"><i class="fas fa-times"></i></span><?php } ?><br/>
                    Играчи: <b><?php echo $details['onlinePlayers']; ?> от <?php echo $details['maxPlayers']; ?></b><br/>
                    Добавен от: <b><?php echo $details['owner']; ?></b><br/>
                    Добавен на: <b><?php echo date("d.m.Y (H:s)", $details['added']); ?></b><br />
                    VIP: <?php if ($details['VIP'] == 1) { ?>
                        <div class="badge bg-primary"><i class="fas fa-crown"></i></div>
                    <?php } ?>
                    <a href="<?php echo Config::get("settings/baseURL"); ?>/boost/<?php echo $details['id']; ?>" class="btn btn-outline-primary btn-sm">Направи сървъра VIP</a>
                </div>
            </div>

            <?php if ($details['gamesmall'] == "cstrike") {?>
                <div class="card mb-3">
                    <div class="card-header bg-dark text-light">Играчи</div>
                    <div class="card-body">
                        <table class="table text-center table-sm table-striped table-bordered table-hover">
                            <thead class="table-dark">
                            <tr>
                                <th scope="col" style="width: 1%">№</th>
                                <th scope="col">Име</th>
                                <th scope="col" style="width: 20%">Точки</th>
                                <th scope="col" style="width: 20%">Изиграно време</th>
                            </tr>
                            </thead>
                            <?php
                            foreach ($details['players'] as $player) {
                                $plid = $player['id'];
                                $plname = $player['gq_name'];
                                $plscore = $player['gq_score'];
                                $pltime = date("H:s:i", $player['gq_time']);
                                ?>
                                <tr>
                                    <td><?php echo $plid; ?></td>
                                    <td><?php echo $plname; ?></td>
                                    <td><?php echo $plscore; ?></td>
                                    <td><?php echo $pltime; ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    </div>

</main>

<?php include("./includes/layouts/FooterMain.php"); ?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>