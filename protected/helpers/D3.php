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
        if(!is_array($data)) $data = [];

        $maxSize = max($data);

        $output = [];
        foreach ($data as $key => $value) {
            $output[] = [(string)$key, (string)$value];
        }

        return json_encode($output);
    }
}