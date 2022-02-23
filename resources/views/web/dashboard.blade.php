@extends('layouts.app')

@section('title') Listado de Usuarios @endsection

@section('content')

    @include('partials.page-header', [
        'current_breadcrumb'    => "Listado de Usuarios",
        'parent_breadcumb'      => "Usuarios"
    ])


    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Listado de Usuarios</h4>

                <p class="card-description">
                    Gestiona aquí a los usuarios
                </p>

                <users-list-component></users-list-component>

            </div>
        </div>
    </div>

@endsection
