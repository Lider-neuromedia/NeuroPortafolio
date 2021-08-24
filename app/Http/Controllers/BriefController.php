<?php

namespace App\Http\Controllers;

use App\Answer;
use App\ClientBrief;
use App\Http\Requests\FillBriefRequest;
use Illuminate\Http\Request;

class BriefController extends Controller
{
    public function brief(String $slug)
    {
        $content = ClientBrief::query()
            ->whereSlug($slug)
            ->with('client', 'brief', 'brief.questions', 'answers', 'answers.question')
            ->firstOrFail();

        $questions = collect([]);

        foreach ($content->brief->questions as $question) {
            $data = [
                "question_id" => $question->id,
                "question" => $question->question,
                "options" => $question->options,
                "tag_id" => $question->tag_id,
                "answer" => [""],
                "type" => $question->type,
                "isOpen" => $question->isOpen(),
                "isMultipleSelection" => $question->isMultipleSelection(),
                "isUniqueSelection" => $question->isUniqueSelection(),
            ];

            foreach ($content->answers as $answer) {
                if ($answer->question_id == $question->id) {
                    $data['answer_id'] = $answer->id;
                    $data['answer'] = $answer->answer;
                }
            }

            $questions[] = (Object) $data;
        }

        $total_questions = $questions->count();
        $completed_questions = $questions
            ->filter(function ($value, $key) {
                return $value->answer[0] !== "";
            })
            ->count();

        $percentage = round($completed_questions * 100 / $total_questions, 2);

        return view('brief.index', compact('content', 'questions', 'percentage'));
    }

    public function store(FillBriefRequest $request, String $slug)
    {
        try {

            \DB::beginTransaction();

            $content = ClientBrief::query()
                ->whereSlug($slug)
                ->notCompleted()
                ->firstOrFail();

            $content->answers()->delete();

            foreach ($content->brief->questions as $question) {
                if ($request->has($question->tag_id) && $request->get($question->tag_id) !== null) {
                    $answer = new Answer([
                        'question' => $question->question,
                        'answer' => $request->get($question->tag_id),
                    ]);
                    $answer->clientBrief()->associate($content);
                    $answer->question()->associate($question);
                    $answer->save();
                }
            }

            \DB::commit();

            session()->flash('message', "Progreso guardado correctamente.");
            return redirect()->action("BriefController@brief", $slug);

        } catch (\Exception $ex) {
            \Log::info($ex->getMessage());
            \Log::info($ex->getTraceAsString());
            \DB::rollBack();

            session()->flash('message-error', "Error interno al guardar progreso.");
            return redirect()->back()->withInput($request->input());
        }
    }

    public function complete(Request $request, String $slug)
    {
        try {

            \DB::beginTransaction();

            $content = ClientBrief::query()
                ->whereSlug($slug)
                ->notCompleted()
                ->firstOrFail();

            $content->update(['status' => ClientBrief::STATUS_COMPLETED]);

            \DB::commit();

            session()->flash('message', "Brief completado correctamente.");
            return redirect()->action("BriefController@brief", $slug);

        } catch (\Exception $ex) {
            \Log::info($ex->getMessage());
            \Log::info($ex->getTraceAsString());
            \DB::rollBack();

            session()->flash('message-error', "Error interno al completar brief.");
            return redirect()->back()->withInput($request->input());
        }
    }
}
