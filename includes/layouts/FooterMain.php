<footer class="site-footer mb-auto bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <h1 class="display-4 font-italic"><?php echo Config::GET("settings/siteName"); ?></h1>
                <p class="lead my-0">Мониторинг на игрови сървъри</p>
                <br/>
            </div>

            <div class="col-xs-6 col-md-3">
                <h6>Популярни игри</h6>
                <ul class="footer-links">
                    <li><a href="<?php echo Config::GET("settings/baseURL"); ?>/allservers">Counter-Strike 1.6</a></li>
                    <li><a href="<?php echo Config::GET("settings/baseURL"); ?>/allservers/">Counter-Strike Globall Offensive</a></li>
                    <li><a href="<?php echo Config::GET("settings/baseURL"); ?>/allservers/">San Andreas: Multiplayer</a></li>
                </ul>
            </div>

            <div class="col-xs-6 col-md-3">
                <h6>Бързи връзки</h6>
                <ul class="footer-links">
                    <li><a href="<?php echo Config::GET("settings/baseURL"); ?>/add_server">Добави сървър</a></li>
                    <li><a href="<?php echo Config::GET("settings/baseURL"); ?>/register">Регистрация</a></li>
                    <li><a href="<?php echo Config::GET("settings/baseURL"); ?>/settings">Потребителски панел</a></li>
                </ul>
            </div>
        </div>
        <hr/>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-10">
                <p class="copyright-text">Всиички права запазени &copy; <?php echo Config::GET("settings/siteName"); ?> </p>
            </div>
            <div class="col-sm-2">
                <p class="copyright-text">Изработка от <a href="http://webocean.info/">HybridMind</a></p>
            </div>
        </div>
    </div>
</footer>