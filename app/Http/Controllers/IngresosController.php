<?php

namespace App\Http\Controllers;

use App\Models\Ingresos;
use App\Models\User;

use Illuminate\Http\Request;

class IngresosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(User $user)
    {
        // dd($user->username);
        $ingresos = Ingresos::orderBy('id','desc')->paginate(5);
        return view('ingresos', [
            'user' => $user,
            'ingresos' => $ingresos
        ]);
    }

    public function store(Request $request )
    {

        Ingresos::create([
            'usuario_id' => $request->usuario_id,
            'nombre_ingreso' => $request->nombre_ingreso,
            'monto_ingreso'  => $request->monto_ingreso,
        ]);

        return redirect()->route('ingresos.index')->with('success','Ingreso de monto realizado con exito.');
    }

    public function show($id)
    {
      $ingresos=Ingresos::find($id);
      
      return view('editar', [
        'ingresos' => $ingresos
      ]);
    }

    public function update(Request $request)
    {
        $ingresosData=Ingresos::find($request->id);
 
        $ingresosData->nombre_ingreso = $request->nombre_ingreso;
        $ingresosData->monto_ingreso  = $request->monto_ingreso;
        $ingresosData->save();
      
        return redirect()->route('ingresos.index')->with('success','Edicion de monto realizado con exito.');
     
    }

    public function destroy($id)
    {
        Ingresos::destroy($id);

        return redirect()->route('ingresos.index')->with('message','Eliminación correcta');
    }

}
