<?php
include_once __DIR__ . '/Comment.php';
class Post extends BaseModel
{
    public $title, $body, $id, $created_at, $user_id;
    public $table = 'posts';
    public function save()
    {

        if ($this->id <= 0) {

            $stmt = $this->db->prepare("INSERT INTO $this->table(title, body, created_at, user_id) values(?, ?, ?,?) ");
            $stmt->bind_param('sssi', $this->title, $this->body, $this->created_at, $this->user_id);
            $stmt->execute();
            $result = $stmt->affected_rows;
            $this->id = $this->db->insert_id;
            echo $stmt->error;
            exit;
            $stmt->close();
            $this->db->close();
            return $result;
        } else {
            return self::update();
        }

    }

    public function whereId($value, $condition = '=')
    {
        $this->stmt = $this->db->prepare("SELECT * FROM $this->table where id = ? ");
        $this->stmt->bind_param('i', $value);
        return $this;
    }
    public function whereUserId($value)
    {
        $this->stmt = $this->db->prepare("SELECT * FROM $this->table  where user_id = ? ");
        $this->stmt->bind_param('i', $value);
        return $this;
    }
    public function get($flag = false)
    {
        if ($flag) {
            $this->stmt = $this->db->prepare("SELECT * FROM $this->table");
        }

        $this->stmt->execute();
        $this->stmt->bind_result($id, $title, $body, $created_at, $user_id);
        $posts = [];
        /* fetch values */
        while ($this->stmt->fetch()) {
            $post = new Post;
            $post->title = $title;
            $post->body = $body;
            $post->created_at = $created_at;
            $post->id = $id;
            $post->user_id = $user_id;
            $posts[] = $post;
        }
        $this->stmt->close();
        $this->db->close();
        return $posts;

    }
    public function first()
    {
        $this->stmt->execute();
        $this->stmt->store_result();

        if ($this->stmt->num_rows > 0) {
            $this->stmt->bind_result($id, $title, $body, $created_at, $user_id);
            $this->stmt->fetch();
            $post = new Post;
            $post->title = $title;
            $post->body = $body;
            $post->created_at = $created_at;
            $post->id = $id;
            $post->user_id = $user_id;
            $this->stmt->close();
            $this->db->close();
            //return;
            return $post;
        }

        $this->stmt->close();
        $this->db->close();
        return null;
    }

    private function update()
    {
        $this->stmt = $this->db->prepare("UPDATE $this->table title = ?, body = ? where id = ?");
        $this->stmt->bind_param('ssi', $this->title, $this->body, $this->id);
        $this->stmt->execute();
        $result = $stmt->affected_rows;
        $this->stmt->close();
        $this->db->close();
        return $result;
    }

    public function comments()
    {
        return (new Comment())->wherePostId($this->id)->get();
    }
}
