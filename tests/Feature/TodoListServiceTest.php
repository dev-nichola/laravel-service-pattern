<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\TodoListService;
use Illuminate\Support\Facades\Session;
use function PHPUnit\Framework\assertEquals;

use Illuminate\Foundation\Testing\WithFaker;
use function PHPUnit\Framework\assertNotNull;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoListServiceTest extends TestCase
{

    private TodoListService $todoListService;
    public function setUp() : void
    {
        parent::setUp();

        $this->todoListService = $this->app->make(TodoListService::class);
    }

public function testTodoListNotNull()
{
    assertNotNull(TodoListService::class);
}

public function testSaveTodo()
{
    $this->todoListService->saveTodo("1", "Nichola");
   $todolist = Session::get("todolist");
    foreach($todolist as $todo)
    {
        assertEquals("1", $todo['id']);
        assertEquals("Nichola", $todo['todo']);
    }
}

public function testGetTodolistEmpty()
{
    self::assertEquals([],$this->todoListService->getTodolist());
}

public function testGetTodolistFound()
{
    $expected = [
        [
        "id" => "1",
        "todo" => "Nichola"
    ]
];

    $this->todoListService->saveTodo("1", "Nichola");


    self::assertEquals($expected, $this->todoListService->getTodolist());
}

public function testRemoveTodo()
{
    $this->todoListService->saveTodo("1", "Eko");
    $this->todoListService->saveTodo("2", "Kurniawan");

    self::assertEquals(2, sizeof($this->todoListService->getTodolist()));

    $this->todoListService->removeTodolist("3");

    self::assertEquals(2, sizeof($this->todoListService->getTodolist()));

    $this->todoListService->removeTodolist("1");

    self::assertEquals(1, sizeof($this->todoListService->getTodolist()));

    $this->todoListService->removeTodolist("2");

    self::assertEquals(0, sizeof($this->todoListService->getTodolist()));
}
}
