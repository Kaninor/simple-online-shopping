<?php

function postParams($value, $array)
{
    return array_key_exists($value, $array) ? $array[$value] : null;
}

function encoding($value)
{
    return base64_encode(base64_encode($value));
}