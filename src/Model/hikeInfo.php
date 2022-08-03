<?php

class HikeInfo extends Database
{
    public function hikeInfo($hike_id)
    {
        $db = $this->connectDb();

        $hikeID = $hike_id;

        $req = $db->query("SELECT * FROM hikes WHERE hike_id=$hikeID");

        return $req->fetch(PDO::FETCH_ASSOC);
    }

    function orderCreationData($hikeID)
    {

        $db = $this->connectDb();

        //$hikeID = $hike_id;

        $req = $db->query("SELECT DATE_FORMAT(creation_date, '%d/%m/%Y') FROM hikes WHERE hike_id=$hikeID");

        $array = $req->fetch(PDO::FETCH_ASSOC);

        $dateCreation = implode($array);

        return $dateCreation;
    }

    function orderUpdateData($hikeID)
    {

        $db = $this->connectDb();

        $req = $db->query("SELECT DATE_FORMAT(update_date, '%d/%m/%Y') FROM hikes WHERE hike_id=$hikeID");

        $array = $req->fetch(PDO::FETCH_ASSOC);

        $dateUpdate = implode($array);

        return $dateUpdate;
    }
}
