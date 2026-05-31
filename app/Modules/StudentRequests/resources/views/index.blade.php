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

            <!-- Page Header -->
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Solicitações de Serviços</h3>
                            <p class="text-muted mb-0">Solicite documentos e serviços acadêmicos</p>
                        </div>
                        <div class="col-sm-6 text-end">
                            <a href="{{ route('studentrequests.create') }}">  <button type="button" class="btn btn-dark" data-bs-toggle="collapse"
                                 aria-expanded="false">
                                <i class="bi bi-plus-lg me-1"></i> Nova Solicitação
                            </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="app-content">
                <div class="container-fluid">

                    <!-- Formulário colapsável -->
                    

                    <!-- Tabela de Solicitações -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h3 class="card-title">Minhas Solicitações</h3><br>
                                    <p class="text-muted mb-0" style="font-size:14px;">Acompanhe o status das suas
                                        solicitações</p>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tbody> @foreach ($StudentRequests as $StudentRequest)
                                            <tr class="align-middle">
                                                <td class="text-center align-middle">
                                                    <span class="bi bi-file-earmark-arrow-up fs-3"></span>
                                                </td>
                                                <td>{{ $StudentRequest -> type }}<br>
                                                    <small class="text-muted">Solicitado em {{$StudentRequest -> created_at}}</small>
                                                </td>
                                                <td>
                                                    <span class="badge text-bg-danger">{{$StudentRequest -> status}}</span><br>
                                                </td>
                                            </tr>
                                           @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer clearfix">
                                    <ul class="pagination pagination-sm m-0 float-end">
                                        <li class="page-item"><a class="page-link text-dark" href="#">&laquo;</a></li>
                                        <li class="page-item"><a class="page-link text-dark" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link text-dark" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link text-dark" href="#">&raquo;</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </main>

        @endsection