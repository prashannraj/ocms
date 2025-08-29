<?php

use Illuminate\Support\ViewErrorBag;

if (!function_exists('isError')) {
    function isError($errors, $field, $message = null)
    {
        if ($errors instanceof ViewErrorBag && $errors->has($field)) {
            $msg = $errors->first($field);
            return '<span class="text-danger">' . ($message ?? $msg) . '</span>';
        }

        return '';
    }
}
