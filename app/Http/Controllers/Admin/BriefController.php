<?php

namespace App\Http\Controllers\Admin;

use App\Brief;
use App\Http\Controllers\Controller;
use App\Http\Requests\BriefRequest;
use Illuminate\Http\Request;

class BriefController extends Controller
{
    public function index()
    {
        $briefs = Brief::query()
            ->orderBy('name', 'asc')
            ->paginate(10);
        return view('admin.brief.index', compact('briefs'));
    }

    public function create()
    {
        return view('admin.brief.create');
    }

    public function store(BriefRequest $request)
    {
        return $this->saveOrUpdate($request);
    }

    public function show(Brief $brief)
    {
        //
    }

    public function edit(Brief $brief)
    {
        return view('admin.brief.edit');
    }

    public function update(BriefRequest $request, Brief $brief)
    {
        return $this->saveOrUpdate($request, $brief);
    }

    public function destroy(Brief $brief)
    {
        //
    }

    private function saveOrUpdate(Request $request, Brief $brief = null)
    {
        try {

            \DB::beginTransaction();

            \DB::commit();

            session()->flash('message', "Registro guardado correctamente.");
            return redirect()->action('Admin\BriefController@edit', $brief->id);

        } catch (\Exception $ex) {
            \Log::info($ex->getMessage());
            \Log::info($ex->getTraceAsString());
            \DB::rollBack();

            session()->flash('message-error', "Error interno al guardar registro.");
            return redirect()->back()->withInput($request->input());
        }
    }
}
