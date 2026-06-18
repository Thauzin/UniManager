<!-- Sidebar -->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="solicitacao.html" class="brand-link">
            <img src="../assets/img/AdminLTELogo.png" alt="UniManager" class="brand-image opacity-75 shadow" />
            <span class="brand-text fw-light"></span>
        </a>
    </div>

    @access(1)
    <div class="sidebar-wrapper bg-light">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">
                <hr>
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="nav-icon bi bi-person text-dark"></i>
                        <p class="text-dark">{{ $user->access_level->name }}</p>
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a href="../Aluno/dashboard_aluno.html" class="nav-link">
                        <i class="nav-icon bi bi-bar-chart text-dark"></i>
                        <p class="text-dark">Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../Aluno/verDetalhesMaterias.html" class="nav-link">
                        <i class="nav-icon bi bi-book text-dark"></i>
                        <p class="text-dark">Matérias</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../Aluno/atividadeAluno.html" class="nav-link">
                        <i class="nav-icon bi bi-clipboard-check text-dark"></i>
                        <p class="text-dark">Atividades</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon bi bi-file-earmark-text text-dark"></i>
                        <p class="text-dark">Solicitações</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('configs.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-gear text-dark"></i>
                        <p class="text-dark">Configurações</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-people-fill text-dark"></i>
                        <p class="text-dark">Usuários</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link text-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i>
                        <p>Sair</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
    @endaccess
    @access(2)
    <div class="sidebar-wrapper bg-light">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">
                <hr>
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="nav-icon bi bi-person text-dark"></i>
                        <p class="text-dark">{{ $user->access_level->name }}</p>
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a href="../Aluno/dashboard_aluno.html" class="nav-link">
                        <i class="nav-icon bi bi-bar-chart text-dark"></i>
                        <p class="text-dark">Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../Aluno/verDetalhesMaterias.html" class="nav-link">
                        <i class="nav-icon bi bi-book text-dark"></i>
                        <p class="text-dark">Matérias</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../Aluno/atividadeAluno.html" class="nav-link">
                        <i class="nav-icon bi bi-clipboard-check text-dark"></i>
                        <p class="text-dark">Atividades</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon bi bi-file-earmark-text text-dark"></i>
                        <p class="text-dark">Solicitações</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('configs.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-gear text-dark"></i>
                        <p class="text-dark">Configurações</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link text-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i>
                        <p>Sair</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
    @endaccess
    @access(3)
    <div class="sidebar-wrapper bg-light">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">
                <hr>
                <li class="nav-item">
                    <a class="nav-link">
                        <i class="nav-icon bi bi-person text-dark"></i>
                        <p class="text-dark">{{ $user->access_level->name }}</p>
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a href="../Aluno/dashboard_aluno.html" class="nav-link">
                        <i class="nav-icon bi bi-bar-chart text-dark"></i>
                        <p class="text-dark">Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../Aluno/verDetalhesMaterias.html" class="nav-link">
                        <i class="nav-icon bi bi-book text-dark"></i>
                        <p class="text-dark">Turmas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../Aluno/atividadeAluno.html" class="nav-link">
                        <i class="nav-icon bi bi-clipboard-check text-dark"></i>
                        <p class="text-dark">Chamada</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('configs.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-gear text-dark"></i>
                        <p class="text-dark">Configurações</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link text-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i>
                        <p>Sair</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
    @endaccess
</aside>
