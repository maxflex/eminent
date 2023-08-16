<?php

function extract_fields($object, $fields, $merge = [])
{
    $return = ['id' => $object->id];
    foreach ($fields as $field) {
        if ($field === '*') {
            foreach ($object->resource->toArray() as $key => $value) {
                $return[$key] = $value;
            }
        } else {
            $return[$field] = $object->{$field};
        }
    }
    return array_merge($return, $merge);
}
