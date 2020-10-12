<?php
/**
 * Created by PhpStorm.
 * User: Sin
 * Date: 24/5/2020
 * Time: 3:16 μμ
 */

namespace App\Http\Handlers;


abstract class BaseHandler
{
    // Constants for Sorting / Limit
    protected const DEFAULT_SORTING_FIELD = 'id';
    protected const DEFAULT_SORTING_TYPE = 'ASC';
    protected const DEFAULT_LIMIT_NUMBER = 20;
    protected const DEFAULT_OFFSET_NUMBER = 0;

    /**
     * Return an array with "normalized" filter data
     * @param array $data
     * @param array $filterableCols
     * @param array $availableFilters
     * @return array
     */
    protected function normalizeFilters(array $data, array $filterableCols, array $availableFilters) : array
    {
        $normalized = [];
        foreach ($data as $field => $value) {
            // Parse only fields that we allow to become a filter
            if (in_array($field, $filterableCols)) {
                // $opValue[0] is the filter , $opValue[1] is the value
                $opValue = explode(':', $value);
                // check if the filter is valid
                if (array_key_exists($opValue[0], $availableFilters)) {
                    // we will have an array containing the field name, the query and the value
                    // ex : ["field" => "id", "query" => ">=" , "value" => 1
                    $normalized[] = [
                        "field" => $field,
                        "query" => $availableFilters[$opValue[0]],
                        "value" => $opValue[1]
                    ];
                }
            }
        }
        return $normalized;
    }

    /**
     * Creates the sorting
     * @param array $data
     * @param array $sortableFields
     * @return array
     */
    protected function sort(array $data, array $sortableFields) : array
    {

        // If request doesnt have a sort field use the default sort
        if (!isset($data["sort"])) {
            return $this->defaultSort();
        }

        $sortData = explode(":", $data["sort"]);

        // Check if the sortType is defined by the user
        // If not add the default sortType ( ASC )
        if (count($sortData) < 2) {
            $sortType = self::DEFAULT_SORTING_TYPE;
            $sortField = $data["sort"];
        } else {
            list($sortField, $sortType) = $sortData;
        }

        // if the field is in the sortable fields return it
        // else return the default sort
        return in_array($sortField, $sortableFields) ? ["field" => $sortField, "value" => strtoupper($sortType)] : $this->defaultSort();


    }

    /**
     * Limits the query result
     * @param array $data
     * @return array
     */
    protected function limit(array $data) : array  {
        $limitable = [];

        // Normally I would attach the default limit value if no limit is present
        // But for this specific project I dont want to limit if no limit parameter is present
        // Although if someone doesnt attach the offset should always use the default one
        if (!empty($data["limit"]) && is_numeric($data["limit"])) {
            $limitable["limit"] = intval($data["limit"]);
            $limitable["offset"] = !empty($data["offset"]) && is_numeric($data["offset"]) ? intval($data["offset"]) : self::DEFAULT_OFFSET_NUMBER;
        }

        return $limitable;

    }


    /**
     * Returns the default Sorting
     * @return array
     */
    private function defaultSort() : array
    {
        return [
            "field" => self::DEFAULT_SORTING_FIELD,
            "value" => self::DEFAULT_SORTING_TYPE
        ];
    }

}
