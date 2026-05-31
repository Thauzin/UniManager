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
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="mt-3 w-100" id="novaTurma">
                <div class="card card-body w-100">
                    <div class="card card-dark card-outline mb-4">
                        <!--begin::Header-->
                        <div class="col-md-12">
                            <div class="card w-100">
                                <div class="card-header w-100">
                                    <div class="card-title">Nova Solicitação</div> <br>
                                    <small class="text-muted">Preencha os dados para solicitar um
                                serviço</small>
                                </div>

                                <!--end::Header-->
                                <!--begin::Form-->

                                

                                @if (isset($Studentrequest))
                                    @method('PUT')
                                @endif
                                <form action="{{ route('studentrequests.store') }}" method="POST">
                                    @csrf
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <div class="mb-3 w-100">
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Tipo de Solicitação</label>
                                                    <select class="form-select" name="type" required>
                                                        <option selected disabled value="">Escolha uma opção</option>
                                                        <option value="Declaração de Matrícula">Declaração de Matrícula</option>
                                                        <option value="Histórico Escolar">Histórico Escolar</option>
                                                        <option value="Segunda via de Documentos">Segunda via de Documentos</option>
                                                        <option value="Enviar Atestado">Enviar Atestado</option>
                                                        <option value="Enviar Horas Complementares">Enviar Horas Complementares</option>
                                                        <option value="Outros serviços">Outros serviços</option>
                                                    </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Descrição</label>
                                                <input type="text" name="description" class="form-control"
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                    <!--begin::Footer-->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-dark">Enviar Solicitação</button>
                                    </div>
                                    <!--end::Footer-->
                                </form>
                                <!--end::Form-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::App Content Header-->
                <!--begin::App Content-->
                <!-- /.card -->

                <!--begin::JavaScript-->
                <script>
                    // Example starter JavaScript for disabling form submissions if there are invalid fields
                    (() => {
                        'use strict';

                        // Fetch all the forms we want to apply custom Bootstrap validation styles to
                        const forms = document.querySelectorAll('.needs-validation');

                        // Loop over them and prevent submission
                        Array.from(forms).forEach((form) => {
                            form.addEventListener(
                                'submit',
                                (event) => {
                                    if (!form.checkValidity()) {
                                        event.preventDefault();
                                        event.stopPropagation();
                                    }

                                    form.classList.add('was-validated');
                                },
                                false,
                            );
                        });
                    })();
                </script>
                <!--end::JavaScript-->
            </div>
            <!--end::Form Validation-->
            <!--end::App Content-->
    </main>
@endsection