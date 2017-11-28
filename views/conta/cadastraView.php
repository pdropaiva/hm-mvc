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
<?php
            if(isset($conta->id)):
?>
              <li class="breadcrumb-item active" aria-current="page">Editar</li>
<?php
            else:
?>
              <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
<?php
            endif
?>
        </ol>
      </nav>

<?php
            if(isset($conta->id)):
?>
              <div class="row">
                <div class="col-md-12">
                    <h1>Edição de Contas</h1>
                </div>
              </div>
<?php
            else:
?>
              <div class="row">
                <div class="col-md-12">
                    <h1>Cadastro de Contas</h1>
                </div>
              </div>
<?php
            endif
?>

      <?php require_once VIEW_PATH.'/_includes/errorsMessage.php' ?>

      <div class="row">
        <div class="col-md-12">
          <form method="post" id="contaForm">
<?php
            if(isset($conta->id)):
?>
              <input type="hidden" name="id" value="<?= $conta->id ?>">
<?php
            endif
?>

            <div class="form-group" id="bancoFormGroup">
              <label for="banco">Banco</label>
              <input type="text" class="form-control" name="banco" value="<?= (isset($conta->banco) ? $conta->banco : '') ?>" id="banco" placeholder="Bradesco">
            </div>
            <div class="form-group" id="usuariosFormGroup">
              <label for="usuarios">Usuários</label>
              <select class="select2 form-control" name="usuarios[]" id="usuarios" multiple="multiple">
<?php
                while($usuario->hasNext()):
?>
                <option value="<?= $usuario->id ?>" <?= (in_array($usuario->id, $ids) ? 'selected="selected"' : '' ) ?>><?= $usuario->nome ?></option>
<?php
                endwhile;
?>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="<?= HOME_URI.'/conta' ?>" class="btn btn-danger">Voltar</a>
          </form>
        </div>
      </div>

    </div>

    <?php require_once VIEW_PATH.'/_includes/scripts.php' ?>
    <script type="text/javascript" src="<?= HOME_URI ?>/views/_js/select2.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function() {

            $('.select2').select2();
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
            if($('#banco').val() == '') {
                $('#messages').html('<div class="alert alert-danger" role="alert">Informe o banco da conta</div>');
                $('#banco').focus();
                $('#bancoFormGroup').addClass('has-error');
                error = true;
            }

            var usuarios = $('#usuarios').val();

            if(usuarios == '') {
                $('#messages').append('<div class="alert alert-danger" role="alert">Selecione pelo menos um usuário</div>');
                $('#usuarios').focus();
                $('#usuariosFormGroup').addClass('has-error');
                error = true;
            }

            if(error) return false;

            return true;
        });
    </script>
  </body>
</html>
