@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Asignar Materias a {{ $profesor->nombre }}</h2>

    <form action="{{ route('profesores.materias', $profesor->id) }}" method="POST">
        @csrf
        <label for="materias">Seleccionar Materias:</label>
        <select name="materias[]" id="materias" class="form-control" multiple>
            @foreach($materias as $materia)
                <option value="{{ $materia->id }}" 
                    {{ $profesor->materias->contains($materia->id) ? 'selected' : '' }}>
                    {{ $materia->nombre }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary mt-2">Guardar</button>
    </form>
</div>
@endsection
