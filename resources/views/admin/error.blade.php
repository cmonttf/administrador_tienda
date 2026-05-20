@extends('layouts.admin')

@section('title', 'Error')
@section('page-title', 'Error inesperado')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card border-danger shadow-sm">
                <div class="card-header bg-danger text-white">
                    🚨 Ups… algo salió mal
                </div>

                <div class="card-body">
                    <p class="fw-bold mb-2">Detalle del error:</p>
                    <div class="alert alert-danger mb-0">
                        {{ $error->getMessage() }}
                    </div>
                </div>

                <div class="card-footer text-end">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-danger">
                        Volver
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
