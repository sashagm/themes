<?php

namespace Sashagm\Themes\Interface;

use Illuminate\Http\Request;

interface ThemeInterface
{
    public function index(Request $request);

    public function store(Request $request);

    public function show($id);

    public function update(Request $request, $id);

    public function destroy($id);
}