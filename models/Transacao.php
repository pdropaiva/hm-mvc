<?php
/**
 *
 */
class Transacao extends Model
{

    protected $table = 'transacoes';
    protected $dates = [
        'data_prevista',
        'data_realizada'
    ];

    const AGUARDANDO_PAGAMENTO = 0;
    const CANCELADO = 1;
    const PAGO = 2;

    const status = [
      self::AGUARDANDO_PAGAMENTO => 'Aguardando Pagamento',
      self::CANCELADO => 'Cancelado',
      self::PAGO => 'Pago',
    ];

    public static function cadastraTransacao($conta_id, $fields) {

      $transacao = new Transacao;

      $arrayStatus = [
        self::AGUARDANDO_PAGAMENTO,
        self::CANCELADO,
        self::PAGO
      ];

      $status = rand(0, 2);

      if($status == self::PAGO) {
          $data_realizada = date('Y-m-d', strtotime(formataDataBanco($fields['data_prevista'])));
      } else {
          $data_realizada = null;
      }

      $data_prevista = formataDataBanco($fields['data_prevista']);
      $fields['valor'] = formataValor($fields['valor']);

      if($data_realizada) {

          $transacao->query("INSERT INTO {$transacao->table} (conta_id, data_prevista, valor, status, data_realizada)
                  VALUES ({$conta_id}, '$data_prevista', '{$fields['valor']}', $status, '$data_realizada')");
      } else {
          $transacao->query("INSERT INTO {$transacao->table} (conta_id, data_prevista, valor, status)
                  VALUES ({$conta_id}, '$data_prevista', '{$fields['valor']}', $status)");
      }

      return $transacao->getInsertedId();
    }

    public function getTransacaoConta($conta_id, $filters) {

        $sql = "SELECT * FROM {$this->table} WHERE conta_id = $conta_id";

        if(isset($filters['from']) && $filters['from'] != '') {
            $from = formataDataBanco($filters['from']);
            $sql .= " AND data_prevista >= '{$from}'";
        }

        if(isset($filters['to']) && $filters['to'] != '') {
            $to = formataDataBanco($filters['to']);
            $sql .= " AND data_prevista <= '{$to}'";
        }
        $this->query($sql);
    }
}
