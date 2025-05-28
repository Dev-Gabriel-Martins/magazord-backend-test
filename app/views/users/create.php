<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Novo Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="centraliza">
        <div class="card shadow">
            <div class="card-header">
                Novo Usuário
            </div>
            <div class="card-body">
                {if isset($errors) && $errors}
                {foreach $errors as $error}
                    <div class="alert alert-danger"> {$error}</div>
                {/foreach}
                {/if}

                <form action="/users" method="POST" autocomplete="off">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required value="{$old['name'] ?? ''}">
                    </div>
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" maxlength="11" required value="{$old['cpf'] ?? ''}">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="/users" class="btn btn-outline-secondary btn-sm">Voltar</a>
                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
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
            margin-top: 15rem;
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
</body>

</html>