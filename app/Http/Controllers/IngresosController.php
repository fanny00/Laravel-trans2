<?php

namespace App\Http\Controllers;

use App\Models\Egreso;
use App\Models\Ingreso;
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
        $ingresos = Ingreso::orderBy('id','desc')->paginate(5);

        $egresos = Egreso::orderBy('id','desc')->paginate(5);

        return view('ingresos', [
            'user' => $user,
            'egresos' => $egresos,
            'ingresos' => $ingresos
        ]);
    }

    public function store(Request $request )
    {

        $this->validate($request, [
            'usuario_id' => 'required',
            'nombre_ingreso' => 'required|max:30',
            'monto_ingreso'  => 'required',
        ]);

        Ingreso::create([
            'usuario_id' => $request->usuario_id,
            'nombre_ingreso' => $request->nombre_ingreso,
            'monto_ingreso'  => $request->monto_ingreso,
        ]);

        return redirect()->route('ingresos.index')->with('success','Ingreso de monto realizado con exito.');
    }

    public function show($id)
    {
      $ingresos=Ingreso::find($id);
      
      return view('editar', [
        'ingresos' => $ingresos
      ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'nombre_ingreso' => 'required|max:30',
            'monto_ingreso'  => 'required',
        ]);

        $ingresosData=Ingreso::find($request->id);
 
        $ingresosData->nombre_ingreso = $request->nombre_ingreso;
        $ingresosData->monto_ingreso  = $request->monto_ingreso;
        $ingresosData->save();
      
        return redirect()->route('ingresos.index')->with('success','Edicion de monto realizado con exito.');
     
    }

    public function destroy($id)
    {
        Ingreso::destroy($id);

        return redirect()->route('ingresos.index')->with('message','Eliminación correcta');
    }

}
