<?php
/**
 *
 */
class Conta extends Model
{

    protected $table = 'contas';

    public static function cadastraConta($fields) {

        $conta = new Conta;
        $conta->query("INSERT INTO {$conta->table} (banco) VALUES ('{$fields['banco']}')");

        $id = $conta->getInsertedId();

        $conta->cadastraUsuarioConta($fields['usuarios'], $id);

        return $id;
    }

    public static function editaConta($fields) {

        $conta = new Conta;
        $conta->query("UPDATE {$conta->table} SET banco = '{$fields['banco']}' WHERE id = {$fields['id']}");

        $updated = $conta->getAffectedRows();

        $updated2 = $conta->excluiUsuarios($fields['id']);

        if(!$updated) $updated = $updated2;

        $conta->cadastraUsuarioConta($fields['usuarios'], $fields['id']);

        return $updated;
    }

    private function cadastraUsuarioConta(array $ids, $contaId) {

        $sql = "INSERT INTO usuarioConta (usuario_id, conta_id) VALUES";

        foreach ($ids as $usuarioId) {
          $sql .= " ($usuarioId, $contaId),";
        }

        $sql = substr($sql, 0, -1);

        $this->query($sql);
    }

    public function getUsuarios() {

        $usuario = new Usuario;
        $usuario->getUsuariosPelaConta($this->id);

        return $usuario;
    }

    public function getUsuariosIds() {

        $conta = new Conta;
        $conta->query("SELECT uc.usuario_id FROM usuarioConta as uc WHERE uc.conta_id = {$this->id}");

        $ids = array();

        while($conta->hasNext()) {

            $ids[] = $conta->usuario_id;
        }

        return $ids;
    }

    public function excluiUsuarios($id = null) {

        if(!isset($id)) $id = $this->id;
        $conta = new Conta;
        $conta->query("DELETE FROM usuarioConta WHERE conta_id = {$id}");

        return $conta->getAffectedRows();
    }
}
