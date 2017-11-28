<!DOCTYPE html>
<html>
  <?php require_once VIEW_PATH.'/_includes/headers.php' ?>
  <body>
    <?php require_once VIEW_PATH.'/_includes/menu.php' ?>

    <div class="container">
      <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= HOME_URI ?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= HOME_URI.'/conta' ?>">Conta</a></li>
          <li class="breadcrumb-item active" aria-current="page">Transferência</li>
        </ol>
      </nav>

      <div class="row">
        <div class="col-md-12">
            <h1>Transferência</h1>
        </div>
      </div>

      <?php require_once VIEW_PATH.'/_includes/errorsMessage.php' ?>

      <div class="row">
        <div class="col-md-12">
          <form method="post" id="contaForm">
<?php
            if(isset($transferencia->id)):
?>
              <input type="hidden" name="id" value="<?= $transferencia->id ?>">
<?php
            endif
?>
            <input type="hidden" name="conta_id" value="<?= $conta_id ?>">
            <div class="form-group" id="valorFormGroup">
              <label for="usuario">Usuario</label>
              <input type="text" class="form-control" name="usuario" value="<?= $conta->getUsuarios()->showNomeFormated() ?>" id="usuario" disabled>
            </div>
            <div class="form-group" id="valorFormGroup">
              <label for="valor">Valor</label>
              <input type="text" class="form-control money" name="valor" value="<?= (isset($transferencia->valor) ? $transferencia->valor : '') ?>" id="valor" placeholder="100,00">
            </div>
            <div class="form-group" id="data_previstaFormGroup">
              <label for="data_prevista">Data prevista</label>
              <input type="text" class="form-control" name="data_prevista" value="<?= (isset($transferencia->data_prevista) ? $transferencia->data_prevista : '') ?>" id="data_prevista">
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="<?= HOME_URI.'/conta' ?>" class="btn btn-danger">Voltar</a>
          </form>
        </div>
      </div>

    </div>

    <?php require_once VIEW_PATH.'/_includes/scripts.php' ?>
    <script type="text/javascript" src="<?= HOME_URI ?>/views/_js/jquery.mask.min.js"></script>
    <script type="text/javascript" src="<?= HOME_URI ?>/views/_js/jquery-ui.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function() {

            $('.money').mask('000.000.000.000.000,00', {reverse: true});
            $( "#data_prevista" ).datepicker({ minDate: 0});
            $( "#data_prevista" ).datepicker("option", "dateFormat", 'dd/mm/yy');
<?php
            if($errors):
              foreach($errors as $field => $error):
?>
                $('#<?= $field ?>').focus();
                $('#<?= $field ?>FormGroup').addClass('has-error');
<?php
              endforeach;
            endif
?>
        });

        $('#contaForm').submit(function(event) {

            var error = false;
            if($('#valor').val() == '' && $('#valor').val() == 0) {
                $('#messages').html('<div class="alert alert-danger" role="alert">Informe o valor da transferência</div>');
                $('#valor').focus();
                $('#valorFormGroup').addClass('has-error');
                error = true;
            }

            var data_prevista = $('#data_prevista').val();

            if(data_prevista == '') {
                $('#messages').append('<div class="alert alert-danger" role="alert">Selecione a data da transferência</div>');
                $('#data_prevista').focus();
                $('#data_previstaFormGroup').addClass('has-error');
                error = true;
            }

            if(error) return false;

            return true;
        });
    </script>
  </body>
</html>
