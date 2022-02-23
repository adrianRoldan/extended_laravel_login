@extends('layouts.app')

@section('title') Ficha de Usuario @endsection

@section('content')

    @include('partials.page-header', [
        'current_breadcrumb'    => "Ficha de Usuario",
        'parent_breadcumb'      => "Usuarios"
    ])

    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Ficha de Usuario</h4>
                    <p class="card-description"> Aquí encontrarás la información del usuario </p>
                    <form class="forms-sample">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" class="form-control" id="name" disabled value="{{ old("name", $user->name) }}" placeholder="Nombre">
                        </div>

                        <div class="form-group">
                            <label for="google_id">Google Id</label>
                            <input type="text" name="google_id" class="form-control" disabled value="{{ old("google_id", $user->google_id) }}" id="google_id" placeholder="Identificador de Google">
                        </div>

                        <div class="form-group">
                            <label for="token">Token API</label>
                            <input type="text" class="form-control" disabled value="{{ $token }}" id="token" placeholder="Token para consumir de la API">
                        </div>


                        <a href="{{ route("users.index") }}" class="btn btn-light">Cancelar</a>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Listado de emails</h4>
                    <p class="card-description"> Alias de email del usuario </p>

                    <user-emails-list user-id="{{ $user->uuid }}"></user-emails-list>

                </div>
            </div>
        </div>

    </div>

@endsection
