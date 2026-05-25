<!--begin::Header-->
<style>
    .notification-item {
        background: #2b2f36;
        transition: background 0.2s ease;
    }

    .notification-item:hover {
        background: #343a40;
    }

    .notification-footer {
        transition: background 0.2s ease;
    }

    .notification-footer:hover {
        background: #343a40 !important;
    }
</style>
<nav class="app-header navbar navbar-expand bg-dark" data-bs-theme="dark">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item">
                @if (!request()->routeIs('*.index'))
                    <a class="nav-link" href="{{ url()->previous() }}" role="button">

                        <i class="bi bi-arrow-left"></i>

                    </a>
                @else
                    <a class="nav-link" data-lte-toggle="sidebar" href="javascript:void(0)" role="button">
                        <i class="bi bi-list"></i>
                    </a>
                @endif
            </li>
        </ul>
        <!--end::Start Navbar Links-->

        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
            <!--begin::Notifications Dropdown Menu-->
            <li class="nav-item dropdown">

                @access(1)
                    <a class="nav-link position-relative" data-bs-toggle="dropdown" href="javascript:void(0)">

                        <i class="bi bi-bell-fill"></i>

                        @if ($notifications->count() > 0)
                            <span class="navbar-badge badge bg-warning text-dark">
                                {{ $notifications->count() }}
                            </span>
                        @endif

                    </a>
                @endaccess

                <div class="dropdown-menu dropdown-menu-end p-0 border-0 shadow-sm overflow-hidden"
                    style="
            width: 360px;
            max-height: 420px;
            overflow-y: auto;
            border-radius: 10px;
            background: #2b2f36;
            left: -260px;
        ">

                    {{-- HEADER --}}
                    <div class="px-3 py-2 border-bottom d-flex justify-content-between align-items-center"
                        style="background: #262a30;">

                        <span class="fw-semibold text-white small">
                            Notificações
                        </span>

                        @if ($notifications->count() > 0)
                            <span class="badge bg-warning text-dark">
                                {{ $notifications->count() }}
                            </span>
                        @endif

                    </div>

                    {{-- LISTAGEM --}}
                    @if ($notifications->count() > 0)

                        @foreach ($notifications as $notification)
                            <div class="px-3 py-2 border-bottom notification-item">

                                <div class="d-flex align-items-start">

                                    <i class="bi bi-exclamation-triangle-fill text-warning me-2 mt-1"></i>

                                    <div class="flex-grow-1">

                                        <div class="small text-white"
                                            style="
                                    line-height: 1.4;
                                    white-space: normal;
                                    word-break: break-word;
                                    font-size: 13px;
                                ">
                                            {{ $notification->description }}
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mt-1">

                                            <small class="text-secondary" style="font-size: 11px;">
                                                {{ $notification->created_at->locale('pt_BR')->diffForHumans() }}
                                            </small>

                                            <form action="{{ route('notifications.read', $notification->id) }}"
                                                method="POST">
                                                @csrf

                                                <button type="submit"
                                                    class="btn btn-link btn-sm p-0 text-info text-decoration-none"
                                                    style="font-size: 11px;">

                                                    Marcar como lida

                                                </button>
                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        @endforeach

                        {{-- FOOTER --}}
                        <form action="{{ route('notifications.read-all') }}" method="POST">

                            @csrf

                            <button type="submit" class="w-100 border-0 py-2 small notification-footer"
                                style="
                        background: #262a30;
                        color: #f8f9fa;
                    ">

                                <i class="bi bi-check2-all me-1"></i>
                                Marcar todas como lidas

                            </button>

                        </form>
                    @else
                        <div class="py-3 text-center text-secondary small">

                            <i class="bi bi-bell-slash d-block mb-1"></i>

                            Nenhuma notificação encontrada.

                        </div>

                    @endif

                </div>

            </li>

            <!--end::Notifications Dropdown Menu-->

            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
                <a class="nav-link dropdown-toggle">
                    <div class="user-image d-flex align-items-center justify-content-center rounded-circle shadow"
                        style="height: 25px;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <span class=" d-md-inline">{{ Auth::user()->name }} | {{ Auth::user()->access_level->name }} </span>
                </a>
            </li>
            <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
</nav>
<!--end::Header-->
