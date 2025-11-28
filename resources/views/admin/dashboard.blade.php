@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Panel Principal')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-medium text-gray-900">Total Usuarios</h3>
            <p class="mt-2 text-3xl font-bold text-blue-600">1,234</p>
        </div>
    </div>
@endsection
