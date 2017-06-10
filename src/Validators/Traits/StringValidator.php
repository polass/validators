<?php

namespace Polass\Validators\Traits;

use Illuminate\Support\Str;

trait StringValidator
{
    /**
     * `$parameters` を含むことをバリデート
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @return bool
     */
    public function validateContains($attribute, $value, $parameters)
    {
        $this->requireParameterCount(1, $parameters, 'contains');

        foreach ($parameters as $parameter) {
            if (! Str::contains($value, $parameter)) {
                return false;
            }
        }

        return true;
    }

    /**
     * `$parameters` を含まないことをバリデート
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @return bool
     */
    public function validateNotContains($attribute, $value, $parameters)
    {
        $this->requireParameterCount(1, $parameters, 'not_contains');

        foreach ($parameters as $parameter) {
            if (Str::contains($value, $parameter)) {
                return false;
            }
        }

        return true;
    }

    /**
     * ASCII 文字だけを含むことをバリデート
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @return bool
     */
    public function validateAscii($attribute, $value)
    {
        return 1 === preg_match('/\A[\x20-\x7e\t\n\v\r]*\z/', $value);
    }

    /**
     * ASCII 文字を含まないことをバリデート
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @return bool
     */
    public function validateNotAscii($attribute, $value)
    {
        return 1 !== preg_match('/[\x20-\x7e]/', $value);
    }

    /**
     * `$parameters` のいずれかで始まることをバリデート
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @return bool
     */
    public function validateStartsWith($attribute, $value, $parameters)
    {
        $this->requireParameterCount(1, $parameters, 'starts_with');

        foreach ($parameters as $parameter) {
            if (Str::startsWith($value, $parameter)) {
                return true;
            }
        }

        return false;
    }

    /**
     * `$parameters` のいずれかで始まらないことをバリデート
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @return bool
     */
    public function validateNotStartsWith($attribute, $value, $parameters)
    {
        $this->requireParameterCount(1, $parameters, 'not_starts_with');

        foreach ($parameters as $parameter) {
            if (Str::startsWith($value, $parameter)) {
                return false;
            }
        }

        return true;
    }

    /**
     * `$parameters` のいずれかで終わることをバリデート
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @return bool
     */
    public function validateEndsWith($attribute, $value, $parameters)
    {
        $this->requireParameterCount(1, $parameters, 'ends_with');

        foreach ($parameters as $parameter) {
            if (Str::endsWith($value, $parameter)) {
                return true;
            }
        }

        return false;
    }

    /**
     * `$parameters` のいずれかで終わらないことをバリデート
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @return bool
     */
    public function validateNotEndsWith($attribute, $value, $parameters)
    {
        $this->requireParameterCount(1, $parameters, 'not_ends_with');

        foreach ($parameters as $parameter) {
            if (Str::endsWith($value, $parameter)) {
                return false;
            }
        }

        return true;
    }
}
