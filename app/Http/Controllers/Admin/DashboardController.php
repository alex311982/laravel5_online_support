<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Question;
use App\QuestionCategory;
use App\Country;
use App\User;


class DashboardController extends AdminController {

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
        $title = "Dashboard";

        $questions = Question::count();
        $questioncategories = QuestionCategory::count();
        $users = User::count();
		return view('admin.dashboard.index',  compact('title','questions','questioncategories',
            'countries','users'));
	}
}