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
    /**
     * Return an array with "normalized" filter data
     * @param array $data
     * @param array $filterableCols
     * @param array $availableFilters
     * @return array
     */
    protected function normalizeFilters(array $data, array $filterableCols, array $availableFilters): array
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
                    $normalized[]=[
                        "field" => $field,
                        "query" => $availableFilters[$opValue[0]],
                        "value" => $opValue[1]
                    ];
                }
            }
        }
        return $normalized;
    }
}
