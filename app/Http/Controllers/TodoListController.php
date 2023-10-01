<?php

namespace App\Http\Controllers;

use App\Services\TodoListService;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    protected  $todoService;

    public function __construct(TodoListService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function getTodoList()
    {
        return $this->todoService->getAll();
    }

    public function show($id)
    {
        return $this->todoService->getOne($id);
    }

    public function store(Request $request)
    {
        return $this->todoService->store($request->all());
    }

    public function update(Request $request, $id)
    {
        return $this->todoService->update($id, $request->all());
    }

    public function destroy($id)
    {
        return $this->todoService->delete($id);
    }
}
