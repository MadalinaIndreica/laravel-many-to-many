@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div>
            <a href="{{ url()->previous() }}">&leftarrow; Ritorna indietro</a>
        </div>

        <h2 class="my-5 ">Modifica progetto</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.projects.update', ['project' => $project->slug]) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3 has-validation">
                <label for="title" class="form-label"><strong>Titolo</strong></label>
                <input type="text" class="form-control " id="title" name="title" value="{{ old('title',$project->title) }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label"><strong>descrizione</strong></label>
                <textarea class="form-control" id="description" rows="3" name="description">{{ old('content', $project->description) }}</textarea>
            </div>   
            <div class="mb-3">
                <label for="type">seleziona una tipologia</label>
                <select class="form-select" name="type_id" id="type">
                    <option @selected(!old('type_id', $project->type_id)) value=""></option>
                    @foreach ($types as $type)
                        <option @selected(old('type_id', $project->type_id) == $type->id) value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
               
            </div>
            {{-- technologies --}}
            <div class="mb-3">
                <h4>modifica la tecnologia:</h4>
                @foreach ($technologies as $technology)
                    <div class="form-check">
                        <input @checked($errors->any() ? in_array($technology->id,old('technologies',[])) : $project->technologies->contains($technology)) type="checkbox" id="technology-{{ $technology->id }}" value="{{ $technology->id }}" name="technologies[]">
                            <label for="technology-{{ $technology->id }}">{{ $technology->name }}</label>
                    </div>
                @endforeach
            </div>

            <button class="btn btn-primary" type="submit">Salva le modifiche</button>
           
        </form>
    </div>
@endsection