@extends('layouts.app')

@section('titulo')
   Egresos {{ auth()->user()->name }}
@endsection

@section('contenido')


@if(session()->has('message'))
<div class="mx-auto w-4/5 pb-10">
    <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
        Warning
    </div>
    <div class="border border-t-1 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
          {{ session()->get('message')}}
    </div>
</div>

@endif

<div class="flex justify-center m-5">

    <form action="{{ route('egresos.index') }}" method="POST" novalidate >
        @csrf
        <div class="mb-5">

            <input type="hidden" value="{{auth()->user()->id}}" name="usuario_id">
            
            <label for="nombre_egreso" class="mb-2 block uppercase text-gray-500 font-bold">
                Nombre Egreso
            </label>
            <input 
                id="nombre_egreso"
                name="nombre_egreso"
                type="text"
                placeholder="Nombre del egreso"
                class="border p-3 w-full rounded-lg @error('nombre_egreso') border-red-500 @enderror"
                value="{{ old('nombre_egreso') }}"
            />
            @error('nombre_egreso')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    Por favor escriba un nombre de egreso
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
                value="{{ old('monto_egreso') }}"
            />
            @error('monto_egreso')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    Por favor escriba el monto en numeros del egreso
                </p>
            @enderror


            <label for="total_egreso" class="mt-3 mb-2 block uppercase text-gray-500 font-bold">
                Monto Egreso
            </label>

            <input 
                    type="submit"
                    value="Agregar Egreso"
                    class="mt-5 bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />
        </div>
    </form>
    
</div> 
<div class="flex justify-center">
        
    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <table class="min-w-full rp-6 rounded-lg shadow-xl">
                <thead class="bg-sky-100 border-b">
                    <tr>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            Id
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            Nombre Egreso
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            Monto Egreso
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            
                        </th>
                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                            
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($egresos as $egreso)
                    
                        <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $egreso->id }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                {{ $egreso->nombre_egreso }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                               $ {{ $egreso->monto_egreso }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('editar-egreso',$egreso->id) }}" class="cursor-pointer uppercase inline-block px-2 py-1 bg-sky-600 text-white font-medium text-xs leading-tight rounded shadow-md hover:bg-sky-700 hover:shadow-lg focus:bg-sky-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                    Editar
                                </a>
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                <form method="POST" action="{{route('egresos.destroy',$egreso->id)}}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="inline-block px-2 py-1 bg-red-500 text-white font-medium text-xs leading-tight rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>

                       
                    @endforeach

                    <div>

                    </div>
                </tbody>
                </table>
                <div class="text-lg font-bold text-sky-800 px-6 py-4 text-right">
                    Total Ingresos :  ${{ $ingresos->sum('monto_ingreso') }} -
                    Total Egresos :  ${{ $egresos->sum('monto_egreso') }} 
                </div>
                <div class="text-lg font-bold text-sky-800 px-6 py-4 text-right uppercase">
                    Saldo Total :  ${{ $ingresos->sum('monto_ingreso') - $egresos->sum('monto_egreso') }}
                    
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection