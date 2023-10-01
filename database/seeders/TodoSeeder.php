<?

use App\Helpers\MongoModel;

class TodoRepository
{
    private MongoModel $todos;

    public function __construct()
    {
        $this->todos = new MongoModel('todos');
    }

    public function create(array $data)
    {
        $dataSaved = [
            'title' => $data['title'],
            'description' => $data['description'],
            'created_at' => time()
        ];

        $id = $this->todos->save($dataSaved);
        return $id;
    }
}
