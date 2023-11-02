@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection
    
@section('contenido')
    <div class="container mx-auto md:flex gap-4">
        <div class="md:1/2">
            <img src="{{ asset('uploads'.'/'. $post->imagen) }}" alt="Foto publicacion">
            <div class="p-3 flex items-center">

                {{-- con likewire realizamos las peticiones para los likes aqui se esta imprimiendo como si fuera un componente --}}
                @auth
                <livewire:like-post :post="$post" />
                @endauth
            </div>

            <div class="">
                <p class="font-bold">{{ $post->user->username }}</p>
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                <p class="mt-5">{{$post->descripcion}}</p>
            </div>

            @auth
                @if ($post->user_id === auth()->user()->id)

                <form action="{{route('post.destroy', $post)}}" method="POST">
                    {{-- METODO SPOOFING = PERMITE AGREGAR OTRAS PETICIONES COMO PUTHPACH O DELETE --}}
                    @method('DELETE') 
                        @csrf
                        <input type="submit" value="Eliminar Publicacion" class="bg-red-500 hover:bg-red-600 p-2 rounded text-white mt-4 cursor-pointer text-center">
                    </form>
                @endif

            @endauth

        </div>
        <div class="md:1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">

                @auth
                    <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>

                @if(session('mensaje'))
                    <div class="bg-green-500 p-2 rounded-lg mb-6 text-white uppercase font-bold">
                        {{session('mensaje')}}
                    </div>
                @endif

                    <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user]) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 uppercase text-gray-500 font-bold">Añade un comentario:</label>
                            <textarea id="comentario" name="comentario" placeholder="Descripcion de la publicacion" class="border p-3 w-full rounded-lg"></textarea>
                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }} </p>
                            @enderror
                        </div>
                        <input type="submit" value="Comentar" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full rounded-lg p-3">
                    </form>
                @endauth
                
                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <a class="font-bold" href="{{ route('posts.index',$comentario->user) }}"> {{$comentario->user->username}} </a>
                                <p>{{ $comentario->comentario }}</p>
                                <p class="text-sm text-gray-500"> {{ $comentario->created_at->diffForHumans() }} </p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No hay comentarios!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

