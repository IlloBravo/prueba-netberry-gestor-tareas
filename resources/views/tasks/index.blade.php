@extends('layouts.app')

@section('title', 'Netberry Solutions')

@section('content')
    <div class="container d-flex flex-column align-items-center mt-5">
        <div class="m-4 w-75">
            <input type="text" id="task-name" class="form-control mt-4 mb-4" placeholder="Nueva tarea...">
            <div class="d-flex flex-wrap justify-content-center gap-4 mt-2 mb-4">
                @foreach ($categories as $category)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input category-checkbox" id="category-{{ $category->id }}" value="{{ $category->id }}">
                        <label class="form-check-label" for="category-{{ $category->id }}">{{ $category->name }}</label>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <button id="add-task" class="btn btn-primary mt-2">Añadir</button>
            </div>
        </div>

        <table class="table table-bordered text-center m-4 w-75">
            <thead class="table-dark">
            <tr>
                <th>Tarea</th>
                <th>Categorías</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody id="task-list">
            <tr id="no-tasks-message">
                <td colspan="3" class="text-muted">No hay tareas programadas aún</td>
            </tr>
            </tbody>
        </table>

        <div id="success-message" class="alert alert-success d-none text-center m-4 w-50" role="alert"></div>
        <div id="error-message" class="alert alert-danger d-none text-center m-4 w-50" role="alert"></div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/gestor-tareas/main.js') }}" type="module"></script>
@endsection
