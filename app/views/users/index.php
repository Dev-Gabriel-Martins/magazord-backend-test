<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <div class="centraliza">
        <div>
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow-sm mb-3" style="width: 28rem;">
                <div class="container-fluid">
                    <a class="navbar-brand fw-bold" href="/users">Magazord</a>
                    <div>
                        <a class="nav-link" href="/contacts">Contatos</a>
                    </div>
                </div>
            </nav>
            <!-- /Navbar -->

            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Lista de Usuários</span>
                    <a href="/users/create" class="btn btn-primary btn-sm">Novo Usuário</a>
                </div>
                {if $users}
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <form method="GET" action="/users">
                            <input class="form-control form-control-sm" type="search" name="search" placeholder="Pesquisar por nome">
                        </form>
                    </li>
                    {foreach $users as $user}
                    <li class="list-group-item">
                        <div>
                            <strong>{$user->name()}</strong>
                            <div class="text-muted small">CPF: {$user->cpf()}</div>
                        </div>
                        <div>
                            <a href="/users/{$user->id()}/edit" class="btn btn-outline-secondary btn-sm me-2">Editar</a>
                            <form action="/users/{$user->id()}" method="POST" class="d-inline">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-outline-danger btn-sm">Excluir</button>
                            </form>
                        </div>
                    </li>
                    {/foreach}
                </ul>
                {else}
                <div class="alert alert- text-center m-3">Nenhum usuário cadastrado.</div>
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
        margin-top: 64px;
        min-height: 100vh;
        display: flex;
        align-items: flex-start;
        justify-content: center;
    }
    .content-box {
        /* Espaço do topo */
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