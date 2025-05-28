{* filepath: /home/note/magazord-backend-test/app/views/contacts/edit.latte *}
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Contato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="centraliza">
        <div class="card shadow">
            <div class="card-header">Editar Contato</div>
            <div class="card-body">
                {ifset $errors}
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        {foreach $errors as $error}
                        <li>{$error}</li>
                        {/foreach}
                    </ul>
                </div>
                {/ifset}
                <form action="/contacts/{$contact->id()}" method="POST" autocomplete="off">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Usuário</label>
                        <select class="form-select" id="user_id" name="user_id" required>
                            {foreach $users as $user}
                            <option value="{$user->id()}" {if $contact->user() && $contact->user()->id() == $user->id()}selected{/if}>
                                {$user->name()} ({$user->cpf()})
                            </option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Tipo</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="0" {if !$contact->type()}selected{/if}>Telefone</option>
                            <option value="1" {if $contact->type()}selected{/if}>Email</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição</label>
                        <input type="text" class="form-control" id="description" name="description" required value="{$contact->description()}">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="/contacts" class="btn btn-outline-secondary">Voltar</a>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<style>
    body {
        background: #f8fafc;
    }

    .centraliza {
        min-height: 100vh;
        display: flex;
        align-items: flex-start;
        justify-content: center;
    }

    .card {
        width: 28rem;
        margin-top: 48px;
    }
</style>

</html>