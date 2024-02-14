<?php

declare(strict_types=1);

require_once($CFG->dirroot . '/blocks/solver/classes/quadraticEquationSolver.php');

class block_solver extends block_base
{
    public function init(): void
    {
        $this->title = get_string('solver', 'block_solver');
        $this->version = 2004111200;
    }

    public function get_content(): stdClass
    {
        if ($this->content !== null) {
            return $this->content;
        }

        global $DB;

        $this->content = new stdClass();
        $this->content->text = '';

        if ($data = $this->get_data()) {
            if (!is_numeric($data->a) || !is_numeric($data->b) || !is_numeric($data->c)) {
                $this->content->text .= "Все поля должны быть заполнены числовыми значениями";
            } else {
                $solver = new QuadraticEquationSolver();
                $this->content->text .= $solver->solveQuadraticEquation((int)$data->a, (int)$data->b, (int)$data->c);
            }
        }

        $this->content->text .= '<form id="quadratic-form" action="" method="POST">
                <label for="a">Введите коэффициент a:</label>
                <input type="number" name="a" id="a"><br>
                <label for="b">Введите коэффициент b:</label>
                <input type="number" name="b" id="b"><br>
                <label for="c">Введите коэффициент c:</label>
                <input type="number" name="c" id="c"><br>
                <input type="submit" value="Рассчитать корни уравнения">
            </form>';

        $this->content->text .= '<a href="/blocks/solver/hystory.php">История</a>';

        return $this->content;
    }

    public function get_data(): bool|object
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return (object)$_POST;
        }
        return false;
    }
}