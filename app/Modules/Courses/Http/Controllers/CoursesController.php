<?php

namespace App\Modules\Courses\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Courses\Http\Requests\CourseRequest;
use App\Modules\Courses\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $courses = Course::latest()->paginate(10);

            return view('courses::index', compact('courses'));

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

            return view('courses::create');

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
    public function store(CourseRequest $request)
    {
        DB::beginTransaction();

        try {

            $data = $request->all();

            $course = Course::create($data);

            DB::commit();

            return redirect()
                ->route('courses.index')
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

            $course = Courses::findOrFail($id);

            return view('courses::show', compact('course'));

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

            $course = Courses::findOrFail($id);

            return view('courses::edit', compact('course'));

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

            $course = Courses::findOrFail($id);

            $data = $request->all();

            $course->update($data);

            DB::commit();

            return redirect()
                ->route('courses.index')
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

            $course = Courses::findOrFail($id);

            $course->delete();

            DB::commit();

            return redirect()
                ->route('courses.index')
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