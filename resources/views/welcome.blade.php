@extends('layouts.app')

@section('title', 'Bienvenido')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="flex items-center gap-2">

            <a href="/api"
               class="px-6 py-3 bg-blue-600 text-white rounded-lg text-lg font-semibold hover:bg-blue-700 transition">
                API
            </a>

            <a href="{{ route('login') }}"
               class="px-6 py-3 bg-blue-600 text-white rounded-lg text-lg font-semibold hover:bg-green-700 transition">
                Login
            </a>

            <a href="{{ route('register') }}"
               class="px-6 py-3 bg-blue-600 text-white rounded-lg text-lg font-semibold hover:bg-indigo-700 transition">
                Registro
            </a>

        </div>
    </div>
@endsection
