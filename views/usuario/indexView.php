<!DOCTYPE html>
<html>
  <?php require_once VIEW_PATH.'/_includes/headers.php' ?>
  <body>
    <?php require_once VIEW_PATH.'/_includes/menu.php' ?>

    <div class="container">
      <nav aria-label="breadcrumb" role="navigation">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= HOME_URI ?>">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Usuário</li>
        </ol>
      </nav>

      <div class="row">
        <div class="col-md-12">
            <h1>Lista de Usuários</h1>
        </div>
      </div>

      <div class="row">
          <div class="col-md-12">
              <a href="<?= HOME_URI.'/usuario/cadastra.php' ?>" class="btn btn-primary">Cadastrar</a>
          </div>
      </div>

      <?php require_once VIEW_PATH.'/_includes/errorsMessage.php' ?>
      <?php require_once VIEW_PATH.'/_includes/successesMessage.php' ?>

      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
    <?php
              if($usuario->count() > 0):
    ?>
                  <table class="table table-hover">
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Ação</th>
                    </tr>
    <?php
                    while($usuario->hasNext()):
    ?>                <tr>
                          <td><?= $usuario->nome ?></td>
                          <td><?= $usuario->CPF ?></td>
                          <td>
                            <a href="<?= HOME_URI.'/usuario/edita.php?id='.$usuario->id ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                            <a href="<?= HOME_URI.'/usuario/excluir.php?id='.$usuario->id ?>"><span class="alert-danger glyphicon glyphicon-remove delete" aria-hidden="true"></span></a>
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
                      <td class="danger text-center">Não existe usuário cadastrado!</td>
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
                if(confirm('Você realmente deseja excluír esse usuário?')) {
                    return true;
                }

                return false;
            });
        });
    </script>
  </body>
</html>
