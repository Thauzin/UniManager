@extends('layouts.sistema')

@section('title')
    Login | UniMenager
@endsection
@section('meta_title')
    Login | UniMenager
@endsection

@push('head')
@endpush

@section('content')
    <main class="app-main">

        <!--begin::App Content Header-->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Configurações</h3>
                        <p>Edite suas informações pessoais</p>
                    </div>
                </div>
            </div>
        </div>
        <!--end::App Content Header-->

        <!--begin::App Content-->
        <div class="app-content">
            <div class="container-fluid">
                <div class="card card-primary card-outline mb-4">
                    <div class="card-header">
                        <div class="card-title fw-semibold">Informações Pessoais</div>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-4" style="font-size:.875rem">
                            Mantenha seus dados sempre atualizados
                        </p>
                        <form id="form" action="{{ route('updateByUser', $user->id) }}" method="POST" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome Completo</label>
                                <input type="text" class="form-control" id="nome" name="name"
                                    value="{{ $user->name }}" placeholder="Seu nome completo" />
                                <div class="field-feedback" id="nome-err">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span id="nome-msg"></span>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $user->email }}" placeholder="seu@email.com" />
                                    <div class="field-feedback" id="email-err">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span id="email-msg"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <input type="tel" class="form-control" id="telefone" name="phone"
                                        value="{{ $user->phone }}" placeholder="(00) 00000-0000" maxlength="15" />
                                    <div class="field-feedback" id="telefone-err">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span id="telefone-msg"></span>
                                    </div>
                                </div>
                            </div>

                            {{-- Aluno: mostra curso e período | Professor: mostra apenas área --}}
                            <div class="row g-3 mb-4">
                                @access(2)
                                    {{-- ALUNO --}}
                                    <div class="col-md-6">
                                        <label for="curso" class="form-label">Curso</label>
                                        <input type="text" class="form-control" id="curso" value=""
                                            placeholder="Nome do curso" disabled />
                                        <div class="field-feedback" id="curso-err">
                                            <i class="bi bi-exclamation-circle-fill"></i>
                                            <span id="curso-msg"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="periodo" class="form-label">Período</label>
                                        <input type="text" class="form-control" id="periodo" value=""
                                            placeholder="Ex: 5º Período" disabled />
                                        <div class="field-feedback" id="periodo-err">
                                            <i class="bi bi-exclamation-circle-fill"></i>
                                            <span id="periodo-msg"></span>
                                        </div>
                                    </div>
                                @endaccess
                                @access(3)
                                    {{-- PROFESSOR --}}
                                    <div class="col-md-6">
                                        <label for="telefone" class="form-label">Área de Atuação</label>
                                        <input type="tel" class="form-control" id="telefone" name="phone"
                                            value="{{ $user->course_area->name }}" disabled readonly/>
                                        <div class="field-feedback" id="telefone-err">
                                            <i class="bi bi-exclamation-circle-fill"></i>
                                            <span id="telefone-msg"></span>
                                        </div>
                                    </div>
                                </div>
                            @endaccess
                            <div class="col-sm-6 text-start">
                                <button type="submit" form="form" class="btn btn-dark px-4">
                                    Salvar Alterações
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end::App Content-->

    </main>
    </script>
    <!--end::OverlayScrollbars Configure-->

    <!--begin::Form Logic-->
    <script>
        const fields = ['nome', 'email', 'telefone', 'curso', 'periodo'];
        const saved = {};
        fields.forEach(id => saved[id] = document.getElementById(id).value);

        document.getElementById('telefone').addEventListener('input', function() {
            let v = this.value.replace(/\D/g, '').slice(0, 11);
            if (v.length <= 2) v = v.replace(/^(\d{0,2})/, '($1');
            else if (v.length <= 7) v = v.replace(/^(\d{2})(\d{0,5})/, '($1) $2');
            else v = v.replace(/^(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3');
            this.value = v;
        });

        function showErr(id, msg) {
            document.getElementById(id + '-err').classList.add('visible');
            document.getElementById(id + '-msg').textContent = msg;
            document.getElementById(id).classList.add('is-invalid');
        }

        function clearErr(id) {
            document.getElementById(id + '-err').classList.remove('visible');
            document.getElementById(id).classList.remove('is-invalid');
        }

        function validate(id) {
            const v = document.getElementById(id).value.trim();
            if (!v) {
                showErr(id, 'Este campo é obrigatório.');
                return false;
            }
            if (id === 'nome' && v.split(' ').filter(Boolean).length < 2) {
                showErr(id, 'Informe nome e sobrenome.');
                return false;
            }
            if (id === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v)) {
                showErr(id, 'E-mail inválido.');
                return false;
            }
            if (id === 'telefone' && v.replace(/\D/g, '').length < 10) {
                showErr(id, 'Telefone incompleto. Ex: (11) 98765-4321');
                return false;
            }
            clearErr(id);
            return true;
        }

        fields.forEach(id => {
            document.getElementById(id).addEventListener('blur', () => validate(id));
            document.getElementById(id).addEventListener('input', () => clearErr(id));
        });

        function showToast(msg, type = 'success') {
            const el = document.getElementById('liveToast');
            el.classList.remove('text-bg-success', 'text-bg-danger');
            el.classList.add(type === 'success' ? 'text-bg-success' : 'text-bg-danger');
            document.getElementById('toast-body').textContent = msg;
            bootstrap.Toast.getOrCreateInstance(el, {
                delay: 3500
            }).show();
        }

        document.getElementById('form').addEventListener('submit', e => {
            e.preventDefault();
            const ok = fields.every(id => validate(id));
            if (!ok) {
                showToast('Corrija os erros antes de salvar.', 'error');
                return;
            }
            const changed = fields.some(id =>
                document.getElementById(id).value.trim() !== saved[id].trim()
            );
            if (!changed) {
                showToast('Nenhuma alteração detectada.', 'error');
                return;
            }
            fields.forEach(id => saved[id] = document.getElementById(id).value.trim());
            showToast('Alterações salvas com sucesso!');
        });

        document.getElementById('btn-cancel').addEventListener('click', () => {
            fields.forEach(id => {
                document.getElementById(id).value = saved[id];
                clearErr(id);
            });
            showToast('Alterações descartadas.', 'error');
        });
    </script>
@endsection
