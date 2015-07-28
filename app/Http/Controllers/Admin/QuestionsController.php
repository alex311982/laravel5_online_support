<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Question;
use App\Answer;
use App\QuestionCategory;
use App\Http\Requests\Admin\QuestionRequest;
use App\Http\Requests\Admin\AnswerRequest;
use App\Http\Requests\Admin\DeleteRequest;
use App\Http\Requests\Admin\ReorderRequest;
use Illuminate\Support\Facades\Auth;
use Datatables;
use Illuminate\Support\Facades\DB;

class QuestionsController extends AdminController
{

    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('admin.questions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {
        $question = Question::find($id);
        $questioncategories = QuestionCategory::all();
        $questioncategory = $question->question_category_id;

        return view('admin.questions.edit',compact('question','questioncategories','questioncategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postEdit(QuestionRequest $request, $id)
    {
        $question = Question::find($id);
        $question -> user_id_edited = Auth::id();
        $question -> question_category_id = $request->question_category_id;
        $question -> is_displayed = ($request->is_displayed == 1) ? 1 : 0;
        $question -> content = $request->content;

        $question -> save();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getReply($id)
    {
        $answer = Question::find($id)->answer;
        return view('admin.questions.reply',compact('id','answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postReply(AnswerRequest $request, $id)
    {
        $answer = Question::find($id)->answer;
        if (!$answer) {
            $answer = new Answer();
        }

        $answer -> user_id_answered = Auth::id();
        $answer -> content = $request->content;
        $answer -> question_id = $id;

        $answer -> save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function getDelete($id)
    {
        $question = Question::find($id);
        // Show the page
        return view('admin.questions.delete', compact('question'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function postDelete(DeleteRequest $request,$id)
    {
        $question = Question::find($id);
        $question->delete();
    }


    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $questions = Question::whereNull('questions.deleted_at')
            ->join('users', 'users.id', '=', 'questions.user_id')
            ->join('question_categories', 'question_categories.id', '=', 'questions.question_category_id')
            ->select(array(
                    'questions.id',
                    'question_categories.name as category',
                    'questions.content','users.name',
                    DB::raw('IF(questions.is_displayed = 1, "Yes", "No") as is_displayed'),
                    'questions.created_at'
            ))->orderBy('questions.updated_at', 'DESC');

        return Datatables::of($questions)
            ->add_column('actions',
                    '
                    <a href="{{{ URL::to(\'admin/question/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ URL::to(\'admin/question/\' . $id . \'/reply\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-alt"></span>  {{ trans("admin/modal.reply") }}</a>
                    <a href="{{{ URL::to(\'admin/question/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                    <input type="hidden" name="row" value="{{$id}}" id="row">')
            ->remove_column('id')

            ->make();
    }

    /**
     * Reorder items
     *
     * @param items list
     * @return items from @param
     */
    public function getReorder(ReorderRequest $request) {
        $list = $request->list;
        $items = explode(",", $list);
        $order = 1;
        foreach ($items as $value) {
            if ($value != '') {
                Article::where('id', '=', $value) -> update(array('position' => $order));
                $order++;
            }
        }
        return $list;
    }
}
