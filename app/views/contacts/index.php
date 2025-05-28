<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Contatos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="centraliza">
        <div class="content-box">
            <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow-sm mb-3">
                <div class="container-fluid">
                    <a class="navbar-brand fw-bold" href="/users">Magazord</a>
                    <div>
                        <a class="nav-link" href="/users">Usuários</a>
                    </div>
                </div>
            </nav>
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Lista de Contatos</span>
                    <a href="/contacts/create" class="btn btn-primary btn-sm">Novo Contato</a>
                </div>
                {if $contacts}
                    <ul class="list-group list-group-flush">
                        {foreach $contacts as $contact}
                            <li class="list-group-item">
                                <div>
                                    <strong>{$contact->description()|escapeHtml}</strong>
                                    <div class="text-muted small">
                                        {$contact->type() ? 'Email' : 'Telefone'} |
                                        {$contact->user() ? $contact->user()->id() : '-'}
                                    </div>
                                </div>
                                <div>
                                    <a href="/contacts/{$contact->id()}/edit" class="btn btn-outline-secondary btn-sm me-2">Editar</a>
                                    <form action="/contacts/{$contact->id()}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este contato?');">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Excluir</button>
                                    </form>
                                </div>
                            </li>
                        {/foreach}
                    </ul>
                {else}
                    <div class="alert alert-info text-center m-3">Nenhum contato cadastrado.</div>
                {/if}
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

    .content-box {
        margin-top: 64px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .card,
    .navbar {
        width: 28rem;
    }

    .list-group-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
</html>