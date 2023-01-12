@extends('layouts.app')

@section('titulo')
   Editar Ingreso {{ auth()->user()->name }} - ID: {{ $ingresos->id }}
@endsection

@section('contenido')

<div class="flex justify-center m-5">

    <form action="{{ route('editar.update') }}" method="POST" novalidate >
        @csrf
        <div class="mb-5">
            
            <input type="hidden" value="{{ $ingresos->id }}" name="id">
            
            <label for="nombre_ingreso" class="mb-2 block uppercase text-gray-500 font-bold">
                Nombre Ingreso
            </label>
            <input 
                id="nombre_ingreso"
                name="nombre_ingreso"
                type="text"
                placeholder="Nombre del ingreso"
                class="border p-3 w-full rounded-lg @error('nombre_ingreso') border-red-500 @enderror"
                value="{{ $ingresos->nombre_ingreso }}"
            />
            @error('nombre_ingreso')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    Por favor escriba el nombre del ingreso
                </p>
            @enderror

            <label for="monto_ingreso" class="mt-3 mb-2 block uppercase text-gray-500 font-bold">
                Monto Ingreso
            </label>
            <input 
                id="monto_ingreso"
                name="monto_ingreso"
                type="number"
                placeholder="Monto del ingreso"
                class="border p-3 w-full rounded-lg @error('monto_ingreso') border-red-500 @enderror"
                value="{{ $ingresos->monto_ingreso }}"
            />
            @error('monto_ingreso')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    Por favor escriba el monto en numeros del ingreso
                </p>
            @enderror


            <input 
                    type="submit"
                    value="Agregar Ingreso"
                    class="mt-5 bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />
        </div>
    </form>
    
</div> 

@endsection