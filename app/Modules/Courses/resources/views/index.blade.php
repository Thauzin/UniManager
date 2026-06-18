@extends('layouts.sistema')

@section('title', 'Gerenciar Turmas')

@section('content')
    <main class="app-main">
        <div class="app-content">
            <div class="container-fluid">

                {{-- Cabeçalho --}}
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h1 class="fw-bold mb-1">Gerenciar Turmas</h1>
                        <p class="text-muted mb-0">
                            Administre turmas, professores e alunos
                        </p>
                    </div>

                    <button class="btn btn-dark px-4" onclick="openCourseModal()">
                        <i class="bi bi-plus-lg me-2"></i>
                        Nova Turma
                    </button>
                </div>

                {{-- Cards --}}
                <div class="row g-3 mb-6">
                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body text-center">
                                <small class="text-muted">Total de Turmas</small>
                                <h2 class="fw-bold mb-0">{{ $groups->count() }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-6">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body text-center">
                                <small class="text-muted">Total de Alunos</small>
                                <h2 class="fw-bold text-primary mb-0">
                                    {{ $users->where('access_level_id', 2)->whereNotNull('group_id')->count() }}
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tabela --}}
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead>
                                    <tr>
                                        <th>Turma</th>
                                        <th>Curso</th>
                                        <th>Professor</th>
                                        <th>Alunos</th>
                                        <th class="text-end">Ações</th>
                                    </tr>
                                </thead>

                                <tbody id="tbodyCourses">
                                    @foreach ($groups as $group)
                                        <tr class="border-top border-bottom">
                                            <td class="fw-semibold">{{ $group->name }}</td>
                                            <td>{{ $group->course->name }}</td>
                                            <td>Prof. {{ $group->user->name }}</td>
                                            <td>
                                                <span class="badge bg-primary-subtle text-primary rounded-pill">
                                                    <i
                                                        class="bi bi-people-fill me-1"></i>{{ $users->where('access_level_id', 2)->where('group_id', $group->id)->count() }}
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <div class="d-inline-flex gap-2">
                                                    <button title="Adicionar Alunos" class="btn btn-light border btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#modalAlunos"
                                                        onclick="openAlunosModal({{ $group->id }}, '{{ $group->name }}')">
                                                        <i class="bi bi-people-fill"></i>
                                                    </button>
                                                    <button title="Editar Turma" class="btn btn-light border btn-sm"
                                                        onclick="editCourse({{ $group }})">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <button title="Excluir Turma"
                                                        class="btn btn-light border btn-sm text-danger"
                                                        onclick="openDeleteModal({{ $group->id }})">
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

        {{-- Modal Excluir --}}
        <div class="modal fade" id="deleteModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar exclusão</h5>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja excluir esta turma?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form id="deleteForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Sim, excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Confirmar Remoção de Aluno --}}
        <div class="modal fade" id="removeStudentModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar remoção</h5>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja remover <strong id="removeStudentName"></strong> desta turma?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirmRemoveStudentBtn">
                            Sim, remover
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Nova/Editar Turma --}}
        <div class="modal fade" id="courseModal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 rounded-4">

                    <div class="modal-header border-0 pb-0">
                        <div>
                            <h3 class="fw-bold mb-1" id="modalCourseTitle">Nova Turma</h3>
                            <p class="text-muted mb-0">
                                Preencha os dados para criar uma nova turma
                            </p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form id="courseForm" method="POST">
                        @csrf
                        <div id="courseMethodField"></div>

                        <div class="modal-body">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nome da Turma</label>
                                <input type="text" name="name" id="name" class="form-control custom-input"
                                    placeholder="Ex: Engenharia 5A">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Curso</label>
                                <select name="course_id" id="course_id" class="form-select custom-input">
                                    <option value="" selected disabled>Selecione o curso</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">
                                            {{ $course->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Professor Responsável</label>
                                <select name="user_id" id="user_id" class="form-select custom-input">
                                    <option value="" selected disabled>Selecione o professor</option>
                                    @foreach ($users->where('access_level_id', 3) as $professor)
                                        <option value="{{ $professor->id }}">
                                            {{ $professor->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="modal-footer border-0 pt-0">
                            <button type="submit" class="btn btn-dark px-4">Salvar Turma</button>
                            <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                                Cancelar
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        {{-- Modal Alunos --}}
        <div class="modal fade" id="modalAlunos" tabindex="-1">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Gerenciar Alunos - <span id="modalAlunosGroupName"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label">Adicionar Aluno</label>
                        <div class="d-flex gap-2">
                            <select class="form-select" id="alunoSelect">
                                <option value="" selected disabled>Selecione um aluno</option>
                            </select>
                            <button class="btn btn-dark" id="btnAdicionarAluno" onclick="addStudent()">
                                <i class="bi bi-person-plus"></i>
                                Adicionar
                            </button>
                        </div>
                        <hr>
                        <h6>Alunos na Turma</h6>
                        <div id="listaAlunosTurma">
                            {{-- preenchido via JS --}}
                        </div>
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
            searchCourse.addEventListener('keyup', function() {
                const value = this.value.toLowerCase();
                document.querySelectorAll('#tbodyCourses tr').forEach(row => {
                    row.style.display = row.innerText.toLowerCase().includes(value) ? '' : 'none';
                });
            });
        }

        // Nova turma
        function openCourseModal() {
            document.getElementById('modalCourseTitle').innerText = 'Nova Turma';
            document.getElementById('courseForm').action = "{{ route('courses.store') }}";
            document.getElementById('courseMethodField').innerHTML = '';
            document.getElementById('courseForm').reset();

            bootstrap.Modal.getOrCreateInstance(document.getElementById('courseModal')).show();
        }

        // Editar turma
        function editCourse(turma) {
            document.getElementById('modalCourseTitle').innerText = 'Editar Turma';
            document.getElementById('courseForm').action = `/courses/${turma.id}`;
            document.getElementById('courseMethodField').innerHTML =
                '<input type="hidden" name="_method" value="PUT">';

            document.getElementById('name').value = turma.name ?? '';
            document.getElementById('course_id').value = turma.course_id ?? '';
            document.getElementById('user_id').value = turma.user_id ?? '';

            bootstrap.Modal.getOrCreateInstance(document.getElementById('courseModal')).show();
        }

        const todosAlunos = @json($users->where('access_level_id', 2)->values());

        function openAlunosModal(groupId, groupName) {

            document.getElementById('modalAlunosGroupName').innerText = groupName;

            const alunosDaTurma = todosAlunos.filter(u => u.group_id === groupId);
            const alunosSemTurma = todosAlunos.filter(u => u.group_id === null);

            const select = document.getElementById('alunoSelect');
            select.innerHTML = '<option value="" selected disabled>Selecione um aluno</option>';

            alunosSemTurma.forEach(aluno => {
                const option = document.createElement('option');
                option.value = aluno.id;
                option.innerText = aluno.name;
                select.appendChild(option);
            });

            const lista = document.getElementById('listaAlunosTurma');
            lista.innerHTML = '';

            if (alunosDaTurma.length === 0) {
                lista.innerHTML = '<p class="text-muted">Nenhum aluno nesta turma ainda.</p>';
            } else {
                alunosDaTurma.forEach(aluno => {
                    lista.innerHTML += `
                <div class="border rounded p-3 mb-2 d-flex justify-content-between align-items-center">
                    <div>
                        <strong>${aluno.name}</strong><br>
                        <small>Matrícula: ${aluno.username ?? aluno.id}</small>
                    </div>
                    <button class="btn btn-outline-danger btn-sm" onclick="removerAluno(${aluno.id})">
                        <i class="bi bi-person-dash"></i>
                    </button>
                </div>
            `;
                });
            }

            // ESSA LINHA só roda se tudo acima não quebrar
            document.getElementById('btnAdicionarAluno').dataset.groupId = groupId;
        }

        function addStudent() {

            const groupId = document.getElementById('btnAdicionarAluno').dataset.groupId;
            const studentId = document.getElementById('alunoSelect').value;

            if (!groupId) {
                alert('Erro: turma não identificada. Feche e reabra o modal.');
                return;
            }

            if (!studentId) {
                alert('Selecione um aluno primeiro.');
                return;
            }

            fetch(`/courses/${groupId}/add-student`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({
                        student_id: studentId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message ?? 'Erro ao adicionar aluno.');
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert('Erro ao adicionar aluno.');
                });
        }

        function removerAluno(studentId) {

            const groupId = document.getElementById('btnAdicionarAluno').dataset.groupId;

            if (!confirm('Tem certeza que deseja remover este aluno da turma?')) {
                return;
            }

            fetch(`/courses/${groupId}/remove-student`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({
                        student_id: studentId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert(data.message ?? 'Erro ao remover aluno.');
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert('Erro ao remover aluno.');
                });
        }
    </script>
    <script>
        const todosAlunos = @json($users->where('access_level_id', 2)->values());

        function openAlunosModal(groupId, groupName) {

            document.getElementById('modalAlunosGroupName').innerText = groupName;

            // Alunos que JÁ estão nessa turma
            const alunosDaTurma = todosAlunos.filter(u => u.group_id === groupId);

            // Alunos disponíveis (sem turma ainda)
            const alunosSemTurma = todosAlunos.filter(u => u.group_id === null);

            // Preenche o select de "Adicionar Aluno"
            const select = document.getElementById('alunoSelect');
            select.innerHTML = '<option value="" selected disabled>Selecione um aluno</option>';

            alunosSemTurma.forEach(aluno => {
                const option = document.createElement('option');
                option.value = aluno.id;
                option.innerText = aluno.name;
                select.appendChild(option);
            });

            const lista = document.getElementById('listaAlunosTurma');
            lista.innerHTML = '';

            if (alunosDaTurma.length === 0) {
                lista.innerHTML = '<p class="text-muted">Nenhum aluno nesta turma ainda.</p>';
            } else {
                alunosDaTurma.forEach(aluno => {
                    lista.innerHTML += `
                    <div class="border rounded p-3 mb-2 d-flex justify-content-between align-items-center">
                        <div>
                            <strong>${aluno.name}</strong><br>
                            <small>Matrícula: ${aluno.username ?? aluno.id}</small>
                        </div>
                        <button class="btn btn-outline-danger btn-sm" onclick="removerAluno(${aluno.id})">
                            <i class="bi bi-person-dash"></i>
                        </button>
                    </div>
                `;
                });
            }

            // Guarda o group_id atual no botão de adicionar (pra usar depois)
            document.getElementById('btnAdicionarAluno').dataset.groupId = groupId;
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

        .bg-primary-subtle {
            background: #e9f0ff;
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
