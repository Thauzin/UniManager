@extends('layouts.sistema')

@section('title')
    Usuários | Ministério Melhor Viver
@endsection
@section('meta_title')
    Usuários | Ministério Melhor Viver
@endsection

@push('head')
@endpush

@section('content')
    <main class="app-main">
        <!--begin::App Content Header-->
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="mb-0" id="pageTitle">{{ isset($user) ? 'Editar Usuário' : 'Novo Usuário' }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <!--end::App Content Header-->
        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">

                            <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}"
                                method="POST">

                                @csrf

                                @if (isset($user))
                                    @method('PUT')
                                @endif

                                <div class="card-body">

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Nome <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name', $user->name ?? '') }}" placeholder="Nome">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Usuário <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="username" class="form-control"
                                                value="{{ old('username', $user->username ?? 'Usuário') }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Nível de Acesso <span
                                                    class="text-danger">*</span></label>
                                            <select name="access_level_id" class="form-select">
                                                <option value="">Selecione...</option>
                                                @foreach ($access_levels as $access_level)
                                                    <option value="{{ $access_level->id }}"
                                                        {{ old('access_level_id', $user->access_level_id ?? '') == $access_level->id ? 'selected' : '' }}>
                                                        {{ $access_level->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">
                                                Polo
                                                <span class="text-danger d-none" id="center-required">*</span>
                                            </label>

                                            <select name="center_id" class="form-select">
                                                <option value="">Selecione...</option>

                                                @foreach ($centers as $center)
                                                    <option value="{{ $center->id }}"
                                                        {{ old('center_id', $user->center_id ?? '') == $center->id ? 'selected' : '' }}>
                                                        {{ $center->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">

                                        {{-- SENHA --}}
                                        <div class="col-md-6">

                                            <label class="form-label fw-semibold">
                                                Senha
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="{{ isset($user) ? 'Preencha a senha apenas para trocar' : 'Senha' }}">

                                            {{-- Barra de força --}}
                                            <div class="mt-2">

                                                <div class="progress"
                                                    style="
                    height: 5px;
                    border-radius: 999px;
                    background: #e9ecef;
                ">

                                                    <div id="password-strength-bar" class="progress-bar bg-danger"
                                                        style="
                        width: 0%;
                        transition: all .25s ease;
                    ">
                                                    </div>

                                                </div>

                                                {{-- Feedback --}}
                                                <div id="password-feedback" class="small mt-2 text-muted"
                                                    style="font-size: 12px;">

                                                    A senha deve conter:
                                                    8 caracteres, maiúscula, minúscula,
                                                    número e símbolo.

                                                </div>

                                            </div>

                                        </div>

                                        {{-- CONFIRMAR SENHA --}}
                                        <div class="col-md-6">

                                            <label class="form-label fw-semibold">
                                                Confirmar Senha
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="{{ isset($user) ? 'Preencha a confirmação apenas para trocar' : 'Confirmar Senha' }}">

                                        </div>

                                    </div>

                                    <script>
                                        const passwordInput = document.getElementById('password');
                                        const strengthBar = document.getElementById('password-strength-bar');
                                        const feedback = document.getElementById('password-feedback');

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

                                            // progresso
                                            const progress = (score / 5) * 100;

                                            strengthBar.style.width = progress + '%';

                                            // reset classes
                                            strengthBar.className = 'progress-bar';

                                            // cores
                                            if (score <= 2) {

                                                strengthBar.classList.add('bg-danger');

                                            } else if (score <= 4) {

                                                strengthBar.classList.add('bg-warning');

                                            } else {

                                                strengthBar.classList.add('bg-success');

                                            }

                                            // requisitos faltando
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

                                            // sem senha
                                            if (password.length === 0) {

                                                feedback.className = 'small mt-2 text-muted';

                                                feedback.innerHTML =
                                                    'A senha deve conter: 8 caracteres, maiúscula, minúscula, número e símbolo.';

                                                return;
                                            }

                                            // senha forte
                                            if (score === 5) {

                                                feedback.className = 'small mt-2 text-success fw-semibold';

                                                feedback.innerHTML =
                                                    '<i class="bi bi-check-circle-fill me-1"></i>Senha forte';

                                            } else {

                                                feedback.className = 'small mt-2 text-warning';

                                                feedback.innerHTML =
                                                    '<i class="bi bi-shield-exclamation me-1"></i>Falta: ' +
                                                    missing.join(', ');

                                            }

                                        });
                                    </script>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">
                                        Salvar
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        function toggleCenterRequired() {

            const accessLevel = document.querySelector('[name="access_level_id"]').value;
            const required = document.getElementById('center-required');

            if (accessLevel == 2) {
                required.classList.remove('d-none');
            } else {
                required.classList.add('d-none');
            }
        }

        document.querySelector('[name="access_level_id"]')
            .addEventListener('change', toggleCenterRequired);

        toggleCenterRequired();
    </script>
@endsection
