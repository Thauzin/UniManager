@extends('layouts.sistema')

@section('title', 'Gerenciar Usuários')

@section('content')
    <main class="app-main">
        <div class="app-content">
            <div class="container-fluid">

                {{-- Cabeçalho --}}
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h1 class="fw-bold mb-1">Gerenciar Usuários</h1>
                        <p class="text-muted mb-0">
                            Administre os acessos ao sistema
                        </p>
                    </div>

                    <button class="btn btn-dark px-4" onclick="openUserModal()">
                        <i class="bi bi-person-plus me-2"></i>
                        Novo Usuário
                    </button>
                </div>

                {{-- Cards --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body text-center">
                                <small class="text-muted">Total de Usuários</small>
                                <h2 class="fw-bold mb-0">{{ $users->count() }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body text-center">
                                <small class="text-muted">Administradores</small>
                                <h2 class="fw-bold text-primary mb-0">
                                    {{ $users->where('access_level.id', 1)->count() }}
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body text-center">
                                <small class="text-muted">Professores</small>
                                <h2 class="fw-bold text-success mb-0">
                                    {{ $users->where('access_level.id', 3)->count() }}
                                </h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body text-center">
                                <small class="text-muted">Alunos</small>
                                <h2 class="fw-bold text-purple mb-0">
                                    {{ $users->where('access_level.id', 2)->count() }}
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tabela --}}
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">

                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0">
                                    <i class="bi bi-search"></i>
                                </span>

                                <input type="text" class="form-control border-0 bg-light"
                                    placeholder="Buscar por nome ou e-mail..." id="searchUser">
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>E-mail</th>
                                        <th>Nível de Acesso</th>
                                        <th>Status</th>
                                        <th class="text-end">Ações</th>
                                    </tr>
                                </thead>

                                <tbody id="tbodyProdutos">
                                    @foreach ($users as $user)
                                        <tr class="border-top border-bottom">
                                            <td class="fw-semibold">
                                                {{ $user->name }}
                                            </td>

                                            <td>
                                                {{ $user->email ?? '-' }}
                                            </td>

                                            <td>
                                                @php
                                                    $badgeClass = match (strtolower($user->access_level->name)) {
                                                        'administrador' => 'bg-primary-subtle text-primary',
                                                        'gestor' => 'bg-success-subtle text-success',
                                                        default => 'bg-secondary-subtle text-secondary',
                                                    };
                                                @endphp

                                                <span class="badge rounded-pill {{ $badgeClass }}">
                                                    {{ $user->access_level->name }}
                                                </span>
                                            </td>

                                            <td>
                                                <span class="badge bg-success-subtle text-success rounded-pill">
                                                    Ativo
                                                </span>
                                            </td>

                                            <td class="text-end">
                                                <div class="d-inline-flex gap-2">

                                                    <button class="btn btn-light border btn-sm"
                                                        onclick='editUser(@json($user))'>
                                                        <i class="bi bi-pencil"></i>
                                                    </button>

                                                    <button class="btn btn-light border btn-sm text-danger"
                                                        onclick="openDeleteModal({{ $user->id }})">
                                                        <i class="bi bi-trash"></i>
                                                    </button>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        {{-- Modal --}}
        <div class="modal fade" id="deleteModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">
                            Confirmar exclusão
                        </h5>
                    </div>

                    <div class="modal-body">
                        Tem certeza que deseja excluir este usuário?
                    </div>

                    <div class="modal-footer">

                        <button class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancelar
                        </button>

                        <form id="deleteForm" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">
                                Sim, excluir
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="userModal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 rounded-4">

                    <div class="modal-header border-0 pb-0">
                        <div>
                            <h3 class="fw-bold mb-1" id="modalTitle">
                                Novo Usuário
                            </h3>

                            <p class="text-muted mb-0">
                                Preencha os dados para criar um novo usuário
                            </p>
                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>

                    <form id="userForm" method="POST">

                        @csrf

                        <div id="methodField"></div>

                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Nome Completo
                                </label>

                                <input type="text" name="name" id="name" class="form-control custom-input">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    E-mail
                                </label>

                                <input type="email" name="email" id="email" class="form-control custom-input">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Usuário
                                </label>

                                <input type="text" name="username" id="username" class="form-control custom-input">
                            </div>

                            <div class="row">

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        Senha
                                        <span class="text-danger" id="passwordRequired">*</span>
                                    </label>

                                    <input type="password" name="password" id="password"
                                        class="form-control custom-input">

                                    <div class="mt-2">

                                        <div class="progress" style="height:5px;border-radius:999px;background:#e9ecef">

                                            <div id="password-strength-bar" class="progress-bar bg-danger"
                                                style="width:0%;transition:.25s;">
                                            </div>

                                        </div>

                                        <div id="password-feedback" class="small mt-2 text-muted">

                                            A senha deve conter:
                                            8 caracteres,
                                            maiúscula,
                                            minúscula,
                                            número e símbolo.

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <label class="form-label fw-semibold">
                                        Confirmar Senha
                                        <span class="text-danger" id="confirmPasswordRequired">*</span>
                                    </label>

                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control custom-input">

                                </div>

                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Tipo de Acesso
                                </label>

                                <select name="access_level_id" id="access_level_id" class="form-select custom-input">

                                    @foreach ($access_levels as $access_level)
                                        <option value="{{ $access_level->id }}">
                                            {{ $access_level->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                        </div>

                        <div class="modal-footer border-0 pt-0">
                            <button type="submit" class="btn btn-dark px-4">
                                Salvar Usuário
                            </button>

                            <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                                Cancelar
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </main>

    <script>
        function openDeleteModal(id) {
            document.getElementById('deleteForm').action = `/users/${id}`;

            bootstrap.Modal
                .getOrCreateInstance(document.getElementById('deleteModal'))
                .show();
        }

        // Busca
        const searchUser = document.getElementById('searchUser');

        if (searchUser) {
            searchUser.addEventListener('keyup', function() {

                let value = this.value.toLowerCase();

                document.querySelectorAll('#tbodyProdutos tr').forEach(row => {

                    row.style.display =
                        row.innerText.toLowerCase().includes(value) ?
                        '' :
                        'none';

                });
            });
        }

        // Novo usuário
        function openUserModal() {

            document.getElementById('modalTitle').innerText =
                'Novo Usuário';

            document.getElementById('userForm').action =
                "{{ route('users.store') }}";

            document.getElementById('methodField').innerHTML = '';

            document.getElementById('userForm').reset();

            document.getElementById('passwordRequired').style.display =
                'inline';

            document.getElementById('confirmPasswordRequired').style.display =
                'inline';

            document.getElementById('password').placeholder =
                'Senha';

            document.getElementById('password_confirmation').placeholder =
                'Confirmar senha';

            // Reset da barra de força
            strengthBar.style.width = '0%';
            strengthBar.className = 'progress-bar bg-danger';

            feedback.className = 'small mt-2 text-muted';

            feedback.innerHTML =
                'A senha deve conter: 8 caracteres, maiúscula, minúscula, número e símbolo.';

            bootstrap.Modal
                .getOrCreateInstance(document.getElementById('userModal'))
                .show();
        }

        // Editar usuário
        function editUser(user) {

            document.getElementById('modalTitle').innerText =
                'Editar Usuário';

            document.getElementById('userForm').action =
                `/users/${user.id}`;

            document.getElementById('methodField').innerHTML =
                '<input type="hidden" name="_method" value="PUT">';

            document.getElementById('name').value =
                user.name ?? '';

            document.getElementById('email').value =
                user.email ?? '';

            document.getElementById('username').value =
                user.username ?? '';

            document.getElementById('access_level_id').value =
                user.access_level_id ?? '';

            document.getElementById('password').value = '';

            document.getElementById('password_confirmation').value = '';

            document.getElementById('passwordRequired').style.display =
                'none';

            document.getElementById('confirmPasswordRequired').style.display =
                'none';

            document.getElementById('password').placeholder =
                'Preencha apenas para alterar';

            document.getElementById('password_confirmation').placeholder =
                'Confirme apenas para alterar';

            // Reset da barra de força
            strengthBar.style.width = '0%';
            strengthBar.className = 'progress-bar bg-danger';

            feedback.className = 'small mt-2 text-muted';

            feedback.innerHTML =
                'A senha deve conter: 8 caracteres, maiúscula, minúscula, número e símbolo.';

            bootstrap.Modal
                .getOrCreateInstance(document.getElementById('userModal'))
                .show();
        }

        // Força da senha
        const passwordInput =
            document.getElementById('password');

        const strengthBar =
            document.getElementById('password-strength-bar');

        const feedback =
            document.getElementById('password-feedback');

        if (passwordInput && strengthBar && feedback) {

            passwordInput.addEventListener('input', function() {

                const password = this.value;

                let score = 0;

                const validations = {
                    length: password.length >= 8,
                    lowercase: /[a-z]/.test(password),
                    uppercase: /[A-Z]/.test(password),
                    number: /\d/.test(password),
                    symbol: /[^A-Za-z0-9]/.test(password)
                };

                Object.values(validations).forEach(valid => {
                    if (valid) score++;
                });

                const progress = (score / 5) * 100;

                strengthBar.style.width = progress + '%';

                strengthBar.className = 'progress-bar';

                if (score <= 2) {

                    strengthBar.classList.add('bg-danger');

                } else if (score <= 4) {

                    strengthBar.classList.add('bg-warning');

                } else {

                    strengthBar.classList.add('bg-success');

                }

                let missing = [];

                if (!validations.length) {
                    missing.push('8 caracteres');
                }

                if (!validations.lowercase) {
                    missing.push('minúscula');
                }

                if (!validations.uppercase) {
                    missing.push('maiúscula');
                }

                if (!validations.number) {
                    missing.push('número');
                }

                if (!validations.symbol) {
                    missing.push('símbolo');
                }

                if (password.length === 0) {

                    feedback.className =
                        'small mt-2 text-muted';

                    feedback.innerHTML =
                        'A senha deve conter: 8 caracteres, maiúscula, minúscula, número e símbolo.';

                    strengthBar.style.width = '0%';

                    strengthBar.className =
                        'progress-bar bg-danger';

                    return;
                }

                if (score === 5) {

                    feedback.className =
                        'small mt-2 text-success fw-semibold';

                    feedback.innerHTML =
                        '<i class="bi bi-check-circle-fill me-1"></i>Senha forte';

                } else {

                    feedback.className =
                        'small mt-2 text-warning';

                    feedback.innerHTML =
                        '<i class="bi bi-shield-exclamation me-1"></i>Falta: ' +
                        missing.join(', ');

                }

            });

        }
    </script>

    <style>
        .card {
            border-radius: 18px;
        }

        .table thead th {
            font-weight: 600;
            border-bottom: 1px solid #e9ecef;
        }

        .table td {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .bg-success-subtle {
            background: #e8f8ee;
        }

        .bg-primary-subtle {
            background: #e9f0ff;
        }

        .bg-secondary-subtle {
            background: #f1f3f5;
        }

        .text-purple {
            color: #7c3aed;
        }

        .custom-input {
            background: #f5f5f7;
            border: none;
            border-radius: 12px;
            height: 48px;
        }

        .custom-input:focus {
            background: #f5f5f7;
            box-shadow: none;
            border: 1px solid #0d6efd;
        }

        .modal-content {
            border-radius: 20px;
        }
    </style>
@endsection
