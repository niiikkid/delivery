<?php
if (! function_exists('make')) {
    /**
     * @template T
     * @param T $abstract
     * @return T
     */
    function make($abstract, array $parameters = [])
    {
        return app()->make($abstract, $parameters);
    }
}

if (! function_exists('is_production')) {
    function is_production(): bool
    {
        return app()->environment('production');
    }
}

if (! function_exists('array_filter_recursive')) {
    function array_filter_recursive($input, $callback = null)
    {
        foreach ($input as &$value) {
            if (is_array($value)) {
                $value = array_filter_recursive($value, $callback);
            }
        }

        return array_filter($input, $callback);
    }
}
