@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-10">
            <h1> Gebruikers </h1>
        </div>
        <div class="col-2">
            <a href="/admin/users/create"><button class="btn btn-secondary">Nieuwe gebruiker</button></a>
        </div>

        <div class="row">
            <div class="col-12 card">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Naam</th>
                            <th scope="col">E-mail</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td><a href="/admin/users/{{ $user->id }}/edit"><button
                                class="btn btn-link link-dark"><i class="fa fa-pencil"></i></button></a><a
                                href="/admin/users/{{ $user->id }}/destroy"><button
                                class="btn btn-link link-dark"><i class="fa fa-trash-o"></i></button></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection
