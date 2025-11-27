<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datos['empleados'] = Empleado::paginate(5);
        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $datosEmpleado = request()->except('_token');
        if ($request->hasFile('Foto')) {
            $datosEmpleado['Foto'] = $request->file('Foto')->store('uploads', 'public');
        }
        //Toma el modelo de la tabla e inserta los datos
        Empleado::insert($datosEmpleado);
        return redirect('empleado')->with('mensaje', 'Empleado agregado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $empleado = Empleado::findOrFail($id);
        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $datosEmpleado = request()->except(['_token', '_method']);
        //Toma el modelo de la tabla y modifica
        Empleado::where('id', '=', $id)->update($datosEmpleado);
        $empleado = Empleado::findOrFail($id);
        return view('empleado.edit', compact('empleado'));

        if ($request->hasFile('Foto')) {
            $empleado = Empleado::findOrFail($id);
            Storage::delete('public/' . $empleado->Foto); //borra la imagen anterior
            $datosEmpleado['Foto'] = $request->file('Foto')->store('uploads', 'public');
            //guarda la nueva imagen

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $empleado = Empleado::findOrFail($id);
        if (Storage::delete('public/' . $empleado->Foto)) {
            Empleado::destroy($id);
        }
        return redirect('empleado')->with('mensaje', 'El registro del empleado se borró satisfactoriamente');
    }
}
