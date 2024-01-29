@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2>Lista dei progetti</h2>

        <div class="text-end">
            <a class="btn btn-info text-white" href="{{ route('admin.projects.create') }}">Crea un nuovo progetto</a>
        </div>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @if (count($projects) > 0)
            <table class="table table-striped mt-5">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Titolo</th>
                        <th scope="col">Data</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <th scope="row">{{ $project->id }}</th>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->created_at }}</td>
                            <td>
                                <a class="btn btn-primary"
                                    href="{{ route('admin.projects.show', ['project' => $project->slug]) }}"><i
                                        class="fa-solid fa-info"></i></a>
                                <a class="btn btn-info text-white"
                                    href="{{ route('admin.projects.edit', ['project' => $project->slug]) }}"><i
                                        class="fa-solid fa-pen"></i></a>
                                <form class="d-inline-block"
                                    action="{{ route('admin.projects.destroy', ['project' => $project->slug]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger d-inline-block btn-delete"
                                        data-title="{{ $project->title }}"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning mt-5">
                Il portfolio è vuoto, non c'è ancora nessun progetto!
            </div>
        @endif
        @include('partials.delete-modal')
    </div>
@endsection
