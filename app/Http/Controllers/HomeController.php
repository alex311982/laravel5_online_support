<?php namespace App\Http\Controllers;

use App\Question;
use App\Country;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\Auth;
use Torann\GeoIP\GeoIPFacade;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');

		//parent::__construct();

		//$this->news = $news;
		//$this->user = $user;
	}


	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        if (Auth::user()) {
            $countryId = Auth::user()->country_id;
        } else {
            $location = GeoIPFacade::getLocation();
            $countryId = Country::where('country_code', '=', $location['isoCode'])->first()->id;
        }

        $questions = Question
            ::whereNotNull('questions.user_id')
            ->whereNotNull('questions.question_category_id')
            ->whereNotNull('questions.country_id')
            ->where('questions.is_displayed', '=', 1)
            ->where('questions.country_id', '=', $countryId)
            ->where('questions_countries.country_id', '=', $countryId)
            ->with('author')
            ->with('category')
            ->with('country')
            ->join('questions_countries', 'questions.id', '=', 'questions_countries.question_id')
            ->orderBy('questions_countries.count', 'DESC')->limit(5)->get();

        $allQuestions = Question::orderBy('updated_at', 'DESC')->paginate(10);

		return view('pages.home', compact('questions', 'allQuestions'));
	}

}