<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidDocument implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /* VALIDACIÓN SIMPLE DE CÉDULA ECUATORIANA        */

        if (!ctype_digit($value)) {
            $fail('El documento debe contener solo números.');
            return;
        }

        if (strlen($value) != 10) {
            $fail('El documento debe tener 10 dígitos.');
            return;
        }

        $provincia = intval(substr($value, 0, 2));

        if ($provincia < 1 || $provincia > 24) {
            $fail('La provincia del documento no es válida.');
            return;
        }

        $tercerDigito = intval($value[2]);

        if ($tercerDigito >= 6) {
            $fail('El documento no es válido.');
            return;
        }

        $coeficientes = [2,1,2,1,2,1,2,1,2];

        $suma = 0;

        for ($i = 0; $i < 9; $i++) {

            $resultado = intval($value[$i]) * $coeficientes[$i];

            if ($resultado >= 10) {
                $resultado -= 9;
            }

            $suma += $resultado;
        }

        $verificador = (10 - ($suma % 10)) % 10;

        if ($verificador != intval($value[9])) {
            $fail('El número de documento no es válido.');
        }
    }
}
