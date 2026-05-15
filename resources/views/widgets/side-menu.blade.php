<aside class="app-sidebar bg-white shadow" data-bs-theme="">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Image-->
        <img src="{{ asset('src/assets/img/logo.avif') }}" alt="Logo" class="brand-image" height=""
            width="" />
        <!--end::Brand Image-->
        <!--begin::Brand Text-->
        <span class="brand-text fw-light d-none">Ministério Melhor Viver</span>
        <!--end::Brand Text-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Consulta de Estoque
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="consulta_de_estoque.html" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Polo 1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="consulta_de_estoque.html" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Polo 2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="consulta_de_estoque.html" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Polo 3</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="histórico_de_Movimentações.html" class="nav-link">
                        <i class="nav-icon bi bi-clock-history"></i>
                        <p>Histórico de Movimentações</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="listagem_tipo_de_produto.html" class="nav-link">
                        <i class="nav-icon bi bi-box-seam"></i>
                        <p>Tipo de Produto</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('centers.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-building"></i>
                        <p>Polos</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link active">
                        <i class="nav-icon bi bi-people"></i>
                        <p>Usuários</p>
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
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
