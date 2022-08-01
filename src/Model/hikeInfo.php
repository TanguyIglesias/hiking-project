<?php

class HikeInfo extends Database
{
    public function hikeInfo($hike_id)
    {
        $db=$this->connectDb();

        $hikeID = $hike_id;

        $req = $db->query("SELECT * FROM hikes WHERE hike_id=$hikeID");

        return $req->fetch(PDO::FETCH_ASSOC);

    }
    
}