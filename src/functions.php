<?php
function cleanInput(array $data) : array
{
    foreach ($data as $key => $value) {
        $data[$key]=trim($data[$key]);
    }
    return $data;
}