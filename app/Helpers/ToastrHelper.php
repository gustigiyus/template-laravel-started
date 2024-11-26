<?php

namespace App\Helpers;

use Brian2694\Toastr\Facades\Toastr;

class ToastrHelper
{
    public static function successMessage($message)
    {
        Toastr::success($message, 'Success', [
            "closeButton" => true,
            "positionClass" => "toast-top-right",
            "progressBar" => true
        ]);
    }

    public static function errorMessage($message)
    {
        Toastr::error($message, 'Error', [
            "closeButton" => true,
            "positionClass" => "toast-top-right",
            "progressBar" => true
        ]);
    }
}
