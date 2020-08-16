<?php
/**
 * Created by PhpStorm.
 * User: Sin
 * Date: 23/5/2020
 * Time: 7:49 μμ
 */

namespace App\Utility;


class Constants
{
    public const CONSTANT_MESSAGES = [
        "ONE_VALUE_MUST_CHANGE" => "At least one value must change"
    ];

    /**
     * All available filters someone can use
     * We have the "?" as a placeholder for the prepared Object
     * We gonna replace it with the value directly at the sql query
     * So we wont have an SQL Injection Vulnerability
     */
    public const AVAILABLE_FILTERS = [
        'gte' => '>= ?',
        'gt' => '> ?',
        'eq' => '= ?',
        'lte' => '<= ?',
        'lt' => '< ?',
        'like' => 'LIKE ?',
    ];


}
