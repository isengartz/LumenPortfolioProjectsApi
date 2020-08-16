<?php

namespace App\Http\Controllers;

use App\Handlers\ProjectHandler;
use App\Project;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Utility\Constants;
/**
 * Class ProjectController
 * @package App\Http\Controllers
 */
class ProjectController extends Controller
{

    use ApiResponser;


    private $projectHandler;

    /**
     * Create a new controller instance.
     *
     * @param ProjectHandler $projectHandler
     */
    public function __construct(ProjectHandler $projectHandler)
    {
        $this->projectHandler=$projectHandler;
    }

    /**
     * Returns all projects
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) : JsonResponse
    {
        // Return filtered projects
        $projects = $this->projectHandler->filterProjects($request->all());

        return $this->successResponse($projects);
    }



    /**
     * Store a project to database
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) : JsonResponse
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
    public function show($project) : JsonResponse
    {
        $project = Project::with('tags')->findOrFail($project);
        return $this->successResponse($project);
    }

    /**
     * Update a project
     * @param Request $request
     * @param $project
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     * @todo: Update the Project Tag. Too bored to do now
     */
    public function update(Request $request, $project) : JsonResponse
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
    public function destroy($project) : JsonResponse
    {
        $project = Project::findOrFail($project);
        $project->delete();
        return $this->successResponse($project);
    }
}
