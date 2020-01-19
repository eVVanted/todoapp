<?php
class Todo {

    private function __construct() {
    }
    private function __clone() {}

    public static function getTodos($user_id) {
        $db = DB::getConnection();
        $id=intval($user_id);

        $query = "SELECT * FROM `todo` WHERE `user_id` = '$user_id' AND `parent_id` = 0 ORDER BY date ASC";
        $db_result = $db->query($query);
        if($db_result){
            return $db_result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    public static function getTodoById($id) {
        $db = DB::getConnection();
        $id=intval($id);

        $query = "SELECT * FROM `todo` WHERE `id` = '$id'";
        $db_result = $db->query($query);
        if($db_result){
            return $db_result->fetch_array(MYSQLI_ASSOC);
        }
        return false;
    }

    public static function getSubTodos($id, $parent_id) {
        $db = DB::getConnection();
        $id=intval($id);
        $parent_id=intval($parent_id);

        $query = "SELECT * FROM `todo` WHERE `user_id` = '$id' AND `parent_id` = $parent_id ORDER BY date ASC";
        $db_result = $db->query($query);
        if($db_result){
            return $db_result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }

    public static function addTodo($title, $text, $datetime, $user_id, $parent_id = 0){
        $db = DB::getConnection();
        $title=$db->real_escape_string($title);
        $text=$db->real_escape_string($text);
        $datetime=$db->real_escape_string($datetime);
        $datetime = $datetime . ':00';
        $user_id=intval($user_id);
        $parent_id=intval($parent_id);


        $query="INSERT INTO `todo` (title, text, date, user_id, parent_id) VALUES ('$title','$text', '$datetime', '$user_id', '$parent_id')";
        if ($db->query($query) === TRUE) {
            $result['error'] = false;
            $result['message'] = '';
        } else {
            $result['error'] = true;
            $result['message'] = $db->error;
        }
        return $result;
    }

    public static function updateTodo($id, $title, $text, $datetime){
        $db = DB::getConnection();
        $title=$db->real_escape_string($title);
        $text=$db->real_escape_string($text);
        $datetime=$db->real_escape_string($datetime);
        $datetime = $datetime . ':00';
        $id=intval($id);

        $query="UPDATE `todo` SET title = '$title', text = '$text', date = '$datetime' WHERE id = '$id'";
        if ($db->query($query) === TRUE) {
            $result['error'] = false;
            $result['message'] = '';
        } else {
            $result['error'] = true;
            $result['message'] = $db->error;
        }
        return $result;
    }

    public static function delete($id){

        $db = DB::getConnection();
        $id=intval($id);
        $query="DELETE FROM `todo` WHERE id = '$id' OR parent_id = '$id'";
        if ($db->query($query) === TRUE) {
            $result['error'] = false;
            $result['message'] = '';
        } else {
            $result['error'] = true;
            $result['message'] = $db->error;
        }
        return $result;

    }

    public static function done($id){
//        var_dump($id);
        $db = DB::getConnection();
        $id=intval($id);
        $query="UPDATE `todo` SET done = 1 WHERE id = '$id' OR parent_id = '$id'";
        if ($db->query($query) === TRUE) {
            $result['error'] = false;
            $result['message'] = '';
            $query2="SELECT * FROM `todo` WHERE id = '$id'";
            $db_result2 = $db->query($query2);
            $done_task = $db_result2->fetch_array(MYSQLI_ASSOC);
            if($done_task['parent_id']){
                $query3="SELECT COUNT(*) as count FROM `todo` WHERE parent_id = '".$done_task['parent_id']."'";
                $db_result3 = $db->query($query3);
                $all_tasks = $db_result3->fetch_array(MYSQLI_ASSOC)['count'];
                $query4="SELECT COUNT(*) as count FROM `todo` WHERE parent_id = '".$done_task['parent_id']."' AND done = 1";
                $db_result4 = $db->query($query4);
                $all_tasks_done = $db_result4->fetch_array(MYSQLI_ASSOC)['count'];
                if($all_tasks === $all_tasks_done){
                    $query5="UPDATE `todo` SET done = 1 WHERE id = '".$done_task['parent_id']."'";
                    if ($db->query($query5) === TRUE) {
                        $result['error'] = false;
                        $result['message'] = '';
                    } else {
                        $result['error'] = true;
                        $result['message'] = $db->error;
                    }
                }
            }

        } else {
            $result['error'] = true;
            $result['message'] = $db->error;
        }

        return $result;

    }

}