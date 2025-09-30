<?php

namespace App\Enums;

enum BookType: string
{
    case GRAPHIC = 'graphic'; //Графическое издание
    case DIGITAL = 'digital'; //Цифровое издание
    case PRINTED = 'print'; // Печатное издание

    public function label(): string
    {
        return match($this) {
            self::GRAPHIC => 'Графическое издание',
            self::DIGITAL => 'Цифровое издание',
            self::PRINTED => 'Печатное издание',
        };
    }
}
