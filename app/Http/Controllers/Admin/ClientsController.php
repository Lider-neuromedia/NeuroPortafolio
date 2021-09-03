<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('s');
        $clients = Client::query()
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })
            ->orderBy('name', 'asc')
            ->paginate(10);
        return view('admin.clients.index', compact('clients', 'search'));
    }

    public function create()
    {
        $client = new Client();
        return view('admin.clients.create', compact('client'));
    }

    public function store(ClientRequest $request)
    {
        return $this->saveOrUpdate($request);
    }

    public function show(Client $client)
    {
        //
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(ClientRequest $request, Client $client)
    {
        return $this->saveOrUpdate($request, $client);
    }

    public function destroy(Client $client)
    {
        $client->delete();
        session()->flash('message', "Registro borrado.");
        return redirect()->action('Admin\ClientsController@index');
    }

    private function saveOrUpdate(Request $request, Client $client = null)
    {
        try {

            \DB::beginTransaction();

            $data = $request->only('name');

            if ($client != null) {
                $client->update($data);
            } else {
                $client = Client::create($data);
                $client->save();
            }

            \DB::commit();

            session()->flash('message', "Registro guardado correctamente.");
            return redirect()->action('Admin\ClientsController@edit', $client->id);

        } catch (\Exception $ex) {
            \Log::info($ex->getMessage());
            \Log::info($ex->getTraceAsString());
            \DB::rollBack();

            session()->flash('message-error', "Error interno al guardar registro.");
            return redirect()->back()->withInput($request->input());
        }
    }
}
