{{ dd('llego aqui editar')}}
@extends('layouts.app')

@section('titulo')
   Editar Egreso {{ auth()->user()->name }} - ID: {{ $egresos->id }}
@endsection

@section('contenido')

<div class="flex justify-center m-5">

    <form action="{{ route('editar-egreso.update') }}" method="POST" novalidate >
        @csrf
        <div class="mb-5">
            
            <input type="hidden" value="{{ $egresos->id }}" name="id">
            
            <label for="nombre_egreso" class="mb-2 block uppercase text-gray-500 font-bold">
                Nombre Egreso
            </label>
            <input 
                id="nombre_egreso"
                name="nombre_egreso"
                type="text"
                placeholder="Nombre del egreso"
                class="border p-3 w-full rounded-lg @error('nombre_egreso') border-red-500 @enderror"
                value="{{ $egresos->nombre_egreso }}"
            />
            @error('nombre_egreso')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    Por favor escriba el nombre del egreso
                </p>
            @enderror

            <label for="monto_egreso" class="mt-3 mb-2 block uppercase text-gray-500 font-bold">
                Monto Egreso
            </label>
            <input 
                id="monto_egreso"
                name="monto_egreso"
                type="number"
                placeholder="Monto del egreso"
                class="border p-3 w-full rounded-lg @error('monto_egreso') border-red-500 @enderror"
                value="{{ $egresos->monto_egreso }}"
            />
            @error('monto_egreso')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    Por favor escriba el monto en numeros del egreso
                </p>
            @enderror


            <input 
                    type="submit"
                    value="Agregar Egreso"
                    class="mt-5 bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />
        </div>
    </form>
    
</div> 

@endsection