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
          <li class="breadcrumb-item active" aria-current="page">Extrato</li>
        </ol>
      </nav>

      <div class="row">
        <div class="col-md-12">
            <h1>Extrato</h1>
        </div>
      </div>

      <div class="row">
          <div class="col-md-12">
              <a href="<?= HOME_URI.'/conta/transferencia.php?conta_id='.$id ?>" class="btn btn-primary">Transferência</a>
          </div>
      </div>

      <div class="row">
          <div class="col-md-12">
              <form method="post">
                  <div class="form-group col-md-6">
                    <label for="from">Data inicial</label>
                    <input type="text" class="form-control datepicker" name="from" value="<?= (isset($this->request['from'])) ? $this->request['from'] : '' ?>" id="from">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="to">Data final</label>
                    <input type="text" class="form-control datepicker" name="to" value="<?= (isset($this->request['to'])) ? $this->request['to'] : '' ?>" id="to">
                  </div>
                  <div class="col-md-12">
                      <button type="submit" class="btn btn-primary  pull-right">Buscar</button>
                  </div>
              </form>
          </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
    <?php
              if($transacao->count() > 0):
    ?>
                  <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Valor</th>
                        <th>Data Prevista</th>
                        <th>Status</th>
                        <th>Data Realizada</th>
                    </tr>
    <?php
                    while($transacao->hasNext()):
    ?>                <tr>
                          <td><?= $transacao->id ?></td>
                          <td><?= $transacao->valor ?></td>
                          <td><?= $transacao->data_prevista->format('d/m/Y') ?></td>
                          <td><?= Transacao::status[$transacao->status] ?></td>
                          <td><?= isset($transacao->data_realizada) ? $transacao->data_realizada->format('d/m/Y') : '-' ?></td>
                      </tr>
    <?php
                    endwhile
    ?>
                  </table>
    <?php
              else:
    ?>
                  <table  class="table">
                      <td class="danger text-center">Não transação para a conta!</td>
                  </table>
    <?php
              endif
    ?>
          </div>
        </div>
      </div>
    </div>

    <?php require_once VIEW_PATH.'/_includes/scripts.php' ?>
    <script type="text/javascript" src="<?= HOME_URI ?>/views/_js/jquery-ui.min.js"></script>
    <script type="text/javascript">

    $( function() {
        $( ".datepicker" ).datepicker();
        $( ".datepicker" ).datepicker("option", "dateFormat", 'dd/mm/yy');
    } );
    </script>
  </body>
</html>
