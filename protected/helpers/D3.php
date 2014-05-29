<?php

class D3
{
    public static function formGraphData ($data)
    {
        $output = [
            'name' => 'twitter',
            'children' => [],
        ];
        foreach ($data as $key => $value) {
            $output['children'][] = ['name' => (string)$key, 'size' => (string)$value];
        }
        return json_encode($output);
    }

    public static function formCloudData ($data)
    {
        if(!count($data)) return '';

        $maxSize = max($data);

        $output = [];
        foreach ($data as $key => $value) {
            $output[] = [(string)$key, (string)$value];
        }
        // return "[['foo', 12], ['bar', 6]]";
        return json_encode($output);
    }
}