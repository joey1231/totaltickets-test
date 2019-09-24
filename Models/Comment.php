<?php

include_once __DIR__ . '/BaseModel.php';
include_once __DIR__ . '/User.php';
class Comment extends BaseModel
{
    public $user_id, $post_id, $body, $id, $created_at;
    public $table = 'comments';
    public function save()
    {
        if ($this->id <= 0) {
            $stmt = $this->db->prepare("INSERT INTO $this->table(user_id,post_id, body, created_at) values(?, ?, ?, ?) ");
            $stmt->bind_param('iiss', $this->user_id, $this->post_id, $this->body, $this->created_at);
            $stmt->execute();
            $result = $stmt->affected_rows;
            $this->id = $this->db->insert_id;

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

    public function wherePostId($value)
    {
        $this->stmt = $this->db->prepare("SELECT * FROM $this->table  where post_id = ? ");
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
        $this->stmt->bind_result($id, $user_id, $post_id, $body, $created_at);

        $comments = [];

        while ($this->stmt->fetch()) {
            $comment = new Comment;
            $comment->user_id = $user_id;
            $comment->post_id = $post_id;
            $comment->body = $body;
            $comment->created_at = $created_at;
            $comment->id = $id;
            $comments[] = $comment;
        }

        return $comments;

    }
    public function first()
    {
        $this->stmt->execute();
        $this->stmt->store_result();

        if ($this->stmt->num_rows > 0) {
            $this->stmt->bind_result($id, $user_id, $post_id, $body, $created_at);
            $this->stmt->fetch();
            $comment = new Comment;
            $post->user_id = $user_id;
            $comment->post_id = $post_id;
            $comment->body = $body;
            $comment->created_at = $created_at;
            $comment->id = $id;

            $this->stmt->close();
            $this->db->close();
            //return;
            return $comment;
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

    public function user()
    {
        return (new User())->whereId($this->user_id)->first();
    }
}
