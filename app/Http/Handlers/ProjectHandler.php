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
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class ProjectHandler extends BaseHandler
{

    /**
     * Filters the projects based on filters / Sort / Limit
     * @param array $data
     * @return \Illuminate\Support\Collection
     */
    public function filterProjects(array $data) : Collection
    {

        // Sort and limit the query
        // Dont need to unset the fields as they removed from the normalizeFilters method
        $sort = $this->sort($data, Project::$sortable);
        $limit = $this->limit($data);

        // Remove not acceptable filters and build the payload in order to filter the query
        $filters = $this->normalizeFilters($data, Project::$filters, Constants::AVAILABLE_FILTERS);


        $projects = Project::query();
        // Filter project
        foreach ($filters as $filter) {
            $projects->whereRaw($filter["field"] . ' ' . $filter["query"], [$filter["value"]]);
        }

        $projects->orderBy($sort["field"], $sort["value"]);

        // Attach the default Ordering too in case of duplicate values
        if ($sort["field"] !== self::DEFAULT_SORTING_FIELD) {
            $projects->orderBy(self::DEFAULT_SORTING_FIELD, self::DEFAULT_SORTING_TYPE);
        }

        // Only limit if the limit array has values
        if (!empty($limit)) {
            $projects->offset($limit["offset"]);
            $projects->limit($limit["limit"]);
        }

        return $projects->with(['tags','repositories'])->get();

    }
}
