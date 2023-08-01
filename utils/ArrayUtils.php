<?php

class ArrayUtils
{

    static public function interArray($array1, $array2)
    {
        return array_intersect_key($array1, $array2);
    }

    static public function diffArray($array1, $array2)
    {

        foreach ($array2 as $key => $value) {
            if (!array_key_exists($key, $array1)) {
                $result[] = $value;
            }
        };
        return self::makeIdArray($result, 'idAnime');
    }

    static public function makeIdArray($array, $id)
    {
        foreach ($array as $item) {
            foreach ($item as $key => $value) {
                if ($key === $id) {
                    $result[$value] = $item;
                }
            }
        }
        return $result;
    }

    public static function makeIdArrayObject($array, $id)
    {
        $result =  [];
        foreach ($array as $item) {
            $result[$item->$id] = $item;
        }
        return $result;
    }
}
