<?php

use App\Models\Setting;

function month($month){
    if($month == 1){
        return "Januari";
    }
    else if($month == 2){
        return "Februari";
    }
    else if($month == 3){
        return "Maret";
    }
    else if($month == 4){
        return "April";
    }
    else if($month == 5){
        return "Mei";
    }
    else if($month == 6){
        return "Juni";
    }
    else if($month == 7){
        return "Juli";
    }
    else if($month == 8){
        return "Agustus";
    }
    else if($month == 9){
        return "September";
    }
    else if($month == 10){
        return "Oktober";
    }
    else if($month == 11){
        return "November";
    }
    else if($month == 12){
        return "Desember";
    }
}

function getSettings($nama)
{
    return Setting::where('nama', $nama)->first()->value;
}