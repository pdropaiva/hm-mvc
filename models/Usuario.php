<?php
/**
 *
 */
class Usuario extends Model
{

    protected $table = 'usuarios';

    public static function cadastraUsuario($fields) {

        $usuario = new Usuario;
        $usuario->query("INSERT INTO {$usuario->table} (nome, CPF) VALUES ('{$fields['nome']}', '{$fields['cpf']}')");

        return $usuario->getInsertedId();
    }

    public static function editaUsuario($fields) {

        $usuario = new Usuario;
        $usuario->query("UPDATE {$usuario->table} SET nome = '{$fields['nome']}', CPF = '{$fields['cpf']}' WHERE id = {$fields['id']}");

        return $usuario->getAffectedRows();
    }

    public static function verificaCadastroCPF($cpf = null) {

        $usuario = new Usuario;
        $usuario->query("SELECT COUNT(CPF) as count FROM {$usuario->table} WHERE CPF = '$cpf'")->first();

        return ($usuario->count > 0);
    }

    public function getUsuariosPelaConta($contaId) {

        $this->query("SELECT u.* FROM {$this->table} as u
                        JOIN usuarioConta as uc on u.id = uc.usuario_id
                        JOIN contas as c on uc.conta_id = c.id
                        WHERE c.id = $contaId");
    }

    public function showNomeFormated() {

        $usuarios = '';
        while($this->hasNext()) {
            $usuarios .= $this->nome.', ';
        }

        $usuarios = substr($usuarios, 0, -2);

        return $usuarios;
    }

    public static function validaCPF($cpf = null) {

        // Verifica se um número foi informado
        $cpf = str_replace('-', '', str_replace('.', '', $cpf));

        if(empty($cpf)) {
            return false;
        }

        // Elimina possivel mascara
        $cpf = preg_replace('[^0-9]', '', $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        // Verifica se o numero de digitos informados é igual a 11
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se nenhuma das sequências invalidas abaixo
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999') {
            return false;
         // Calcula os digitos verificadores para verificar se o
         // CPF é válido
         } else {

            for ($t = 9; $t < 11; $t++) {

                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{$c} != $d) {
                    return false;
                }
            }

            return true;
        }
    }
}
