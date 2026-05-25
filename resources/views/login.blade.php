@extends('layouts.site')

@section('title')
    Login | UniMenager
@endsection
@section('meta_title')
    Login | UniMenager
@endsection

@push('head')
@endpush

@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card border-0 rounded-3">
            <div class="card-body login-card-body rounded-3">
                <div class="login-logo p-4">

                    <img src="{{ asset('src/assets/img/logo.avif') }}" alt="Logo" class="brand-image img-circle elevation-3"
                        style="opacity: .8">
                </div>

                <form action="{{ route('login.validar') }}" method="post">
                    @csrf
                    <label for="user" class="text-dark">E-mail</label>
                    <div class="input-group mb-3">
                        <input type="text" name="email" class="form-control" placeholder="Digite seu e-maill"
                            value="{{ old('email') }}" />
                        <div class="input-group-text">
                            <span class="bi bi-person"></span>
                        </div>
                    </div>
                    <label for="password" class="text-dark">Senha</label>
                    <div class="input-group mb-3" style="position: relative;">
                        <input type="password" name="password" id="senha" class="form-control" placeholder="Senha"
                            value="{{ session()->getOldInput('password') }}">
                        <div onclick="toggleSenha()" class="eye-icon">
                            <i id="iconSenha" class="bi bi-eye"></i>
                        </div>
                        <div class="input-group-text">
                            <span class="bi bi-lock-fill"></span>
                        </div>
                    </div>
                    <!--begin::Row-->
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </div>
                        </div>
                        <div class="mt-3 text-center">
                            <p class="mb-1">
                                <a class="text-decoration-none" href="forgot-password.html">Primeiro Acesso</a>
                            </p>
                            <p class="mb-0">
                                <a class="text-decoration-none" href="register.html" class="text-center">Esqueci minha
                                    senha</a>
                            </p>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!--end::Row-->
                </form>
            </div>
        </div>
        <!-- /.login-box -->
    @endsection

    @push('scripts')
        <script>
            const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
            const Default = {
                scrollbarTheme: 'os-theme-light',
                scrollbarAutoHide: 'leave',
                scrollbarClickScroll: true,
            };
            document.addEventListener('DOMContentLoaded', function() {
                const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

                // Disable OverlayScrollbars on mobile devices to prevent touch interference
                const isMobile = window.innerWidth <= 992;

                if (
                    sidebarWrapper &&
                    OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
                    !isMobile
                ) {
                    OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                        scrollbars: {
                            theme: Default.scrollbarTheme,
                            autoHide: Default.scrollbarAutoHide,
                            clickScroll: Default.scrollbarClickScroll,
                        },
                    });
                }
            });
        </script>
    @endpush
