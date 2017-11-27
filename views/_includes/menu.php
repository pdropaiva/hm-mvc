<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?= HOME_URI ?>">HM</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?= ($this->url == HOME_URI.'/' ? 'class="active"' : '') ?>><a href="<?= HOME_URI ?>">Home</a></li>
        <li <?= ($this->url == HOME_URI.'/usuario/' ? 'class="active"' : '') ?>><a href="<?= HOME_URI.'/usuario' ?>">Usuario</a></li>
        <li <?= ($this->url == HOME_URI.'/conta/' ? 'class="active"' : '') ?>><a href="<?= HOME_URI.'/conta' ?>">Conta</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
