@extends('layouts.app')

@section('titulo')
    Inicia Sesion en Devstagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <p><img src="{{asset('img/login.jpg')}}" alt="Imagen Login usuarios"></p>
        </div>
        <div class="md:w-4/12">
            <form method="post" action="{{ route('login') }}" novalidate>
                {{-- este parametro es para evitar ataques de cross site request --}}
                @csrf 

                @if (session('mensaje'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ session('mensaje') }} </p>
                @endif

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Tu email de registro" class="border p-3 w-full rounded-lg" value="{{old('email')}}">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }} </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Tu password de registro" class="border p-3 w-full rounded-lg">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }} </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember" class="text-gray-500 text-sm">Mantener mi sesion abierta</label>
                </div>
                <input type="submit" value="Iniciar Sesion" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full rounded-lg p-3">
            </form>
        </div>
    </div>
@endsection