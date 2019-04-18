<?php

function listErrors($array)
{
    $last  = array_slice($array, -1);
    $first = join(', ', array_slice($array, 0, -1));
    $both  = array_filter(array_merge(array($first), $last), 'strlen');
    return ucfirst(str_replace('.', '', strtolower(join(' and ', $both))));
}
