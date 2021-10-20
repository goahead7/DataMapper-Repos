<?php

class bag
{
    private $id;
    private $manufacturer;
    private $model;

    public function __construct($id, $manufacturer, $model)
    {
        $this->id = $id;
        $this->manufacturer = $manufacturer;
        $this->model = $model;

    }
}

class bagMapper {

    private  $dbh;

    function __construct(){
        $dbh = new PDO("mysql:dbname=db;host=localhost", "sophia", "1111");
    }

    public function getByID(bag $id) :bag
    {
        $get = $this->dbh->prepare("SELECT * FROM Bag WHERE id = $id");
        $get -> execute();
        $data = $get->fetch(\PDO::FETCH_ASSOC);
        return new bag ($data['id'], $data['manufacturer'], $data['model']);
    }

    public function getByModel(bag $model) : array
    {
        $get = $this->dbh->prepare("SELECT * FROM Bag WHERE model = $model");
        $get -> execute();
        $data = $get->fetchAll();
        return $data;
    }

    public function save(bag $bag) {

        $save = $this->dbh->prepare("INSERT INTO Bag (id, manufacturer, model) VALUE (?, ?, ?)");
        $save->execute(array($this->id, $this->manufacturer, $this->model));
    }

    public function remove(bag $bag) {

        $del = $this->dbh->prepare("DELETE FROM Bag where id = ?, manufacturer = ?, model = ?");
        $del->execute(array($this->id, $this->manufacturer, $this->model));

    }

    public function all() : array
    {
        $data = $this->dbh->prepare("SELECT * FROM Bag");
        $data->execute();
        $res = $data->fetchAll();
        return $res;
    }

}