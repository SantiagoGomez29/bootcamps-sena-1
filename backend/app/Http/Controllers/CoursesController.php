<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;
use File;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Resources\CourseResource;
use App\Http\Resources\CourseCollection;


class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return response()->json(new CourseCollection(Course::all()), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request, $id)
    {
        /*var_dump($request->all());
        echo "<hr />";
        var_dump($id);*/

        //Crear un nuevo curso
        $curso = new Course();
        $curso->title = $request->title;
        $curso->description = $request->description;
        $curso->weeks = $request->weeks;
        $curso->enroll_cost =$request->enroll_cost;
        $curso->minimum_skill = $request->minimum_skill;
        $curso->bootcamp_id = $id;
        $curso->save();

        //Enviar response
        return response()->json( [
            "success" => true,
            "data" => $curso
        ], 201 );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(
            [
                "success" => true,
                "data" => new CourseResource(Course::find($id))
            ],200
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //1. Se selecciona el id del curso registrado
        $curso = Course::find($id);

        //2. Se actualiza
        $curso->update(
            $request->all()
        );

        //3. Response correspondiente
        return response()->json(
            [
                "success" => true,
                "data" =>  new CourseResource($curso)
            ],200
        );

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //1. Se selecciona el curso
        $curso = Course::find($id);

        //2. Eliminar ese curso
        $curso->delete();

        //3. Response
        return response()->json(
            [
                "success" => true,
                "message" => "Curso eliminado con Id: $id",
                "data" => $curso -> $id

            ],200
    );
    }
}
