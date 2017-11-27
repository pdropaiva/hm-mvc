<?php
/**
 *
 */
class ContaController extends Controller
{

    public function index() {

        $conta = new Conta;
        $conta->all();
        $errors = $this->getErrors();
        $successes = $this->geSuccesses();

        require_once VIEW_PATH.'/conta/indexView.php';
    }

    public function cadastra() {

        $errors = $this->getErrors();
        $usuario = new Usuario;
        $usuario->all();
        $ids = array();

        require_once VIEW_PATH.'/conta/cadastraView.php';
    }

    public function edita($id) {

        $errors = $this->getErrors();
        $conta = new Conta;

        if(!$conta->find($id)) {

            $this->setError('edita', 'A conta informada não existe para ser editada.');
            header("Location: ".HOME_URI."/conta");
            exit;
        }

        $usuario = new Usuario;
        $usuario->all();
        $ids = $conta->getUsuariosIds();

        require_once VIEW_PATH.'/conta/cadastraView.php';
    }

    public function salva($id = null) {

        $hasError = false;

        if($this->request['banco'] == '') {

            $this->setError('banco', 'Informe um banco para ser cadastrado.');
            $hasError = true;
        }

        if(!isset($this->request['usuarios']) || $this->request['usuarios'] == '') {

            $this->setError('usuarios', 'Selecione pelo menos um usuário para essa conta.');
            $hasError = true;
        }

        if($hasError) {
            header("Location: ".HOME_URI."/conta/cadastra.php");
            exit;
        }

        if($id) {

            if(!Conta::editaConta($this->request)) {

                $this->setError('edita', 'Erro ao tentar editar a conta '.$id.', por favor tente novamente mais tarde.');
                header("Location: ".HOME_URI."/conta");
                exit;
            }

            $this->setSuccesses('edita', "Conta {$id} editada com sucesso!");
        } else {

           $id = Conta::cadastraConta($this->request);
        }

        if(!$id) {
            $this->setError('nome', 'Erro ao tentar cadastrar a conta, por favor tente novamente mais tarde.');
            header("Location: ".HOME_URI."/conta/cadastra.php");
            exit;
        }

        header("Location: ".HOME_URI."/conta");
        exit;
    }

    public function excluir($id) {

        $conta = new Conta;
        $conta->find($id);
        $conta->excluiUsuarios();

        if($conta->delete()) {

            $this->setSuccesses('edita', "Conta {$id} excluída com sucesso!");
        } else {

            $this->setError('nome', 'Erro ao tentar excluír a conta '.$id.', por favor tente novamente mais tarde.');
        }

        header("Location: ".HOME_URI."/conta");
        exit;
    }
}
