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

        <!-- Page Header -->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="mb-0">Atividades</h1>
                    </div>
                </div>
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-start">
                        <li class="breadcrumb-item active" aria-current="page">Gerencie suas atividades e acompanhe seu
                            progresso</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="app-content">
            <div class="container-fluid">

                <!-- Cards de estatísticas -->
                <div class="row g-3 mb-3 mt-3 justify-content-center">
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box bg-white">
                            <span class="info-box-icon icon-blue rounded-3">
                                <i class="bi bi-clock"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text text-muted">Pendentes</span>
                                <span class="info-box-number fw-bold text-dark">4</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box bg-white">
                            <span class="info-box-icon icon-orange rounded-3">
                                <i class="bi bi-check-circle"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text text-muted">Concluídas</span>
                                <span class="info-box-number fw-bold text-dark">5</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box bg-white">
                            <span class="info-box-icon icon-green rounded-3">
                                <i class="bi bi-clipboard-check"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text text-muted">Total</span>
                                <span class="info-box-number fw-bold text-dark">9</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs + Listas de Atividades -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="shadow-none card custom-card mb-4">
                            <div class="card-header border-0 pb-0">
                                <div class="d-flex gap-2 mb-3">
                                    <button class="btn btn-dark rounded-pill px-4" id="btn-pendentes"
                                        onclick="showTab('pendentes')">Pendentes (4)</button>
                                    <button class="btn btn-outline-secondary rounded-pill px-4" id="btn-concluidas"
                                        onclick="showTab('concluidas')">Concluídas (5)</button>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column gap-3">

                                <!-- Lista Pendentes -->
                                <div id="tab-pendentes" style="display:flex; flex-direction:column; gap:8px;">

                                    <div class="activity-item">
                                        <div class="activity-icon">
                                            <i class="bi bi-clipboard-check"></i>
                                        </div>
                                        <div class="activity-info">
                                            <div class="activity-title">Projeto Final - Sistema CRUD</div>
                                            <div class="activity-subtitle">Programação Web</div>
                                            <div class="mt-1" style="font-size:14px; color:#6b7280;">
                                                <i class="bi bi-calendar3 me-1"></i> Prazo: 15/03/2026
                                                <span class="ms-2 px-2 py-1 rounded-pill"
                                                    style="background:#fff0e6; color:#f4622a; font-size:13px;">3 dias
                                                    restantes</span>
                                            </div>
                                        </div>


                                        <div class="col-sm-12">
                                            <button type="button" class="btn btn-dark" data-bs-toggle="collapse"
                                                data-bs-target="#novaSolicitacao">Novo Usuário +</button>
                                            <div class="collapse mt-3 w-100" id="novaSolicitacao">
                                                <div class="card card-body w-100">
                                                    <div class="card card-dark card-outline mb-4">
                                                        <div class="col-md-12">
                                                            <div class="card w-100">
                                                                <div class="card-header w-100">
                                                                    <div class="card-title">Novo Usuário
                                                                        <br>
                                                                        <p>Preencha os dados para criar um novo usuário</p>
                                                                    </div>
                                                                    <br>
                                                                </div>
                                                                <form>
                                                                    <div class="card-body w-100">
                                                                        <div class="mb-3">
                                                                            <label for="nome" class="form-label">Nome
                                                                                Completo</label>
                                                                            <input type="text" class="form-control"
                                                                                id="nome"
                                                                                placeholder="Digite o nome completo do usuário">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="email"
                                                                                class="form-label">E-mail</label>
                                                                            <input type="email" class="form-control"
                                                                                id="email"
                                                                                placeholder="Digite o e-mail do usuário">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="senha"
                                                                                class="form-label">CPF</label>
                                                                            <input type="text" class="form-control"
                                                                                id="senha"
                                                                                placeholder="Digite o CPF do usuário">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="tipoUsuario"
                                                                                class="form-label">Telefone</label>
                                                                            <input type="text" class="form-control"
                                                                                id="tipoUsuario"
                                                                                placeholder="Digite o telefone do usuário">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="tipoUsuario" class="form-label">Tipo
                                                                                de Acesso</label>
                                                                            <select class="form-select" id="tipoUsuario">
                                                                                <option value="">Selecione o tipo de usuário
                                                                                </option>
                                                                                <option value="aluno">Aluno</option>
                                                                                <option value="professor">Professor</option>
                                                                                <option value="funcionario">Secretaria
                                                                                </option>
                                                                                <option value="funcionario">Coordenação
                                                                                </option>
                                                                                <option value="funcionario">Direção</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="card-footer">
                                                                            <button type="submit"
                                                                                class="btn btn-dark">Salvar Usuário</button>
                                                                        </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>







                                    </div>







                                    <div class="activity-item">
                                        <div class="activity-icon">
                                            <i class="bi bi-clipboard-check"></i>
                                        </div>
                                        <div class="activity-info">
                                            <div class="activity-title">Lista de Exercícios SQL</div>
                                            <div class="activity-subtitle">Banco de Dados</div>
                                            <div class="mt-1" style="font-size:14px; color:#6b7280;">
                                                <i class="bi bi-calendar3 me-1"></i> Prazo: 18/03/2026
                                                <span class="ms-2 px-2 py-1 rounded-pill"
                                                    style="background:#fffbeb; color:#d97706; font-size:13px;">6 dias
                                                    restantes</span>
                                            </div>
                                        </div>
                                        <button class="btn btn-dark rounded-3 px-4">Entregar</button>
                                    </div>

                                    <div class="activity-item">
                                        <div class="activity-icon">
                                            <i class="bi bi-clipboard-check"></i>
                                        </div>
                                        <div class="activity-info">
                                            <div class="activity-title">Diagrama UML do Sistema</div>
                                            <div class="activity-subtitle">Engenharia de Software</div>
                                            <div class="mt-1" style="font-size:14px; color:#6b7280;">
                                                <i class="bi bi-calendar3 me-1"></i> Prazo: 20/03/2026
                                                <span class="ms-2 px-2 py-1 rounded-pill"
                                                    style="background:#e6f9f0; color:#20c963; font-size:13px;">8 dias
                                                    restantes</span>
                                            </div>
                                        </div>
                                        <button class="btn btn-dark rounded-3 px-4">Entregar</button>
                                    </div>

                                    <div class="activity-item">
                                        <div class="activity-icon">
                                            <i class="bi bi-clipboard-check"></i>
                                        </div>
                                        <div class="activity-info">
                                            <div class="activity-title">Trabalho sobre Protocolos TCP/IP</div>
                                            <div class="activity-subtitle">Redes de Computadores</div>
                                            <div class="mt-1" style="font-size:14px; color:#6b7280;">
                                                <i class="bi bi-calendar3 me-1"></i> Prazo: 22/03/2026
                                                <span class="ms-2 px-2 py-1 rounded-pill"
                                                    style="background:#e6f9f0; color:#20c963; font-size:13px;">10 dias
                                                    restantes</span>
                                            </div>
                                        </div>
                                        <button class="btn btn-dark rounded-3 px-4">Entregar</button>
                                    </div>

                                </div>

                                <!-- Lista Concluídas -->
                                <div id="tab-concluidas" style="display:none; flex-direction:column; gap:8px;">

                                    <div class="activity-item">
                                        <div class="activity-icon" style="background:#e6f9f0;">
                                            <i class="bi bi-check-circle" style="color:#20c963;"></i>
                                        </div>
                                        <div class="activity-info">
                                            <div class="activity-title">Implementação de API REST</div>
                                            <div class="activity-subtitle">Programação Web</div>
                                            <div class="mt-1" style="font-size:14px; color:#6b7280;">
                                                <i class="bi bi-calendar3 me-1"></i> Entregue em: 08/03/2026
                                                &nbsp; Nota: <span style="color:#20c963; font-weight:700;">9.0</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="activity-item">
                                        <div class="activity-icon" style="background:#e6f9f0;">
                                            <i class="bi bi-check-circle" style="color:#20c963;"></i>
                                        </div>
                                        <div class="activity-info">
                                            <div class="activity-title">Modelagem de Banco de Dados</div>
                                            <div class="activity-subtitle">Banco de Dados</div>
                                            <div class="mt-1" style="font-size:14px; color:#6b7280;">
                                                <i class="bi bi-calendar3 me-1"></i> Entregue em: 05/03/2026
                                                &nbsp; Nota: <span style="color:#20c963; font-weight:700;">8.5</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="activity-item">
                                        <div class="activity-icon" style="background:#e6f9f0;">
                                            <i class="bi bi-check-circle" style="color:#20c963;"></i>
                                        </div>
                                        <div class="activity-info">
                                            <div class="activity-title">Análise de Requisitos</div>
                                            <div class="activity-subtitle">Engenharia de Software</div>
                                            <div class="mt-1" style="font-size:14px; color:#6b7280;">
                                                <i class="bi bi-calendar3 me-1"></i> Entregue em: 01/03/2026
                                                &nbsp; Nota: <span style="color:#20c963; font-weight:700;">9.5</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="activity-item">
                                        <div class="activity-icon" style="background:#e6f9f0;">
                                            <i class="bi bi-check-circle" style="color:#20c963;"></i>
                                        </div>
                                        <div class="activity-info">
                                            <div class="activity-title">Trabalho sobre Threads</div>
                                            <div class="activity-subtitle">Sistemas Operacionais</div>
                                            <div class="mt-1" style="font-size:14px; color:#6b7280;">
                                                <i class="bi bi-calendar3 me-1"></i> Entregue em: 28/02/2026
                                                &nbsp; Nota: <span style="color:#20c963; font-weight:700;">8.0</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection