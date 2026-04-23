<?php

class Uuid
{

    public static function generateV4() 
    {
        $data = random_bytes(16);

        // Configuramos la versión 4 (el bit 4 en el byte 6)
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        
        // Configuramos la variante (bits 6 y 7 en el byte 8)
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        // Retornamos la representación en formato string (ej: 550e8400-e29b-41d4-a716-446655440000)
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}