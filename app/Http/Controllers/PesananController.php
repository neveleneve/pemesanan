<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesananController extends Controller {
    public function __construct() {
        $this->middleware('permission:pesanan index')->only('index');
        $this->middleware('permission:pesanan create')->only('create', 'store');
        $this->middleware('permission:pesanan show')->only('show');
        $this->middleware('permission:pesanan edit')->only('edit', 'update');
        $this->middleware('permission:pesanan delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('user.pesanan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }
}
