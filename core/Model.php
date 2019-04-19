<?php

class Model
{
    const DSN = 'mysql:host=' . CFG['db']['host'] . ';dbname=' . CFG['db']['database'] . ';charset=UTF8';
    const OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    private $pdo;
    private $stmt;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(self::DSN, CFG['db']['user'], CFG['db']['password'], self::OPTIONS);
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    public function __destruct()
    {
        if ($this->stmt !== null) $this->stmt = null;
        if ($this->pdo !== null) $this->pdo = null;
    }

    public function query($sql, $cond = null, $single = false)
    {
        try {
            $this->stmt = $this->pdo->prepare($sql);
//            $this->stmt->debugDumpParams();
            $this->stmt->execute($cond);
            $result = !$single ? $this->stmt->fetchAll() : $this->stmt->fetch();
        } catch (Exception $ex) {
            die ($ex->getMessage());
        } finally {
            $this->stmt = null;
        }
        return $result ?? false;
    }

}