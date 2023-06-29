<?php

use Illuminate\Support\Arr;

if (!function_exists('getFillableAttribute')) {

    /**
     * Convert Array into Object in deep
     *
     * @param string $model
     * @param array $data
     * @return array
     */
    function getFillableAttribute(string $model, array $data): array
    {
        $fillable = (new $model)->getFillable();

        return Arr::only($data, Arr::flatten($fillable));
    }
}

if (!function_exists('setDefaultRequest')) {
    /**
     * Set Default Value for Request Input.
     *
     * @param string|array $name
     * @param null $value
     * @param bool $force
     */
    function setDefaultRequest(string|array $name, mixed $value = null, bool $force = true): void
    {
        try {
            $request = app('request');

            if (is_array($name)) {
                $data = $name;
            } else {
                $data = [$name => $value];
            }

            if ($force) {
                $request->merge($data);
            } else {
                $request->mergeIfMissing($data);
            }
            $request->session()->flashInput($data);
        } catch (Exception) {
        }
    }
}

if (!function_exists('routed')) {
    /**
     * Existing Route by Name
     * with '#' fallback.
     *
     * @param string $name
     * @param array $parameters
     * @param bool $absolute
     * @return string
     */
    function routed(string $name, array $parameters = [], bool $absolute = true): string
    {
        if (app('router')->has($name)) {
            return app('url')->route($name, $parameters, $absolute);
        }

        return '#';
    }
}
