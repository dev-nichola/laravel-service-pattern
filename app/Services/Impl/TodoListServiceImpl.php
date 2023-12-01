<?php

namespace App\Services\Impl;
use App\Services\TodoListService;
use Illuminate\Support\Facades\Session;

class TodoListServiceImpl implements TodoListService
{
    public function saveTodo(string $id, string $todo) : void
    {
        if(!Session::exists("todolist"))
        {
            Session::put("todolist", []);
        }

        Session::push('todolist', [
            "id" => $id,
            "todo" => $todo
        ]);
    }

    public function getTodolist() :array
    {
    return Session::get("todolist", []);
    }

    public function removeTodolist(string $todoId)
    {
        $todolist = Session::get('todolist');

        foreach ($todolist as $index => $item)
        {
            if($item['id'] == $todoId)
            {
                unset($todolist[$index]);
                break;
            }
        }

        Session::put("todolist", $todolist);
    }
}
