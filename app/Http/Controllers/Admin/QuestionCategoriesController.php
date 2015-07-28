<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeleteRequest;
use App\Http\Requests\Admin\QuestionCategoryRequest;
use App\QuestionCategory;
use Datatables;

class QuestionCategoriesController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Show the page
        return view('admin.questioncategory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        $categories = QuestionCategory::all();
        $category = "";
        // Show the page
        return view('admin.questioncategory.create_edit', compact('categories','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate(QuestionCategoryRequest $request)
    {
        $questioncategory = new QuestionCategory();
        $questioncategory -> name = $request->name;
        $questioncategory -> save();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {
        $questioncategory = QuestionCategory::find($id);
        $questioncategories = QuestionCategory::all();

        return view('admin.questioncategory.create_edit',compact('questioncategory','questioncategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postEdit(QuestionCategoryRequest $request, $id)
    {
        $questioncategory = QuestionCategory::find($id);
        $questioncategory -> name = $request->name;
        $questioncategory -> save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */

    public function getDelete($id)
    {
        $questioncategory = QuestionCategory::find($id);
        // Show the page
        return view('admin.questioncategory.delete', compact('questioncategory'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function postDelete(DeleteRequest $request,$id)
    {
        $questioncategory = QuestionCategory::find($id);
        $questioncategory->delete();
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $question_categories = QuestionCategory::whereNull('question_categories.deleted_at')
            ->select(array('question_categories.id','question_categories.name', 'question_categories.created_at'));

        return Datatables::of($question_categories)
            ->add_column('actions', '<a href="{{{ URL::to(\'admin/questioncategory/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                <a href="{{{ URL::to(\'admin/questioncategory/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                <input type="hidden" name="row" value="{{$id}}" id="row">')
            ->remove_column('id')

            ->make();
    }
}
