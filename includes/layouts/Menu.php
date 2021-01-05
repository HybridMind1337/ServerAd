<div class="col-sm-3">
    <div class="card mb-3 shadow-sm">
        <div class="card-header bg-dark text-light"><i class="fas fa-user"></i> Потребителски панел</div>
        <div class="card-body">
            <?php if (isset($_SESSION['acc'])) {
                if($userinfo->role == "Admin") {
                    $Rank = "Администратор";
                    $RankColor = "bg-danger";
                } else {
                    $Rank = "Потребител";
                    $RankColor = "bg-secondary";
                } ?>
                <img  src='<?php echo User::get_gravatar($userinfo->email); ?>' class='img-fluid rounded mx-auto d-block shadow-sm' alt='Аватар' />
                <hr />
                <i class="fas fa-hand-paper"></i> Здравей, <span class="badge <?php echo $RankColor; ?>"><?php echo $userinfo->username; ?></span><br />
                <i class="fas fa-star"></i> Ранг: <span class="badge <?php echo $RankColor; ?>"><?php echo $Rank; ?></span><br />
                <i class="fas fa-envelope"></i> Email: <?php echo $userinfo->email; ?><br />
                <i class="far fa-calendar-alt"></i> Регистриран на: <?php echo date("d.m.Yг (H:i:s)", $userinfo->regdate); ?>
                    <hr />
                <div class="text-center">
                    <?php if($_SESSION['admin']) { ?>
                        <a href="<?php echo Config::GET("settings/baseURL"); ?>/admin/index" class="btn btn-outline-danger btn-sm"><i class="fas fa-lock"></i> АКП</a>
                  <?php  } ?>
                    <a href="<?php echo Config::GET("settings/baseURL"); ?>/settings" class="btn btn-outline-primary btn-sm"><i class="fas fa-cogs"></i> Контролен панел</a>
                    <a href="<?php echo Config::GET("settings/baseURL"); ?>/logout" class="btn btn-outline-danger btn-sm"><i class="fas fa-sign-out-alt"></i> Изход</a>
                </div>
            <?php } else { ?>
                <div class="alert alert-primary text-center">В момента разглеждате сайта като гост, моля влезте в акаунта си за да имате пълен достъп.</div>
                <form method="POST">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-signature"></i></span>
                        <input type="text" name="username" class="form-control" placeholder="Потребителско име">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Парола" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="UserLogin" class="btn btn-outline-success"><i class="fas fa-sign-in-alt"></i> Вход</button>
                        <a href="<?php echo Config::GET("settings/baseURL"); ?>/register" class="btn btn-outline-primary"><i class="fas fa-user-plus"></i> Регистрация</a>
                    </div>
                </form>
                <?php Session::showMessage(); ?>
            <?php } ?>
        </div>
    </div>

</div>
