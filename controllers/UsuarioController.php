<?php
/**
 *
 */
class UsuarioController extends Controller
{

    public function index() {

        $usuario = new Usuario;
        $usuario->all();
        $errors = $this->getErrors();
        $successes = $this->geSuccesses();

        require_once VIEW_PATH.'/usuario/indexView.php';
    }

    public function cadastra() {

        $errors = $this->getErrors();

        require_once VIEW_PATH.'/usuario/cadastraView.php';
    }

    public function edita($id) {

        $usuario = new Usuario;

        if(!$usuario->find($id)) {

            $this->setError('edita', 'O usuário informado não existe para ser editado.');
            header("Location: ".HOME_URI."/usuario");
            exit;
        }

        require_once VIEW_PATH.'/usuario/cadastraView.php';
    }

    public function salva($id = null) {

        $hasError = false;
        if($this->request['nome'] == '') {

            $this->setError('nome', 'Informe um nome correto para ser cadastrado.');
            $hasError = true;
        }

        if($this->request['cpf'] == '' || !Usuario::validaCPF($this->request['cpf'])) {

            $this->setError('cpf', 'Informe um CPF válido.');
            $hasError = true;
        } else if(!$id && Usuario::verificaCadastroCPF($this->request['cpf'])) {

            $this->setError('cpf', 'Esse CPF já esta cadastrado no sistema.');
            $hasError = true;
        }

        if($hasError) {
            header("Location: ".HOME_URI."/usuario/cadastra.php");
            exit;
        }

        if($id) {

            $usuario = new Usuario;

            if(!Usuario::editaUsuario($this->request)) {

                $usuario->find($id);
                $this->setError('edita', 'Erro ao tentar editar o usuário '.$usuario->nome.', por favor tente novamente mais tarde.');
                header("Location: ".HOME_URI."/usuario");
                exit;
            }

            $usuario->find($id);
            $this->setSuccesses('edita', "Usuário {$usuario->nome} editado com sucesso!");
        } else {

            $id = Usuario::cadastraUsuario($this->request);
        }

        if(!$id) {
            $this->setError('nome', 'Erro ao tentar cadastrar o usuário, por favor tente novamente mais tarde.');
            header("Location: ".HOME_URI."/usuario/cadastra.php");
            exit;
        }

        header("Location: ".HOME_URI."/usuario");
        exit;
    }

    public function excluir($id) {

        $usuario = new Usuario;
        $usuario->find($id);
        if($usuario->delete()) {

            $this->setSuccesses('edita', "Usuário {$usuario->nome} excluído com sucesso!");
        } else {

            $this->setError('nome', 'Erro ao tentar excluír o usuário '.$usuario->nome.', por favor tente novamente mais tarde.');
        }

        header("Location: ".HOME_URI."/usuario");
        exit;
    }
}
