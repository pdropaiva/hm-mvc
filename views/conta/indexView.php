<!DOCTYPE html>
<html>
  <?php require_once VIEW_PATH.'/_includes/headers.php' ?>
  <body>
    <?php require_once VIEW_PATH.'/_includes/menu.php' ?>

    <div class="container">
      <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= HOME_URI ?>">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Conta</li>
        </ol>
      </nav>

      <div class="row">
        <div class="col-md-12">
            <h1>Lista de Contas</h1>
        </div>
      </div>

      <div class="row">
          <div class="col-md-12">
              <a href="<?= HOME_URI.'/conta/cadastra.php' ?>" class="btn btn-primary">Cadastrar</a>
          </div>
      </div>

      <?php require_once VIEW_PATH.'/_includes/errorsMessage.php' ?>
      <?php require_once VIEW_PATH.'/_includes/successesMessage.php' ?>

      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
    <?php
              if($conta->count() > 0):
    ?>
                  <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Banco</th>
                        <th>Usuario</th>
                        <th>Ação</th>
                    </tr>
    <?php
                    while($conta->hasNext()):
    ?>                <tr>
                          <td><?= $conta->id ?></td>
                          <td><?= $conta->banco ?></td>
                          <td><?= $conta->getUsuarios()->showNomeFormated() ?></td>
                          <td>
                            <a href="<?= HOME_URI.'/conta/transferencia.php?conta_id='.$conta->id ?>" title="Transferência"><span class="glyphicon glyphicon-transfer" aria-hidden="true"></span></a>
                            <a href="<?= HOME_URI.'/conta/extrato.php?id='.$conta->id ?>" title="Extrato"><span class="glyphicon glyphicon-list" aria-hidden="true"></span></a>
                            <a href="<?= HOME_URI.'/conta/edita.php?id='.$conta->id ?>" title="Editar"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                            <a href="<?= HOME_URI.'/conta/excluir.php?id='.$conta->id ?>" title="Excluir"><span class="alert-danger glyphicon glyphicon-remove delete" aria-hidden="true"></span></a>
                          </td>
                      </tr>
    <?php
                    endwhile
    ?>
                  </table>
    <?php
              else:
    ?>
                  <table  class="table">
                      <td class="danger text-center">Não existe conta cadastrado!</td>
                  </table>
    <?php
              endif
    ?>
          </div>
        </div>
      </div>
    </div>

    <?php require_once VIEW_PATH.'/_includes/scripts.php' ?>
    <script type="text/javascript">

        $(function() {

            $('.delete').click(function(event) {
                if(confirm('Você realmente deseja excluír essa conta?')) {
                    return true;
                }

                return false;
            });
        });
    </script>
  </body>
</html>
