<?php

namespace App\Services;


interface TodoListService
{
    public function saveTodo(string $id, string $todo) : void;

    public function getTodolist() : array;

    public function removeTodolist(string $todoId);
}

