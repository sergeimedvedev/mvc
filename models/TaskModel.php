<?php

class TaskModel extends Model
{
    public $id;
    public $username;
    public $email;
    public $text;
    public $status;

    public function getAll($count, $offset, $sort = false)
    {
        if ($sort) {
            $type = strtolower($sort['type']) == 'desc' ? 'DESC' : 'ASC';
            $orderBy = '';
            switch (strtolower($sort['sort'])) {
                case 'user':
                    $orderBy = ' ORDER BY username ' . $sort['type'];
                    break;
                case 'email':
                    $orderBy = ' ORDER BY email ' . $sort['type'];
                    break;
                case 'status':
                    $orderBy = ' ORDER BY status ' . $sort['type'];
                    break;
            }
        }
        $sql = 'SELECT * FROM task' . $orderBy . ' LIMIT :limit OFFSET :offset ';
        $params = [
            ':limit' => $count,
            ':offset' => ($offset - 1) * $count
        ];
        return $this->query($sql, $params);
    }

    private function filter()
    {

    }

    public function get($id)
    {
        $sql = 'SELECT * FROM task WHERE id = :id';
        $params = [
            ':id' => $id
        ];
        return $this->query($sql, $params, true);
    }

    public function insert()
    {
        $sql = 'INSERT INTO task (username, email, text) VALUES (:username, :email, :text)';
        return $this->query($sql, [
            ':username' => $this->username,
            ':email' => $this->email,
            ':text' => $this->text,
        ]);
    }

    public function save()
    {
        $sql = 'UPDATE task SET username = :username, email = :email, text = :text, status = :status WHERE id = :id';
        $params = [
            ':id' => $this->id,
            ':username' => $this->username,
            ':email' => $this->email,
            ':text' => $this->text,
            ':status' => is_null($this->status) ? 0 : 1,
        ];
        return $this->query($sql, $params);
    }


    public function getCount()
    {
        $sql = 'SELECT COUNT(id) as count FROM task';
        return $this->query($sql, null, true);
    }

}