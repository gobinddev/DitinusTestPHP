<?php

use App\Models\HieraricalData;

if (!function_exists('returnResponse')) {

    function returnResponse($status = true, $message = '--',  $response = [])
    {

        return response()->json([
            'status' => $status,
            'message' => $message,
            'response' => $response,
        ], 200);
    }
}




if (!function_exists('showHieraricalList')) {

    function showHieraricalList($parent_id = null)
    {
        $records = HieraricalData::where('parent_id', $parent_id)->get();
        if (count($records) !== 0) {
            echo '<ul>';
            foreach ($records as $record) {
                echo '<li style="list-style: disc;">'.$record->name;
                showHieraricalList($record->id); 
                echo '</li>';
            }
            echo '</ul>';
        }
    }
}
