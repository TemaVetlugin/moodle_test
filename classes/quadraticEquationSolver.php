<?php

declare(strict_types=1);

class QuadraticEquationSolver
{
    public function solveQuadraticEquation(int $a, int $b, int $c): string
    {
        global $DB;

        // Проверка на числовые значения
        if (!is_numeric($a) || !is_numeric($b) || !is_numeric($c)) {
            return "Все поля должны быть заполнены числовыми значениями";
        }

        // Проверка на диапазон значений
        if ($a > 9999 || $b > 9999 || $c > 9999 || $a < -9999 || $b < -9999 || $c < -9999) {
            return "Значения должны быть в диапазоне от -9999 до 9999";
        }

        // Проверка на квадратное уравнение
        if ($a === 0) {
            return "Данное уравнение не является квадратным";
        }

        $record = new stdClass();
        $record->a = (float) $a;
        $record->b = (float) $b;
        $record->c = (float) $c;

        // Решение квадратного уравнения
        $discriminant = $b * $b - 4 * $a * $c;
        if ($discriminant > 0) {
            $x1 = (-$b + sqrt($discriminant)) / (2 * $a);
            $x2 = (-$b - sqrt($discriminant)) / (2 * $a);
            $record->x1 = (float) $x1;
            $record->x2 = (float) $x2;
            $DB->insert_record('block_solver', $record);
            return "Корни уравнения: x1 = $x1, x2 = $x2";
        } elseif ($discriminant === 0) {
            $x = -$b / (2 * $a);
            $record->x1 = (float) $x;
            $DB->insert_record('block_solver', $record);
            return "Уравнение имеет один корень: x = $x";
        } else {
            $DB->insert_record('block_solver', $record);
            return "Уравнение не имеет корней";
        }
    }
}