<?php

namespace Polass\Validators;

use Illuminate\Validation\Validator as IlluminateValidator;
use Polass\Validators\Traits\StringValidator;

class Validator extends IlluminateValidator
{
    use StringValidator;
}
