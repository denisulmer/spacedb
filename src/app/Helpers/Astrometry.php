<?php

function formatDegrees($value)
{
    return number_format($value, 3) . '&deg';
}

function formatPixelScale($value)
{
    return number_format($value, 4) . '"/px';
}