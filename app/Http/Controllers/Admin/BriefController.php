<?php

namespace App\Http\Controllers\Admin;

use App\Brief;
use App\Http\Controllers\Controller;
use App\Http\Requests\BriefRequest;
use App\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BriefController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('s');
        $briefs = Brief::query()
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.brief.index', compact('briefs', 'search'));
    }

    public function create()
    {
        $types = Question::types();
        $brief = new Brief();
        $brief->questions;
        return view('admin.brief.create', compact('brief', 'types'));
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
        $types = Question::types();
        $brief->questions = $brief->questions()->orderBy('created_at', 'asc')->get();
        return view('admin.brief.edit', compact('brief', 'types'));
    }

    public function update(BriefRequest $request, Brief $brief)
    {
        return $this->saveOrUpdate($request, $brief);
    }

    public function destroy(Brief $brief)
    {
        $brief->delete();
        session()->flash('message', "Registro borrado.");
        return redirect()->action('Admin\BriefController@index');
    }

    private function saveOrUpdate(Request $request, Brief $brief = null)
    {
        try {

            \DB::beginTransaction();

            $current_date = Carbon::now();

            if ($brief == null) {
                $brief = Brief::create($request->only('name'));
            } else {
                $brief->update($request->only('name'));
            }

            $all_id_questions = collect($request->get('questions'))->pluck('id')->toArray();
            $current_id_questions = $brief->questions()->select('id')->get()->pluck('id')->toArray();
            $delete_id_questions = array_diff($current_id_questions, $all_id_questions);

            $brief->questions()->whereIn('id', $delete_id_questions)->delete();

            foreach ($request->get('questions') as $key => $question) {
                if (isset($question['id']) && $question['id'] != null) {
                    $q = $brief->questions()->find($question['id']);
                    $q->update($question);

                    if ($q->isOpen() || $q->isOpenArea()) {
                        $q->update(['options' => null]);
                    }
                } else {
                    $q = new Question($question);
                    $q->brief()->associate($brief);
                    $q->save();
                }

                $q->update([
                    'created_at' => $current_date->setSeconds($key)->format('Y-m-d H:i:s'),
                    'updated_at' => $current_date->setSeconds($key)->format('Y-m-d H:i:s'),
                ]);
            }

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

    public function duplicate(Request $request, Brief $brief)
    {
        try {

            \DB::beginTransaction();

            $name = "";
            $i = 2;

            do {
                $name = "{$brief->name} $i";
                $i++;
            } while (\DB::table('briefs')->whereName($name)->exists());

            $new_brief = Brief::create(['name' => $name]);

            foreach ($brief->questions as $key => $question) {
                $q = new Question([
                    'type' => $question->type,
                    'question' => $question->question,
                    'options' => $question->options,
                    'created_at' => $question->created_at,
                    'updated_at' => $question->updated_at,
                ]);
                $q->brief()->associate($new_brief);
                $q->save();
            }

            \DB::commit();

            session()->flash('message', "Brief duplicado correctamente.");
            return redirect()->action('Admin\BriefController@edit', $new_brief->id);

        } catch (\Exception $ex) {
            \Log::info($ex->getMessage());
            \Log::info($ex->getTraceAsString());
            \DB::rollBack();

            session()->flash('message-error', "Error interno al duplicar brief.");
            return redirect()->back()->withInput($request->input());
        }
    }
}
