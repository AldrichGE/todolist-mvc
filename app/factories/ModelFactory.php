<?php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Task.php';

class ModelFactory
{
    public static function make($model)
    {
        return match($model) {

            'User' => new User(),

            'Task' => new Task(),

            default => throw new Exception(
                "Model {$model} não encontrado"
            )
        };
    }
}