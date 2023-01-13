<?php
namespace App\Http\Controllers;

use App\Models\Egreso;
use App\Models\Ingreso;
use App\Models\User;
use Illuminate\Http\Request;

class EgresosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user) {

        $egresos = Egreso::orderBy('id','desc')->paginate(5);

        $ingresos = Ingreso::orderBy('id','desc')->paginate(5);

        return view('egresos', [
            'user' => $user,
            'egresos' => $egresos,
            'ingresos' => $ingresos
        ]);
    }

    public function store(Request $request )
    {

        $this->validate($request, [
            'usuario_id' => 'required',
            'nombre_egreso' => 'required|max:30',
            'monto_egreso'  => 'required',
        ]);

        Egreso::create([
            'usuario_id' => $request->usuario_id,
            'nombre_egreso' => $request->nombre_egreso,
            'monto_egreso'  => $request->monto_egreso,
        ]);

        return redirect()->route('egresos.index')->with('success','Egreso de monto realizado con exito.');
    }

    public function show($id)
    {
      $egresos=Egreso::find($id);
      
      return view('editar-egreso', [
        'editar-egreso' => $egresos
      ]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'nombre_egreso' => 'required|max:30',
            'monto_egreso'  => 'required',
        ]);

        $egresosData=Egreso::find($request->id);
 
        $egresosData->nombre_egreso = $request->nombre_egreso;
        $egresosData->monto_egreso  = $request->monto_egreso;
        $egresosData->save();
      
        return redirect()->route('egresos.index')->with('success','Edicion de monto realizado con exito.');
     
    }

    public function destroy($id)
    {
        Egreso::destroy($id);

        return redirect()->route('egresos.index')->with('message','Eliminación correcta');
    }
}
