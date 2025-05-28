<?php

namespace app\controlles;

use core\classes\Controller;
use app\repositories\UserRepository;

class UserController extends Controller
{
    private UserRepository $repo;
    private string $flashMessage = "";

    public function __construct()
    {
        global $entityManager;
        $this->repo = new UserRepository($entityManager);
    }

    public function index()
    {
        $search = trim($_GET['search'] ?? '');
        $users = match (true) {
            $search !== '' => $this->repo->searchByName($search),
            default => $this->repo->all(),
        };

        $this->render('users/index', ['users' => $users, 'sucess' => $this->flashMessage]);
    }

    public function create()
    {
        $this->render('users/create');
    }

    public function store()
    {
        $data = $_POST;
        $name = trim($data['name'] ?? '');
        $cpf = trim($data['cpf'] ?? '');

        $errors = [];

        if (!$name || !$cpf) {
            $errors[] = "Nome e CPF são obrigatórios.";
        }

        if ($this->repo->findByCpf($cpf)) {
            $errors[] = "CPF já cadastrado.";
        }

        if ($errors) {
            $this->render('users/create', ['errors' => $errors, 'old' => $data]);
            return;
        }

        try {

            $this->repo->create($name, $cpf);

            $this->flashMessage = "Usuário criado com sucesso";

            $this->index();
        } catch (\InvalidArgumentException $e) {
            $this->render('users/create', [
                'errors' => [$e->getMessage()],
                'old' => $data
            ]);
        }
    }

    public function edit($id)
    {
        $user = $this->repo->find($id);

        if (!$user) {
            $this->renderNotFound();
            return;
        }

        $this->render('users/edit',  ['user' => $user]);
    }

    public function update($id)
    {
        $user = $this->repo->find($id);

        if (!$user) {
            $this->renderNotFound();
            return;
        }

        $data = $_POST;
        $name = trim($data['name'] ?? '');
        $cpf = trim($data['cpf'] ?? '');

        $errors = [];

        if (!$name || !$cpf) {
            $errors[] = "Nome e CPF são obrigatórios.";
        }

        $existingUser = $this->repo->findByCpf($cpf);
        if ($existingUser && $existingUser->id() != $user->id()) {
            $errors[] = "CPF já cadastrado.";
        }

        if ($errors) {
            $this->render('users/edit', [
                'errors' => $errors,
                'user' => $user
            ]);
            return;
        }

        $this->repo->update($user, $name, $cpf);
        $this->flashMessage = "Usuário atualizado com sucesso.";
        $this->index();
    }

    public function destroy($id)
    {
        $user = $this->repo->find($id);

        if (!$user) {
            $this->renderNotFound();
            return;
        }

        $this->repo->delete($user);

        $this->flashMessage = "Usuário excluido com sucesso";

        $this->index();
    }
}
