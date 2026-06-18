<?php

namespace App\Modules\CourseAreas\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Modules\Models\CourseAreas;

class CourseAreasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $items = CourseAreas::latest()->paginate(10);

            return view('courseareas::index', compact('items'));

        } catch (\Throwable $e) {

            Log::error($e);

            return back()->with(
                'error',
                'Erro ao carregar registros.'
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {

            return view('courseareas::create');

        } catch (\Throwable $e) {

            Log::error($e);

            return back()->with(
                'error',
                'Erro ao carregar formulário.'
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $data = $request->all();

            $item = CourseAreas::create($data);

            DB::commit();

            return redirect()
                ->route('courseareas.index')
                ->with(
                    'success',
                    'Registro criado com sucesso.'
                );

        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error($e);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Erro ao criar registro.'
                );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {

            $item = CourseAreas::findOrFail($id);

            return view('courseareas::show', compact('item'));

        } catch (\Throwable $e) {

            Log::error($e);

            return back()->with(
                'error',
                'Erro ao carregar registro.'
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {

            $item = CourseAreas::findOrFail($id);

            return view('courseareas::edit', compact('item'));

        } catch (\Throwable $e) {

            Log::error($e);

            return back()->with(
                'error',
                'Erro ao carregar formulário.'
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $item = CourseAreas::findOrFail($id);

            $data = $request->all();

            $item->update($data);

            DB::commit();

            return redirect()
                ->route('courseareas.index')
                ->with(
                    'success',
                    'Registro atualizado com sucesso.'
                );

        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error($e);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Erro ao atualizar registro.'
                );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $item = CourseAreas::findOrFail($id);

            $item->delete();

            DB::commit();

            return redirect()
                ->route('courseareas.index')
                ->with(
                    'success',
                    'Registro removido com sucesso.'
                );

        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error($e);

            return back()->with(
                'error',
                'Erro ao remover registro.'
            );
        }
    }
}