<?php

namespace App\Http\Controllers\Admin;

use App\Brief;
use App\Client;
use App\ClientBrief;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignBriefRequest;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use League\CommonMark\CommonMarkConverter;

class BriefAssignController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('s');
        $clients = Client::orderBy('name', 'asc')->get();
        $briefs = Brief::orderBy('name', 'asc')->get();

        $client_briefs = ClientBrief::query()
            ->when($search, function ($q) use ($search) {
                $q->whereHas('client', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                })->orWhereHas('brief', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(session('paginate') ?: 20);

        return view('admin.brief-assign.index', compact('client_briefs', 'clients', 'briefs', 'search'));
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
        $converter = new CommonMarkConverter();

        $brief_assign->answers->map(function ($answer) use ($converter) {
            if (isset($answer->answer[0]) && strpos($answer->answer[0], "\n") !== false) {
                $answer->answer = [$converter->convertToHtml($answer->answer[0])];
            }
            return $answer;
        });

        return view('admin.brief-assign.show', compact('brief_assign'));
    }

    public function edit(ClientBrief $brief_assign)
    {
        //
    }

    public function update(Request $request, ClientBrief $brief_assign)
    {
        $statuses = implode(",", collect(ClientBrief::statuses())->pluck('id')->toArray());
        $request->validate([
            'status' => ['required', "in:$statuses"],
        ]);

        $brief_assign->update([
            'status' => $request->get('status'),
        ]);

        session()->flash('message', "Registro actualizado correctamente.");
        return redirect()->action('Admin\BriefAssignController@show', $brief_assign);
    }

    public function destroy(ClientBrief $brief_assign)
    {
        $brief_assign->delete();
        session()->flash('message', "Registro borrado.");
        return redirect()->action('Admin\BriefAssignController@index');
    }

    public function generatePDF(ClientBrief $brief_assign)
    {
        $converter = new CommonMarkConverter();

        $brief_assign->answers->map(function ($answer) use ($converter) {
            if (isset($answer->answer[0]) && strpos($answer->answer[0], "\n") !== false) {
                $answer->answer = [$converter->convertToHtml($answer->answer[0])];
            }
            return $answer;
        });

        $options = new Options();
        $options->set('defaultFont', 'Helvetica');
        $dompdf = new Dompdf($options);
        $content = "";

        $title = ($brief_assign->brief ? $brief_assign->brief->name : "Brief") . " / " . $brief_assign->client->name;

        $content = "<h1>$title</h1><br>";

        foreach ($brief_assign->answers as $answer) {
            $content .= "<p><strong>{$answer->question}</strong></p>";
            $content .= "<p>";

            foreach ($answer->answer as $answer) {
                $content .= "$answer<br>";
            }

            $content .= "</p>";
        }

        $dompdf->loadHtml($content);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream();
    }
}
