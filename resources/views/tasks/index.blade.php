@extends('layouts.app')

@section('title', 'Lista de Tareas')

@section('sidebar')
    @parent
    <p>Bienvenido a la página de tareas.</p>
@endsection

@section('content')
    <h1>------tareas------</h1>
    <a href="/tasks/create" class="button">Crear</a>
    <ul>
        @foreach ($tasks as $task)
            <li>
                <a href="/tasks/{{ $task->id }}">{{ $task->name }}</a>
                <form action="{{ url('/tasks/' . $task->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button" onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">Eliminar</button>
                </form>
                <button>Completar</button>
            </li>
        @endforeach
    </ul>
@endsection

