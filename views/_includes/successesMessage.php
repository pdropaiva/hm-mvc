<div class="row">
<?php
if(isset($successes) && $successes):
  foreach($successes as $success):
?>
    <div class="alert alert-success" role="alert"><?= $success ?></div>
<?php
  endforeach;
endif
?>
</div>
