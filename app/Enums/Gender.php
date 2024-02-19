<?php

namespace App\Enums;

enum Gender: string
{
    case MASCULINE = 'masculine';
    case FEMININE  = 'feminine';
    case UNISEX    = 'unisex';
    case UNKNOWN   = 'unknown';
}