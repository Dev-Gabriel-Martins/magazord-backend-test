<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Contato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="centraliza">
    <div class="card shadow">
        <div class="card-header">Novo Contato</div>
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
            <form action="/contacts" method="POST" autocomplete="off">
                <div class="mb-3">
                    <label for="user_id" class="form-label">Usuário</label>
                    <select class="form-select" id="user_id" name="user_id" required>
                        <option value="">Selecione...</option>
                        {foreach $users as $user}
                            <option value="{$user->id()}" {ifset $old['user_id']}{if $old['user_id'] == $user->id()}selected{/if}{/ifset}>
                                {$user->name()} ({$user->cpf()})
                            </option>
                        {/foreach}
                    </select>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Tipo</label>
                    <select class="form-select" id="type" name="type" required>
                        <option value="0" {ifset $old['type']}{if $old['type'] == '0'}selected{/if}{/ifset}>Telefone</option>
                        <option value="1" {ifset $old['type']}{if $old['type'] == '1'}selected{/if}{/ifset}>Email</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descrição</label>
                    <input type="text" class="form-control" id="description" name="description" required value="{$old['description'] ?? ''}">
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
        body { background: #f8fafc; }
        .centraliza {
            min-height: 100vh;
            display: flex;
            align-items: flex-start;
            justify-content: center;
        }
        .card { width: 28rem; margin-top: 48px; }
    </style>
</html>