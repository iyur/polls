<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poll_first;

class PollController extends Controller
{

    private $salt = 'P4nJ4jHr49SYtsbKHNuc44SA';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!empty($request->all()))
            $response = $request->all();
        return view('polls.poll_1.index', compact('response'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($hash)
    {
        $result = Poll_first::where('hash', $hash)->take(1)->get()[0];
        return view('polls.poll_1.view', compact('result'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Poll_first::create(['variant' => $request->variant, 'hash' => hash('sha256', date('Y-m-d H:i:s') . $this->salt)]);
        return redirect()->route('poll_1.view', ['hash' => $response->hash]);
    }
}
