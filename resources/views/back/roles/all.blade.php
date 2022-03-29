@extends('back.layouts.app')

@section('content-back')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Roles</h3>
                    <p class="text-subtitle text-muted">For role to check they list</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Roles</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        @if (session()->has('success'))
            <div class="alert alert-success mb-0 mt-2">
                {{ session()->get('success') }}
            </div>
        @endif

        <section class="section">
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <!-- Table with outer spacing -->
                                <div class="table-responsive">
                                    <table class="table table-lg">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>NAME</th>
                                                <th>USERS</th>
                                                <th>HANDLE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $role)
                                                <tr>
                                                    <td style="font-weight: 900">{{ $role->id }}</td>
                                                    <td>{{ $role->nom }}</td>
                                                    <td>{{ count($role->users) }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="{{ route('roles.show', $role->id) }}"
                                                                class="btn btn-warning mx-2">Read</a>
                                                            <a href="{{ route('roles.edit', $role->id) }}"
                                                                class="btn btn-primary mx-2">Edit</a>
                                                            <form action="{{ route('roles.destroy', $role->id) }}"
                                                                method="post">
                                                                @csrf
                                                                @method("delete")
                                                                <button class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
