<?php

namespace App\Modules\StudentRequests\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\StudentRequests\Models\StudentRequest;
use App\Modules\StudentRequests\Http\Requests\StudentRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudentRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $StudentRequests = StudentRequest::latest()->paginate(10);

            return view('studentrequests::index', compact('StudentRequests'));

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

            return view('studentrequests::create');

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

            $data['status'] = 'Pendente';

            $StudentRequest = StudentRequest::create($data);

            DB::commit();

            return redirect()
                ->route('studentrequests.index')
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

            $StudentRequest = StudentRequest::findOrFail($id);

            return view('studentrequests::show', compact('StudentRequest'));

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

            $StudentRequest = StudentRequest::findOrFail($id);

            return view('studentrequests::edit', compact('StudentRequest'));

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

            $StudentRequest = StudentRequest::findOrFail($id);

            $data = $request->all();

            $StudentRequest->update($data);

            DB::commit();

            return redirect()
                ->route('studentrequests.index')
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

            $StudentRequest = StudentRequest::findOrFail($id);

            $StudentRequest->delete();

            DB::commit();

            return redirect()
                ->route('studentrequests.index')
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