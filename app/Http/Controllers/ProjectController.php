<?php

namespace App\Http\Controllers;
use App\Project;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $project = Project::all();
        return $this->successResponse($project);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        $rules = [
            'title' => 'required|max:255',
        ];
        $this->validate($request,$rules);
        $project = Project::create($request->all());
        return $this->successResponse($project, Response::HTTP_CREATED);

    }

    /**
     * @param $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($project) {
        $project = Project::findOrFail($project);
        return $this->successResponse($project);
    }

    /**
     * @param Request $request
     * @param $project
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request,$project) {
        $rules = [
            'title' => 'max:255',
        ];
        $this->validate($request,$rules);

        $project = Project::findOrFail($project);
        $project->fill($request->all());

        if($project->isClean()){
            return $this->errorResponse('At least one value must change',Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $project->save();

        return $this->successResponse($project);
    }

    public function destroy($project){
        $project = Project::findOrFail($project);
        $project->delete();
        return $this->successResponse($project);
    }
}
