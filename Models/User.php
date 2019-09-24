<?php
include_once __DIR__ . '/BaseModel.php';

class User extends BaseModel
{
    public $name, $email, $password, $id;

    public function save()
    {
        if (is_null($this->id)) {
            $stmt = $this->db->prepare("INSERT INTO users(name, email, password) values(?, ?, ?) ");
            $stmt->bind_param('sss', $this->name, $this->email, $this->password);
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

    public function getName()
    {
        return $this->name;
    }

    public function whereId($value)
    {
        $this->stmt = $this->db->prepare("SELECT * FROM users where id = ? ");
        $this->stmt->bind_param('i', $value);
        return $this;
    }

    public function first()
    {
        $this->stmt->execute();
        $this->stmt->store_result();

        if ($this->stmt->num_rows > 0) {
            $this->stmt->bind_result($id, $name, $email, $password);
            $this->stmt->fetch();
            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = $password;
            $user->id = $id;

            $this->stmt->close();
            $this->db->close();
            //return;
            return $user;
        }

        $this->stmt->close();
        $this->db->close();
        return null;
    }

    private function update()
    {
        $this->stmt = $this->db->prepare("UPDATE users set name = ?, email = ?, password= ? where id = ?");
        $this->stmt->bind_param('sssi', $this->name, $this->email, $this->password, $this->id);
        $this->stmt->execute();
        $result = $this->stmt->affected_rows;
        $this->stmt->close();
        $this->db->close();
        return $result;
    }

    public function whereEmailPassword($email, $password)
    {
        $this->stmt = $this->db->prepare("SELECT * FROM users where email = ?  AND password = ?");
        $this->stmt->bind_param('ss', $email, $password);
        return $this;
    }
}
