<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data\TutorData;

class ChatController extends Controller
{
    public function index(int $tutor_id = 1)
    {
        $tutor = TutorData::find($tutor_id) ?? TutorData::find(1);
        return view('pages.chat', compact('tutor'));
    }
}
