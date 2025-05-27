<?php

namespace app\controlles;

use core\classes\Controller;
use app\repositories\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserController extends Controller
{
    private UserRepository $repo;

    public function __construct()
    {
        global $entityManager;
        $this->repo = new UserRepository($entityManager);
    }


    public function index()
    {
        $users = $this->repo->all();
     
        $this->render('users/index', ['users' => $users]);
    }

    public function create()
    {
        $this->render('users/create');
    }

    public function show($id)
    {
        $user = $this->repo->find($id);

        if (!$user) {
            http_response_code(404);
            echo "Usuário não encontrado.";
            return;
        }

        echo "ID: {$user->id()} | Nome: {$user->name()} | CPF: {$user->cpf()}";
    }

    public function store()
    {
        $data = $_POST;
        $name = trim($data['name'] ?? '');
        $cpf = trim($data['cpf'] ?? '');

        if (!$name || !$cpf) {
            http_response_code(400);
            echo "Nome e CPF são obrigatórios.";
            return;
        }
        if (!preg_match('/^\d{11}$/', $cpf)) {
            http_response_code(400);
            echo "CPF deve ter 11 dígitos numéricos.";
            return;
        }
        if ($this->repo->findByCpf($cpf)) {
            http_response_code(400);
            echo "CPF já cadastrado.";
            return;
        }

        $user = $this->repo->create($name, $cpf);
        http_response_code(201);
        echo "Usuário criado com ID: " . $user->id();
    }

    public function update($id)
    {
        $user = $this->repo->find($id);
        if (!$user) {
            http_response_code(404);
            echo "Usuário não encontrado.";
            return;
        }
        $data = $_POST;
        $name = trim($data['name'] ?? '');

        if (!$name) {
            http_response_code(400);
            echo "Nome é obrigatório.";
            return;
        }

        // Não permite atualizar CPF
        $this->repo->update($user, $name);
        echo "Usuário atualizado.";
    }

    public function destroy($id)
    {
        $user = $this->repo->find($id);
        if (!$user) {
            http_response_code(404);
            echo "Usuário não encontrado.";
            return;
        }
        $this->repo->delete($user);
        echo "Usuário e contatos removidos.";
    }
}
