<?php

namespace App\Modules\SecretaryRequests\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\StudentRequests\Models\StudentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SecretaryRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $items = StudentRequest::latest()->paginate(10);
            
            $pendentes = StudentRequest::where('status', 'Pendente')->count();
            $emAnalise = StudentRequest::where('status', 'Em Análise')->count();
            $concluidas = StudentRequest::where('status', 'Concluído')->count();
            $total = StudentRequest::count();

            return view('secretaryrequests::index', compact(
            'items',
            'pendentes',
            'emAnalise',
            'concluidas',
            'total'));

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

            return view('secretaryrequests::create');

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

            $item = StudentRequest::create($data);

            DB::commit();

            return redirect()
                ->route('secretaryrequests.index')
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

            $item = StudentRequest::findOrFail($id);

            return view('secretaryrequests::show', compact('item'));

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

            $item = StudentRequest::findOrFail($id);

            return view('secretaryrequests::edit', compact('item'));

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

            $item = StudentRequest::findOrFail($id);

            $data = $request->all();

            $item->update([
                'status' => $request->status 
            ]);

            DB::commit();

            return redirect()
                ->route('secretaryrequests.index')
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

            $item = StudentRequest::findOrFail($id);

            $item->delete();

            DB::commit();

            return redirect()
                ->route('secretaryrequests.index')
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