<div class="row" id="messages">
<?php
if(isset($errors) && $errors):
  foreach($errors as $error):
?>
    <div class="alert alert-danger" role="alert"><?= $error ?></div>
<?php
  endforeach;
endif
?>
</div>
