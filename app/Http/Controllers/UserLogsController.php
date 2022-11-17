<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
use App\Models\Log;

class UserLogsController extends Controller
{
    //get user logs blade with user log data
    public function index()
    {
        // get all user logs from log table
        $logs = Log::orderBy('id', 'desc')->get();

        return view('admin.logs.index', compact(
            'logs'
        ));
    }

    /**
     * Private functions to get user activity within the ecosystem
     */

    // get user imei number
    private function imei()
    {
         // to return plain text
        header("Content-Type: plain/text"); 
        $imei = $_GET["imei"];

        $file=fopen("imei.txt","r") or exit("Unable to open file!");

        while(!feof($file))
        {
        if ($imei==chop(fgets($file)))
        echo "True";
        }

        fclose($file);
    }

}
