<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Poll_first;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Laravel\Lumen\Application;

class PollController extends Controller
{

	private string $salt = 'P4nJ4jHr49SYtsbKHNuc44SA';

	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request
	 * @return Response|View|Application
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
	 * @param $hash
	 * @return Response|View|Application
	 */
    public function show(String $hash)
    {
        $result = DB::select('SELECT * FROM polls WHERE hash = ? LIMIT 1', [$hash]);
        return view('polls.poll_1.view', compact('result'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
	 */
    public function store(Request $request)
    {
        $response = DB::insert('INSERT INTO polls (variant, hash) VALUES (?, ?)', [$request->variant, hash('sha256', date('Y-m-d H:i:s') . $this->salt)]);
        return redirect()->route('poll_1.view', ['hash' => $response->hash]);
    }
}
