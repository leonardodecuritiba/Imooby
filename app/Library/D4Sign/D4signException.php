<?php

namespace App\Library\D4Sign;

class D4signException extends \Exception
{
    const CLASS_NOT_FOUND = 1;
    const INVALID_HTTP_CODE = 2;
    const INVALID_RESULT = 3;
}
