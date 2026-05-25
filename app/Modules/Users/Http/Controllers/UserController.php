<?php
namespace App\Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Centers\Models\Center;
use App\Modules\Users\Http\Requests\UserRequest;
use App\Modules\Users\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $users = User::with('access_level')->latest()->paginate(40);

            return view('users::index', compact('users'));

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
            return view('users::create');

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
    public function store(UserRequest $request)
    {
        DB::beginTransaction();

        try {

            $data = $request->validated();

            $data['password'] = Hash::make($data['password']);

            $user = User::create($data);

            DB::commit();

            return redirect()
                ->route('users.index')
                ->with('success', 'Registro criado com sucesso.');

        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error($e);

            return back()
                ->withInput()
                ->with('error', 'Erro ao criar registro.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {

            $user = User::findOrFail($id);

            return view('users::show', compact('user'));

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

            $user = User::with('access_level', 'center')->findOrFail($id);
            
            return view('users::create', compact('user'));

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
    public function update(UserRequest $request, $id)
    {
        DB::beginTransaction();

        try {

            $user = User::findOrFail($id);

            $data = $request->validated();

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            } else {
                unset($data['password']);
            }

            $user->update($data);

            DB::commit();

            return redirect()
                ->route('users.index')
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

            $user = User::findOrFail($id);

            $user->delete();

            DB::commit();

            return redirect()
                ->route('users.index')
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