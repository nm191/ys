<?php
  session_start();
  include($_SERVER['DOCUMENT_ROOT'].'/ys/classes/config.php');
  include 'includes/header.php';
?>
<!--CONTENT-->
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-3">Yellow-Stone</h1>
    <p class="lead">
      Klimlessen registratie e.d.
    </p>
    <p>
      Moet nog uitgebreid worden <?=FontAwesome::Icon('smile');?>
    </p>
    <p>
      <ul class="collection with-header">
        <li class="collection-header"><h5>Wat wil ik nog toevoegen?</h5></li>
        <li class="collection-item"><?= FontAwesome::Icon('greater-than'); ?> Touwenregistratie</li>
        <li class="collection-item"><?= FontAwesome::Icon('greater-than'); ?> Training generator</li>
        <li class="collection-item"><?= FontAwesome::Icon('greater-than'); ?> Routes registratie</li>
        <li class="collection-item"><?= FontAwesome::Icon('greater-than'); ?> Wedstrijd administratie</li>
      </ul>
    </p>
  </div>
</div>
<?php
    include 'includes/footer.php';
?>