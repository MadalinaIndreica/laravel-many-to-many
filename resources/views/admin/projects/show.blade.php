@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2>{{ $project->title }}</h2>
        <div>
            <p>
           tipologia: {{ $project->type ? $project->type->name : 'nessuna tipologia' }}
            </p>
        </div>
        
        <div class="mt-4">
            Data: {{ $project->created_at }}
        </div>

        <div class="mt-4">
            Slug: {{ $project->slug }}
        </div>

        <p class="mt-4">
            {{ $project->description }}
        </p>
    </div>
@endsection