<?php namespace App\Http\Controllers;

use App\Question;
use App\QuestionCategory;
use App\Http\Requests\Admin\QuestionRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use yajra\Datatables\Datatables;
use App\Http\Requests\Admin\DeleteRequest;

class QuestionsController extends Controller {

    public function __construct()
    {
        $this->middleware('auth', [ 'except' => [ 'index', 'show' ] ]);
    }

    public function show($id)
    {
        if (Auth::user()) {
            $countryId = Auth::user()->country_id;
        } else {
            $location = GeoIPFacade::getLocation();
            $countryId = Country::where('country_code', '=', $location['isoCode'])->first()->id;
        }
        $questionCountry = QuestionsCountry::firstOrNew(array('country_id' => $countryId, 'question_id' => $id));
        $questionCountry->count ++;
        $questionCountry->save();

        // Get all the blog posts
        $question = Question
            ::where('questions.id', '=', $id)
            ->with('answer')->first();

        return view('questions.view_question', compact('question'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        // Show the page
        $questioncategories = QuestionCategory::all();

        return view('questions/create',compact('questioncategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate(QuestionRequest $request)
    {
        $question = new Question;
        $question -> user_id = Auth::id();
        $question -> country_id = Auth::user()->country_id;
        $question -> question_category_id = $request->question_category_id;
        $question -> content = $request->content;

        $question -> save();

        return Redirect::action('HomeController@index');
    }

    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $questions = Question::whereNull('questions.deleted_at')
            ->where('questions.user_id', '=', Auth::id())
            ->join('question_categories', 'question_categories.id', '=', 'questions.question_category_id')
            ->join('answers', 'answers.question_id', '=', 'questions.id')
            ->select(array(
                    'questions.id',
                    'question_categories.name as category',
                    'questions.content',
                    'answers.content AS answer_content',
                    'questions.created_at',
                    'questions.updated_at'
                ))->orderBy('questions.updated_at', 'DESC');

        return Datatables::of($questions)
            ->add_column('actions',
                '
                <a href="{{{ URL::to(\'question/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                <input type="hidden" name="row" value="{{$id}}" id="row">')
            ->remove_column('id')

            ->make();
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
        return view('questions.delete', compact('question'));
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

}
