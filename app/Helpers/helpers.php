<?php 


function custom_asset($path)
{
    return env('TYPE_URL') == 'http' ? asset($path) : secure_asset($path);
}