<nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/home/"><i class="fas fa-chart-bar"></i> <?php echo Config::GET("settings/siteName"); ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="<?php echo Config::GET("settings/baseURL"); ?>/home"><i class="fas fa-home"></i> Начало</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo Config::GET("settings/baseURL"); ?>/allServers"><i class="fas fa-list-ol"></i> Всички сървъри</a></li>
            </ul>
        </div>
    </div>
</nav>