<?php

use Carbon\Carbon;

function diffForHumanCreatedAt($value){
    return Carbon::parse($value)->diffForHumans();
}

function diffForHumanUpdatedAt($value){
    return Carbon::parse($value)->diffForHumans();
}