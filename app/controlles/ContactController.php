<?php

namespace app\controlles;

use core\classes\Controller;
use app\repositories\ContactRepository;
use app\repositories\UserRepository;

class ContactController extends Controller
{
    private ContactRepository $repo;
    private UserRepository $userRepo;
    private string $flashMessage = "";

    public function __construct()
    {
        global $entityManager;
        $this->repo = new ContactRepository($entityManager);
        $this->userRepo = new UserRepository($entityManager);
    }

    public function index()
    {
        $search = trim($_GET['search'] ?? '');
        $contacts = $search !== ''
            ? $this->repo->searchByDescription($search)
            : $this->repo->all();

        $this->render('contacts/index', [
            'contacts' => $contacts,
            'sucess' => $this->flashMessage
        ]);
    }

    public function create()
    {
        $users = $this->userRepo->all();
        $this->render('contacts/create', ['users' => $users]);
    }

    public function store()
    {
        $data = $_POST;
        $user_id = $data['user_id'] ?? '';
        $type = isset($data['type']) ? (bool)$data['type'] : false;
        $description = trim($data['description'] ?? '');

        $errors = [];
        $user = $this->userRepo->find($user_id);

        if (!$user) {
            $errors[] = "Usuário inválido.";
        }
        if ($description === '') {
            $errors[] = "Descrição é obrigatória.";
        }

        if ($errors) {
            $users = $this->userRepo->all();
            $this->render('contacts/create', [
                'errors' => $errors,
                'users' => $users,
                'old' => $data
            ]);
            return;
        }

        $this->repo->create($user, $type, $description);
        $this->flashMessage = "Contato criado com sucesso.";
        $this->index();
    }

    public function edit($id)
    {
        $contact = $this->repo->find($id);
        
        if (!$contact) {
             $this->renderNotFound();
            return;
        }

        $users = $this->userRepo->all();
        $this->render('contacts/edit', [
            'contact' => $contact,
            'users' => $users
        ]);
    }

    public function update($id)
    {
        $contact = $this->repo->find($id);
        if (!$contact) {
            $this->flashMessage = "Contato não encontrado.";
            $this->index();
            return;
        }

        $data = $_POST;
        $user_id = $data['user_id'] ?? '';
        $type = isset($data['type']) ? (bool)$data['type'] : false;
        $description = trim($data['description'] ?? '');

        $errors = [];
        $user = $this->userRepo->find($user_id);

        if (!$user) {
            $errors[] = "Usuário inválido.";
        }
        if ($description === '') {
            $errors[] = "Descrição é obrigatória.";
        }

        if ($errors) {
            $users = $this->userRepo->all();
            $this->render('contacts/edit', [
                'errors' => $errors,
                'contact' => $contact,
                'users' => $users
            ]);
            return;
        }

        $this->repo->update($contact, $user, $type, $description);
        $this->flashMessage = "Contato atualizado com sucesso.";
        $this->index();
    }

    public function destroy($id)
    {
        $contact = $this->repo->find($id);
        if (!$contact) {
            $this->renderNotFound();
            return;
        }

        $this->repo->delete($contact);
        $this->flashMessage = "Contato removido com sucesso.";
        $this->index();
    }
}