<?php

class HikeInfo extends Database
{
    public function hikeInfo()
    {
        $db=$this->connectDb();

        $hikeID = 1;

        $req = $db->query("SELECT * FROM hikes WHERE hike_id=$hikeID");

        return $req->fetch(PDO::FETCH_ASSOC);

    }
    
}