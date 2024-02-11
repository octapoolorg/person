<?php

namespace App\Enums;

enum Gender: int
{
    case FEMININE = 1;
    case MASCULINE = 2;
    case UNISEX = 3;
    case UNKNOWN = 4;
}