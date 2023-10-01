<?php

namespace App\Services;

use App\Repositories\TodoListRepository;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast\Object_;

class TodoListService
{
    protected $todolistRepository;

    public function __construct(TodoListRepository $todolistRepository)
    {
        $this->todolistRepository = $todolistRepository;
    }

    public function getAll()
    {
        return $this->todolistRepository->all();
    }

    public function getOne($id)
    {
        return $this->todolistRepository->getById($id);
    }

    public function store($data): Object
    {
        $validator = Validator::make($data, [
            'title' => 'required',
            'description' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        return $this->todolistRepository->store($data);
    }

    public function update($id, $data)
    {
        return $this->todolistRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->todolistRepository->delete($id);
    }
}
