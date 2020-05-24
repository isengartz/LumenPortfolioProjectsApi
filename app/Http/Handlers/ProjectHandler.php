<?php
/**
 * Created by PhpStorm.
 * User: Sin
 * Date: 24/5/2020
 * Time: 3:15 μμ
 */

namespace App\Handlers;

use App\Http\Handlers\BaseHandler;
use App\Utility\Constants;
use App\Project;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class ProjectHandler extends BaseHandler
{

    /**
     * @param array $data
     * @return \Illuminate\Support\Collection
     */
    public function filterProjects(array $data) : Collection
    {
        $filters = $this->normalizeFilters($data, Project::$filters, Constants::AVAILABLE_FILTERS);

        $projects = DB::table('projects');
        foreach ($filters as $value=>$filter){
            $projects->whereRaw($filter,[$value]);
        }

        return $projects->get();

    }
}
