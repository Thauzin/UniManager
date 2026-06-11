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
    <style>
        .text-lightgreen {
            color: #20c963;
        }

        .bg-lightgreen {
            color: black;
            background: #20c963;
        }

        .btn-lightgreen {
            background: #20c963;
        }

        .btn-lightgreen:hover {
            background: #19e76b;
        }
    </style>
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
                                    <strong>
                                        <div class="card-title">Solicitação de {{ $item->student }}</div>
                                    </strong> <br>
                                    <small class="text-muted">{{ $item->description }}</small>
                                </div>

                                <!--end::Header-->
                                <!--begin::Form-->






                                <form action="{{ route('secretaryrequests.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <div class="mb-3 w-100">
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Responder</label>
                                                <input type="text" name="answer" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                    <!--begin::Footer-->
                                    <div class="card-footer d-flex justify-content-end gap-2">
                                        <button type="submit" name="status" value="Em Análise" class="btn btn-warning">Em analise</button>
                                        <button type="submit" name="status" value="Concluído" class="btn btn-lightgreen">Concluído</button>
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