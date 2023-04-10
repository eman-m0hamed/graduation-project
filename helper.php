<?php

use Illuminate\Support\Facades\Auth;

function doctor(){
    return Auth::guard('doctor')->user();
}

