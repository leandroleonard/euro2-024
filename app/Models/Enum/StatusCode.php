<?php

namespace App\Models\Enum;

enum StatusCode: int  {
    case OK             = 200;
    case CREATED        = 201;
    case NO_CONTENT     = 204;
    case NOT_FOUND      = 404;
    case SERVER_ERROR   = 500;
    case BAD_REQUEST    = 400;
}