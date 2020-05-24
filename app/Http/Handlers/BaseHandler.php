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
                    // we will have an array containing the value as a key and the sql for filter as value
                    // ex : ["10"] => " id >= ? "
                    // We could populate the whole sql query here and return a string but I find this easier to debug
                    $normalized[$opValue[1]] = $field . ' ' . $availableFilters[$opValue[0]];
                }
            }
        }
        return $normalized;
    }
}
