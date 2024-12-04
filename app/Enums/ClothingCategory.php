<?php

namespace App\Enums;

enum ClothingCategory: int
{
    case OTHERS = 0; // Autres
    case TROUSERS_AND_LEGGINGS = 1; // Pantalons et leggings
    case SHORTS = 2; // Shorts
    case TOPS_AND_T_SHIRTS = 3; // Hauts et t-shirts
    case SWEATSHIRTS_AND_JUMPERS = 4; // Sweats et pulls
    case SOCKS = 5; // Chaussettes
    case UNDERWEAR = 6; // Culottes/Caleçons
    case BRAS = 7; // Soutiens-gorge
    case PYJAMAS = 8; // Pyjamas
    case SUITS_AND_BLAZERS = 9; // Costumes et blazers
    case SPORTSWEAR = 10; // Vêtements de sport
}
