<?php

namespace App\Enum;

enum UserRole: string
{
  case ADMINISTRADOR = 'Administrador';
  case LLANTERO = 'llantero';
  case TRABAJADOR = 'trabajador';
}
