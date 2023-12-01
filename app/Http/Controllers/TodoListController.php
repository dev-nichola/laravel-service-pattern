<?php

namespace App\Http\Controllers;

use App\Services\TodoListService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TodoListController extends Controller
{

    private TodoListService $todoListService;

    public function __construct(TodoListService $todoListService)
    {
        $this->todoListService = $todoListService;
    }

    public function todoList(Request $request) : View
    {
        $todolist = $this->todoListService->getTodolist();

        return view('todolist', [
            'title' => 'TodoList',
            'todolist' => $todolist
        ]);
    }

    public function addTodo(Request $request)
    {
        $todo = $request->input('todo');

        if(empty($todo))
        {
            $todolist = $this->todoListService->getTodolist();

            return response()->view('todolist', [
                "title" => 'TodoList',
                'todolist' => $todolist,
                'error' => 'Todo is required',
            ]);
        }

        $this->todoListService->saveTodo(uniqid(), $todo);

        return redirect()->action([TodoListController::class, 'todoList']);

    }

    public function removeTodo(Request $request, string $todoId)
    {
        $this->todoListService->removeTodolist($todoId);

        return redirect()->action([TodoListController::class, 'todoList']);
    }
}
