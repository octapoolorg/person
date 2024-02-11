<?php

namespace App\Enums;

enum Gender: int
{
    case MASCULINE = 2;
    case FEMININE = 1;
    case UNISEX = 3;
    case UNKNOWN = 4;
}