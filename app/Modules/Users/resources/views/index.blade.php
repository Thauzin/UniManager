@extends('layouts.sistema')

@section('title')
    Login | Ministério Melhor Viver
@endsection
@section('meta_title')
    Login | Ministério Melhor Viver
@endsection

@push('head')
@endpush

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Usuários</h3>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end align-items-center gap-2">
                        <a href="{{ route('users.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg"></i>
                            <span>Novo</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--begin::App Content-->
        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-body p-0">
                                <table class="table table-sm mb-0" id="tabelaProdutos">
                                    <thead>
                                        <tr>
                                            <th style="width:10px">#</th>
                                            <th>Nome</th>
                                            <th>Nível de Acesso</th>
                                            <th>Polo</th>
                                            <th style="width:90px" class="text-center">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyProdutos">
                                        @foreach ($users as $user)
                                            <tr class="align-middle">
                                                <td>{{ $user->id }}.</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->access_level->name }}</td>
                                                <td>{{ $user->center->name ?? '-' }}</td>
                                                <td class="text-end">
                                                    <div class="d-inline-flex align-items-center gap-2">
                                                        <a href="{{ route('users.edit', $user->id) }}"
                                                            class="btn btn-primary btn-sm">
                                                            <i class="bi bi-pen"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-sm"
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
        </div>
        <div class="modal fade" id="deleteModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar exclusão</h5>
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
        <!--end::App Content-->
    </main>

    <script>
        function openDeleteModal(id) {
            const form = document.getElementById('deleteForm');

            form.action = `/users/${id}`;

            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }
    </script>
@endsection
