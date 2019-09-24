<?php

class BaseModel
{
    protected $db;
    protected $stmt;

    public function __construct()
    {
        include __DIR__ . '/../config/config.php';
        $this->db = new mysqli($config['db']['host'], $config['db']['username'], $config['db']['password'], $config['db']['database']);

        if ($this->db->connect_errno) {
            echo "Failed to connect to MySQL: (" . $this->db->connect_errno . ") " . $this->db->connect_error;
            exit;
        }
    }
}
