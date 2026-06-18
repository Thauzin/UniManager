@extends('layouts.sistema')

@section('title', 'Gerenciar Cursos')

@section('content')
    <main class="app-main">
        <div class="app-content">
            <div class="container-fluid">

                {{-- Cabeçalho --}}
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h1 class="fw-medium mb-1">Gerenciar Cursos</h1>
                        <p class="text-muted mb-0">Administre os cursos cadastrados no sistema</p>
                    </div>

                    <a href="{{ route('courses.create') }}" class="btn btn-dark px-4 d-flex align-items-center gap-2">
                        <i class="bi bi-plus-lg"></i>
                        Novo Curso
                    </a>
                </div>

                {{-- Cards de resumo --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="summary-card">
                            <div class="summary-label">Total de Cursos</div>
                            <div class="summary-value">{{ $courses->total() }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="summary-card">
                            <div class="summary-label">Nesta Página</div>
                            <div class="summary-value text-primary">{{ $courses->count() }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="summary-card">
                            <div class="summary-label">Páginas</div>
                            <div class="summary-value text-success">{{ $courses->lastPage() }}</div>
                        </div>
                    </div>
                </div>

                {{-- Tabela --}}
                <div class="content-card">

                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <span class="fw-medium" style="font-size:15px;">Lista de Cursos</span>

                        <div class="search-wrapper">
                            <i class="bi bi-search search-icon"></i>
                            <input type="text" class="search-input" placeholder="Buscar por nome..." id="searchCourse">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome do Curso</th>
                                    <th>Criado em</th>
                                    <th class="text-end">Ações</th>
                                </tr>
                            </thead>

                            <tbody id="tbodyCourses">
                                @forelse ($courses as $course)
                                    <tr>
                                        <td class="text-muted" style="font-size:13px;">
                                            {{ $course->id }}
                                        </td>

                                        <td class="fw-medium">{{ $course->name }}</td>

                                        <td class="text-muted" style="font-size:13px;">
                                            {{ $course->created_at->format('d/m/Y') }}
                                        </td>

                                        <td class="text-end">
                                            <div class="d-inline-flex gap-2">
                                                <a href="{{ route('courses.edit', $course->id) }}"
                                                   class="action-btn" title="Editar">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                <button class="action-btn action-btn-danger"
                                                        onclick="openDeleteModal({{ $course->id }})"
                                                        title="Excluir">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-5">
                                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                            Nenhum curso cadastrado ainda.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Paginação --}}
                    @if ($courses->hasPages())
                        <div class="mt-4 d-flex justify-content-end">
                            {{ $courses->links() }}
                        </div>
                    @endif

                </div>

            </div>
        </div>

        {{-- Modal: Confirmar exclusão --}}
        <div class="modal fade" id="deleteModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-medium">Confirmar exclusão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-muted">
                        Tem certeza que deseja excluir este curso? Esta ação não pode ser desfeita.
                    </div>
                    <div class="modal-footer border-0">
                        <button class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <form id="deleteForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Sim, excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script>
        function openDeleteModal(id) {
            document.getElementById('deleteForm').action = `/courses/${id}`;
            bootstrap.Modal.getOrCreateInstance(document.getElementById('deleteModal')).show();
        }

        const searchCourse = document.getElementById('searchCourse');
        if (searchCourse) {
            searchCourse.addEventListener('keyup', function () {
                const value = this.value.toLowerCase();
                document.querySelectorAll('#tbodyCourses tr').forEach(row => {
                    row.style.display = row.innerText.toLowerCase().includes(value) ? '' : 'none';
                });
            });
        }
    </script>

    <style>
        .summary-card {
            background: #fff;
            border: 0.5px solid rgba(0,0,0,.08);
            border-radius: 14px;
            padding: 1.25rem;
            text-align: center;
        }
        .summary-label {
            font-size: 13px;
            color: #6c757d;
            margin-bottom: 8px;
        }
        .summary-value {
            font-size: 28px;
            font-weight: 500;
            color: #0d0d0d;
        }
        .content-card {
            background: #fff;
            border: 0.5px solid rgba(0,0,0,.08);
            border-radius: 14px;
            padding: 1.25rem;
        }
        .search-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f5f5f7;
            border-radius: 10px;
            padding: 9px 14px;
            width: 280px;
        }
        .search-icon { color: #6c757d; font-size: 15px; }
        .search-input {
            border: none;
            background: transparent;
            outline: none;
            font-size: 14px;
            width: 100%;
            color: #0d0d0d;
        }
        .search-input::placeholder { color: #adb5bd; }
        .table thead th {
            font-weight: 500;
            font-size: 13px;
            color: #6c757d;
            border-bottom: 0.5px solid #e9ecef;
            padding-bottom: 12px;
        }
        .table tbody td {
            padding-top: 14px;
            padding-bottom: 14px;
            border-bottom: 0.5px solid #f1f3f5;
            font-size: 14px;
        }
        .table tbody tr:last-child td { border-bottom: none; }
        .action-btn {
            background: #f5f5f7;
            border: 0.5px solid #e9ecef;
            border-radius: 8px;
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #6c757d;
            text-decoration: none;
            transition: background .15s;
        }
        .action-btn:hover { background: #e9ecef; color: #495057; }
        .action-btn-danger { color: #e24b4a; }
        .action-btn-danger:hover { background: #fce8e8; color: #e24b4a; }
        .modal-content { border-radius: 18px; }
        .fw-medium { font-weight: 500; }
        .text-primary { color: #1a6fd4 !important; }
        .text-success { color: #1d9e75 !important; }
    </style>
@endsection