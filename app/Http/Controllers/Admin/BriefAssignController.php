<?php

namespace App\Http\Controllers\Admin;

use App\Brief;
use App\Client;
use App\ClientBrief;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignBriefRequest;
use Illuminate\Http\Request;

class BriefAssignController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('name', 'asc')->get();
        $briefs = Brief::orderBy('name', 'asc')->get();
        $client_briefs = ClientBrief::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.brief-assign.index', compact('client_briefs', 'clients', 'briefs'));
    }

    public function create()
    {
        //
    }

    public function store(AssignBriefRequest $request)
    {
        try {

            \DB::beginTransaction();

            $slug = null;

            do {
                $slug = \Str::slug(\Str::random(64));
            } while (ClientBrief::whereSlug($slug)->exists());

            $cb = new ClientBrief([
                'status' => ClientBrief::STATUS_PENDING,
                'slug' => $slug,
            ]);
            $cb->client()->associate(Client::findOrFail($request->get('client_id')));
            $cb->brief()->associate(Brief::findOrFail($request->get('brief_id')));
            $cb->save();

            \DB::commit();

            session()->flash('message', "Registro guardado correctamente.");
            return redirect()->action('Admin\BriefAssignController@index');

        } catch (\Exception $ex) {
            \Log::info($ex->getMessage());
            \Log::info($ex->getTraceAsString());
            \DB::rollBack();

            session()->flash('message-error', "Error interno al guardar registro.");
            return redirect()->back()->withInput($request->input());
        }
    }

    public function show(ClientBrief $brief_assign)
    {
        return view('admin.brief-assign.show', compact('brief_assign'));
    }

    public function edit(ClientBrief $brief_assign)
    {
        //
    }

    public function update(Request $request, ClientBrief $brief_assign)
    {
        //
    }

    public function destroy(ClientBrief $brief_assign)
    {
        $brief_assign->delete();
        session()->flash('message', "Registro borrado.");
        return redirect()->action('Admin\BriefAssignController@index');
    }
}
