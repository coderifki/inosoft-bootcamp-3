<?php

namespace App\Repositories;

use App\Models\Todo;

class TodoListRepository
{
    protected $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    /**
     * Untuk mengambil semua todo
     */
    public function all(): Object
    {
        return $this->todo->get([]);
    }

    /**
     * Untuk mendapatkan todo bedasarkan id
     *  */
    public function getById(string $id)
    {
        $todo = $this->todo->find(['_id' => $id]);
        return $todo;
    }

    /**
     * Untuk membuat todo
     */
    // public function store($data): Object
    // {
    //     $newData = new $this->todo;
    //     $newData->title =   $data['title'];

    //     $newData->save();

    //     return $newData->fresh();
    // }

    public function store($data): Object
    {
        $newData = new $this->todo;
        $newData->title = $data['title'];
        $newData->description = $data['description'] ?? null; // Pastikan description diatur atau null jika tidak ada
        $newData->created_at = now(); // Gunakan fungsi now() untuk mendapatkan timestamp saat ini
        $newData->save();

        return $newData->fresh(); // Gunakan fresh() untuk mendapatkan entitas yang baru diperbarui dari database
    }


    /**
     * Untuk update todo
     */
    public function update($id, $todo)
    {
        $todo = Todo::find($id);
        $todo->update($todo);
        return $todo;
    }

    /**
     * Delete Data 
     *  */
    public function delete(string $id)
    {
        $existTodo = $this->todo->find(['_id' => $id]);

        if (!$existTodo) {
            return false;
        }

        $this->todo->deleteQuery(['_id' => $id]);
        return true;
    }
}
