<!DOCTYPE html>
<html>
  <?php require_once VIEW_PATH.'/_includes/headers.php' ?>
  <body>
    <?php require_once VIEW_PATH.'/_includes/menu.php' ?>

    <div class="container">
      <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= HOME_URI ?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?= HOME_URI.'/usuario' ?>">Usuário</a></li>
<?php
            if(isset($usuario->id)):
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

      <div class="row">
        <div class="col-md-12">
            <h1>Cadastro de Usuários</h1>
        </div>
      </div>

      <?php require_once VIEW_PATH.'/_includes/errorsMessage.php' ?>

      <div class="row">
        <div class="col-md-12">
          <form method="post" id="usuarioForm">
<?php
            if(isset($usuario->id)):
?>
              <input type="hidden" name="id" value="<?= $usuario->id ?>">
<?php
            endif
?>

            <div class="form-group" id="nomeFormGroup">
              <label for="nome">Nome</label>
              <input type="text" class="form-control" name="nome" value="<?= (isset($usuario->nome) ? $usuario->nome : '') ?>" id="nome" placeholder="Pedro Paiva">
            </div>
            <div class="form-group" id="cpfFormGroup">
              <label for="cpf">CPF</label>
              <input type="text" class="form-control cpf" name="cpf" value="<?= (isset($usuario->CPF) ? $usuario->CPF : '') ?>" id="cpf" placeholder="111.111.111-11">
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="<?= HOME_URI.'/usuario' ?>" class="btn btn-danger">Voltar</a>
          </form>
        </div>
      </div>

    </div>

    <?php require_once VIEW_PATH.'/_includes/scripts.php' ?>
    <script type="text/javascript" src="<?= HOME_URI ?>/views/_js/jquery.mask.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function() {

            $('.cpf').mask('000.000.000-00', {reverse: true});
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

        String.prototype.replaceAll = function(search, replacement) {
            var target = this;
            return target.split(search).join(replacement);
        };

        function validarCPF(strCPF) {

            strCPF = strCPF.replaceAll('.', '').replace('-', '');
            var Soma;
            var Resto;
            Soma = 0;
        	  if (strCPF == "00000000000") return false;
            if (strCPF == "11111111111") return false;
            if (strCPF == "22222222222") return false;
            if (strCPF == "33333333333") return false;
            if (strCPF == "44444444444") return false;
            if (strCPF == "55555555555") return false;
            if (strCPF == "66666666666") return false;
            if (strCPF == "77777777777") return false;
            if (strCPF == "88888888888") return false;
            if (strCPF == "99999999999") return false;

        	  for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
        	  Resto = (Soma * 10) % 11;

            if ((Resto == 10) || (Resto == 11))  Resto = 0;
            if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

        	  Soma = 0;
            for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
            Resto = (Soma * 10) % 11;

            if ((Resto == 10) || (Resto == 11))  Resto = 0;
            if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
            return true;
        }

        $('#usuarioForm').submit(function(event) {

            var error = false;
            if($('#nome').val() == '') {
                $('#messages').html('<div class="alert alert-danger" role="alert">Informe o nome do usuário</div>');
                $('#nome').focus();
                $('#nomeFormGroup').addClass('has-error');
                error = true;
            }

            var cpf = $('#cpf').val();
            if(cpf == '' || !validarCPF(cpf)) {
                $('#messages').append('<div class="alert alert-danger" role="alert">Informe o CPF do usuário</div>');
                $('#cpf').focus();
                $('#cpfFormGroup').addClass('has-error');
                error = true;
            }

            if(error) return false;

            return true;
        });
    </script>
  </body>
</html>
