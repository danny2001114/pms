<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function index()
    {
        return Inertia::render(page("Setting.Private"));
    }

    public function general()
    {
        return Inertia::render(page("Setting.General"));
    }
}
