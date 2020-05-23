<?php

namespace App\Http\Controllers;

use App\Project;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Utility\Constants;

/**
 * Class ProjectController
 * @package App\Http\Controllers
 */
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
     * Returns all projects
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $project = Project::all();
        return $this->successResponse($project);
    }

    /**
     * Store a project to database
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:255',
        ];
        $this->validate($request, $rules);
        $project = Project::create($request->all());
        return $this->successResponse($project, Response::HTTP_CREATED);

    }

    /**
     * Returns one project
     * @param $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($project)
    {
        $project = Project::findOrFail($project);
        return $this->successResponse($project);
    }

    /**
     * Update a project
     * @param Request $request
     * @param $project
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $project)
    {
        $rules = [
            'title' => 'max:255',
        ];
        $this->validate($request, $rules);

        $project = Project::findOrFail($project);
        $project->fill($request->all());

        // If there are no changes on the record don't update
        if ($project->isClean()) {
            return $this->errorResponse(Constants::CONSTANT_MESSAGES["ONE_VALUE_MUST_CHANGE"], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $project->save();

        return $this->successResponse($project);
    }

    /**
     * Deletes a project
     * @param $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($project)
    {
        $project = Project::findOrFail($project);
        $project->delete();
        return $this->successResponse($project);
    }
}
