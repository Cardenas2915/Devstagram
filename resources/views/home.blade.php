@extends('layouts.app')

@section('titulo')
    Pagina Principal
@endsection

@section('contenido')
    {{-- este es un componente y le estamos pasando la variable de posts que tambien hay que definir en listarPost.php en el constructor --}}
    <x-listar-post :posts="$posts" />
@endsection