<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Contatos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <div class="centraliza">
        <div class="content-box">
            <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow-sm mb-3">
                <div class="container-fluid">
                    <a class="navbar-brand fw-bold" href="/users">Magazord</a>
                    <div>
                        <a class="nav-btn" href="/users">Usuários</a>
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
                                {$contact->user()->Name()}
                            </div>
                        </div>
                        <div>
                            <a href="/contacts/{$contact->id()}/edit" class="btn btn-outline-secondary btn-sm me-2">Editar</a>
                            <form action="/contacts/{$contact->id()}" method="POST" class="d-inline">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-outline-danger btn-sm">Excluir</button>
                            </form>
                        </div>
                    </li>
                    {/foreach}
                </ul>
                {else}
                <div class="alert  text-center m-3">Nenhum contato cadastrado.</div>
                {/if}
            </div>
            {if isset($sucess) && trim($sucess) !== ''}
            <div class="flash-message alert alert-success text-center" role="alert">
                {$sucess}
            </div>
            {/if}
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

    .content-box {
        margin-top: 12rem;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .card,
    .navbar,
    .flash-message {
        width: 28rem;
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