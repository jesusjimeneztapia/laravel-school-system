<?php

namespace App\Http\Controllers;

use App\Http\Requests\level\LevelPostRequest;
use App\Http\Requests\level\LevelPutRequest;
use App\Models\Level;
use App\Models\settings\Period;
use Illuminate\Database\QueryException;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $levels = Level::all();
        $data = [];
        foreach ($levels as $i => $level) {
            $nro = $i + 1;

            $btnDetails =
                '<a href="'.route('levels.show', ['level'=>$level]).'" class="btn btn-xs btn-default text-info mx-1 shadow" title="Detalles">
                    <i class="fa fa-lg fa-fw fa-eye"></i>
                </a>';
            $btnEdit =
                '<a href="'.route('levels.edit', ['level'=>$level]).'" class="btn btn-xs btn-default text-warning mx-1 shadow" title="Editar">
                    <i class="fa fa-lg fa-fw fa-pen"></i>
                </a>';
            $btnDelete = "
                <button class='btn btn-xs btn-default text-danger mx-1 shadow' title='Eliminar' onclick='answer(\"$level->name\", \"".route('levels.destroy', $level)."\")'>
                    <i class='fa fa-lg fa-fw fa-trash'></i>
                </button>";

            $stateColor = $level->state == '1' ? 'text-success' : 'text-danger';
            $stateLabel = $level->state == '1' ? 'Activo' : 'Inactivo';
            $state = "<span class='$stateColor'>$stateLabel</span>";
            $data[] = [$nro, $level->period()->get('period')[0]->period, $level->name, $level->shift, $state, '<nobr>'.$btnDetails.$btnEdit.$btnDelete.'</nobr>'];
        }
        return view('admin.levels.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $periods = Period::all()->where('state', '1');
        return view('admin.levels.create', compact('periods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LevelPostRequest $request)
    {
        $level = new Level();
        $level->period_id = $request->input('period_id');
        $level->name = $request->input('name');
        $level->shift = $request->input('shift');

        try {
            $level->save();
            $name = $level->name;
            $shift = $level->shift;
            $period = $level->period()->get('period')[0]->period;
            $request->session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => 'success',
                config('constants.TOASTR_MESSAGE') => "El nivel '$name - $shift - $period' fue creado con éxito",
                config('constants.TOASTR_TITLE') => 'Nuevo nivel creado'
            ]);
            return redirect()->route('levels.index');
        } catch (QueryException $e) {
            $message = 'Ocurrió algún error inesperado, intente más tarde';
            $title = 'Error al crear el nivel';
            $mode = 'error';
            $errors = [];
            if ($e->getCode() == 23000) {
                echo $e;
                $message = "La gestión no existe";
                $errors = ['period_id' => 'La gestión no está registrada.'];
            }
            $request->session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => $mode,
                config('constants.TOASTR_MESSAGE') => $message,
                config('constants.TOASTR_TITLE') => $title
            ]);
            return redirect()->route('levels.create')->withInput()->withErrors($errors);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Level $level)
    {
        return view('admin.levels.show', compact('level'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Level $level)
    {
        $periods = Period::all()->where('state', '1');
        return view('admin.levels.edit', compact('level', 'periods'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LevelPutRequest $request, Level $level)
    {
        $level->period_id = $request->input('period_id');
        $level->name = $request->input('name');
        $level->shift = $request->input('shift');

        try {
            $level->save();
            $name = $level->name;
            $shift = $level->shift;
            $period = $level->period()->get('period')[0]->period;
            $request->session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => 'success',
                config('constants.TOASTR_MESSAGE') => "El nivel '$name - $shift - $period' fue actualizado con éxito",
                config('constants.TOASTR_TITLE') => 'Nivel actualizado'
            ]);
            return redirect()->route('levels.index');
        } catch (QueryException $e) {
            $message = 'Ocurrió algún error inesperado, intente más tarde';
            $title = 'Error al actualizar el nivel';
            $mode = 'error';
            $errors = [];
            if ($e->getCode() == 23000) {
                echo $e;
                $message = "La gestión no existe";
                $errors = ['period_id' => 'La gestión no está registrada.'];
            }
            $request->session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => $mode,
                config('constants.TOASTR_MESSAGE') => $message,
                config('constants.TOASTR_TITLE') => $title
            ]);
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Level $level)
    {
        try {
            $level->delete();
            session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => 'success',
                config('constants.TOASTR_MESSAGE') => "El nivel fue eliminado con éxito",
                config('constants.TOASTR_TITLE') => 'Nivel eliminado'
            ]);
        } catch (QueryException $e) {
            session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => 'error',
                config('constants.TOASTR_MESSAGE') => 'Ocurrió algún error inesperado, intente más tarde',
                config('constants.TOASTR_TITLE') => 'Error al eliminar el nivel'
            ]);
        }
        return redirect()->route('levels.index');
    }
}
