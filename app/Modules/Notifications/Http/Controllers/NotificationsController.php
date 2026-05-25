<?php
namespace App\Modules\Notifications\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Models\Notifications;
use App\Modules\Notifications\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function readAll()
    {
        Notification::whereNull('viewed_at')->update(['viewed_at' => now()]);

        return back();
    }

    public function read(Notification $notification)
    {
        $notification->update(['viewed_at' => now(),]);

        return back();
    }

    public function index()
    {
        try {

            $items = Notifications::latest()->paginate(10);

            return view('notifications::index', compact('items'));

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

            return view('notifications::create');

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

            $item = Notifications::create($data);

            DB::commit();

            return redirect()
                ->route('notifications.index')
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

            $item = Notifications::findOrFail($id);

            return view('notifications::show', compact('item'));

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

            $item = Notifications::findOrFail($id);

            return view('notifications::edit', compact('item'));

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

            $item = Notifications::findOrFail($id);

            $data = $request->all();

            $item->update($data);

            DB::commit();

            return redirect()
                ->route('notifications.index')
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

            $item = Notifications::findOrFail($id);

            $item->delete();

            DB::commit();

            return redirect()
                ->route('notifications.index')
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
