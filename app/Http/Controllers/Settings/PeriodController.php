<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\settings\periods\PeriodPostRequest;
use App\Http\Requests\settings\periods\PeriodPutRequest;
use App\Models\settings\Period;
use Illuminate\Database\QueryException;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periods = Period::all();
        $data = [];
        foreach ($periods as $i => $period) {
            $nro = $i + 1;

            $btnDetails =
                '<a href="'.route('settings.periods.show', ['period'=>$period]).'" class="btn btn-xs btn-default text-info mx-1 shadow" title="Detalles">
                    <i class="fa fa-lg fa-fw fa-eye"></i>
                </a>';
            $btnEdit =
                '<a href="'.route('settings.periods.edit', ['period'=>$period]).'" class="btn btn-xs btn-default text-warning mx-1 shadow" title="Editar">
                    <i class="fa fa-lg fa-fw fa-pen"></i>
                </a>';
            $btnDelete = "
                <button class='btn btn-xs btn-default text-danger mx-1 shadow' title='Eliminar' onclick='answer(\"$period->period\", \"".route('settings.periods.destroy', $period)."\")'>
                    <i class='fa fa-lg fa-fw fa-trash'></i>
                </button>";

            $date = date('l j F Y', strtotime($period->created_at));
            $stateColor = $period->state == '1' ? 'text-success' : 'text-danger';
            $stateLabel = $period->state == '1' ? 'Activo' : 'Inactivo';
            $state = "<span class='$stateColor'>$stateLabel</span>";
            $data[] = [$nro, $period->period, $date, $state, '<nobr>'.$btnDetails.$btnEdit.$btnDelete.'</nobr>'];
        }
        return view('admin.settings.periods.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings.periods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PeriodPostRequest $request)
    {
        $name = mb_strtoupper($request->input('period'), 'UTF-8');
        $period = new Period();
        $period->period = $name;
        $period->state = $request->input('state');

        try {
            $period->save();
            $request->session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => 'success',
                config('constants.TOASTR_MESSAGE') => "La gestión '$name' fue creada con éxito",
                config('constants.TOASTR_TITLE') => 'Nueva gestión creada'
            ]);
            return redirect()->route('settings.periods.index');
        } catch (QueryException $e) {
            $message = 'Ocurrió algún error inesperado, intente más tarde';
            $title = 'Error al crear la gestión';
            $mode = 'error';
            $errors = [];
            if ($e->getCode() == 23000) {
                $message = "La gestión '$name' ya existe";
                $errors = ['period' => 'La gestión ya está registrada.'];
            }
            $request->session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => $mode,
                config('constants.TOASTR_MESSAGE') => $message,
                config('constants.TOASTR_TITLE') => $title
            ]);
            return redirect()->route('settings.periods.create')->withInput()->withErrors($errors);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Period $period)
    {
        return view('admin.settings.periods.show', compact('period'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Period $period)
    {
        return view('admin.settings.periods.edit', compact('period'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PeriodPutRequest $request, Period $period)
    {
        $name = mb_strtoupper($request->input('period'), 'UTF-8');
        $period->period = $name;
        $period->state = $request->input('state');

        try {
            $period->save();
            $request->session()->put(config('constants.TOASTR'), [
                config('constants.TOASTR_MODE') => 'success',
                config('constants.TOASTR_MESSAGE') => "La gestión '$name' fue actualizada con éxito",
                config('constants.TOASTR_TITLE') => 'Gestión actualizada'
            ]);
            return redirect()->route('settings.periods.index');
        } catch (QueryException $e) {
            $message = 'Ocurrió algún error inesperado, intente más tarde';
            $title = 'Error al actualizar la gestión';
            $mode = 'error';
            $errors = [];
            if ($e->getCode() == 23000) {
                $message = "La gestión '$name' ya existe";
                $errors = ['period' => 'La gestión ya está registrada.'];
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
    public function destroy(Period $period)
    {
        //
    }
}
