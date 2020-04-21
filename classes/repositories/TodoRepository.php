<?php
namespace MyApp\classes\repositories;

use MyApp\classes\DB;
use MyApp\classes\Todo;
use MyApp\classes\User;

class TodoRepository implements TodoRepositoryInterface
{

    private $db;

    public function __construct()
    {
        $this->db =  DB::getConnection();
    }

    public function getUserTodos(User $user, $parentTodoId = 0) :array
    {

        $user_id = intval($user->id);
        $parentTodoId = intval($parentTodoId);
        $query = "SELECT * FROM `todo` WHERE `user_id` = $user_id AND `parent_id` = $parentTodoId ORDER BY date ASC";
        $db_result = $this->db->query($query);
        $todos = [];
        while ($obj = $db_result->fetch_object()) {
            $todos[] = $obj;
        }
        return $todos;

    }

    public function getById(int $id): Todo
    {
        $db = DB::getConnection();
        $id=intval($id);

        $query = "SELECT * FROM `todo` WHERE `id` = '$id' LIMIT 1";
        $db_result = $db->query($query);
        if(!$db_result->num_rows){
            throw new \RuntimeException('Todo not found.');

        }
        $rowTodo = $db_result->fetch_object();

        return new Todo($rowTodo->user_id, $rowTodo->parent_id, $rowTodo->title, $rowTodo->text, substr($rowTodo->date, 0, -3), $rowTodo->id, $rowTodo->is_done);
    }

    public function save(Todo $todo) : void
    {
        $db = DB::getConnection();
        $title=$db->real_escape_string($todo->title);
        $text=$db->real_escape_string($todo->text);
        $date=$db->real_escape_string($todo->date);
        $is_done=$db->real_escape_string($todo->is_done);
        $date = $date . ':00';
        $id=intval($todo->id);

        $query="UPDATE `todo` SET title = '$title', text = '$text', date = '$date', is_done = $is_done WHERE id = '$id'";
        if(!$db->query($query)){
            throw new \RuntimeException($db->error);
        }

    }

    public function add(Todo $todo) : void
    {
        $db = DB::getConnection();
        $title=$db->real_escape_string($todo->title);
        $text=$db->real_escape_string($todo->text);
        $date=$db->real_escape_string($todo->date);
        $date = $date . ':00';
        $user_id=intval($todo->user_id);
        $parent_id=intval($todo->parent_id);

        $query="INSERT INTO `todo` (title, text, date, user_id, parent_id) VALUES ('$title','$text', '$date', '$user_id', '$parent_id')";
        if(!$db->query($query)){
            throw new \RuntimeException($db->error);
        }
    }


    public function delete(int $id) : void
    {
        $db = DB::getConnection();
        $id=intval($id);
        $query="DELETE FROM `todo` WHERE id = $id";
        if(!$db->query($query)){
            throw new \RuntimeException($db->error);
        }

    }

    public static function deleteTodoChildren(int $parentId) :void
    {
        $db = DB::getConnection();
        $parentId=intval($parentId);
        $query="DELETE FROM `todo` WHERE parent_id = $parentId";
        if(!$db->query($query)){
            throw new \RuntimeException($db->error);
        }

    }

    public static function countTodos(int $parentId) :array
    {
        $db = DB::getConnection();
        $parentId=intval($parentId);
        $query="SELECT
                    COUNT(CASE WHEN parent_id = $parentId AND is_done = 1 THEN 1 END) AS count_done_todos,
                    COUNT(CASE WHEN parent_id = $parentId THEN 1 END) AS count_all_todos
                FROM `todo`";

        if(!$db_result = $db->query($query)){
            throw new \RuntimeException($db->error);
        }
        return $db_result->fetch_array(MYSQLI_ASSOC);


    }

    public static function makeDoneTodoChildren(int $parentId) :void
    {
        $db = DB::getConnection();
        $parentId=intval($parentId);
        $query="UPDATE `todo` SET is_done = 1 WHERE parent_id = '$parentId'";
        if(!$db->query($query)){
            throw new \RuntimeException($db->error);
        }

    }

    public static function makeDoneTodoParent(int $id) :void
    {
        $db = DB::getConnection();
        $id=intval($id);
        $query="UPDATE `todo` SET is_done = 1 WHERE id = '$id'";
        if(!$db->query($query)){
            throw new \RuntimeException($db->error);
        }


    }
}