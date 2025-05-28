<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <div class="centraliza">
        <div class="card shadow">
            <div class="card-header">
                Editar Usuário
            </div>
            <div class="card-body">
                {if isset($errors) && $errors}
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        {foreach $errors as $error}
                        <li>{$error}</li>
                        {/foreach}
                    </ul>
                </div>
                {/if}

                <form action="/users/{$user->id()}" method="POST" autocomplete="off">
                    <input type="hidden" name="_method" value="PUT">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required value="{$user->name()}">
                    </div>
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" maxlength="11" required value="{$user->cpf()}">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="/users" class="btn btn-outline-secondary btn-sm">Voltar</a>
                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
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

    .card,
    .flash-message {
        width: 28rem;
    }

    .card {
        margin-top: 12rem;
    }

    .flash-message {
        margin-top: 24px;
    }

    .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>

</html>