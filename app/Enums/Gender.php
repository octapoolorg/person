<?php

namespace App\Enums;

enum Gender: int
{
    case MASCULINE = 1;
    case FEMININE  = 2;
    case UNISEX    = 3;
    case UNKNOWN   = 4;
}