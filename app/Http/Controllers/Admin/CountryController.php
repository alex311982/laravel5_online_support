<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Input;
use App\Country;
use App\Http\Requests\Admin\CountryRequest;
use App\Http\Requests\Admin\DeleteRequest;
use Datatables;

class CountryController extends AdminController {
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Show the page
        return view('admin.country.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function getCreate()
    {
        // Show the page
        return view('admin/country/create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function postCreate(CountryRequest $request)
    {
        $country = new Country();
        $country -> country_code = $request->country_code;
        $country -> name = $request->name;

        $icon = "";
        if(Input::hasFile('icon'))
        {
            $file = Input::file('icon');
            $filename = $file->getClientOriginalName();
            $extension = $file -> getClientOriginalExtension();
            $icon = sha1($filename . time()) . '.' . $extension;
        }
        $country -> icon = $icon;
        $country -> save();

        if (Input::hasFile('icon'))
        {
            $destinationPath = public_path() . '/images/country/'.$country->id.'/';
            Input::file('icon')->move($destinationPath, $icon);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function getEdit($id)
    {
        $country = Country::find($id);

        return view('admin/country/create_edit',compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postEdit(CountryRequest $request, $id)
    {
        $country = Country::find($id);
        $country -> country_code = $request->country_code;
        $country -> name = $request->name;

        $icon = "";

        if(Input::hasFile('icon'))
        {
            $file = Input::file('icon');
            $filename = $file->getClientOriginalName();
            $extension = $file -> getClientOriginalExtension();
            $icon = sha1($filename . time()) . '.' . $extension;
        }

        if (!empty($icon)) {
            $country -> icon = $icon;
        }

        $country -> save();

        if(Input::hasFile('icon'))
        {
            $destinationPath = public_path() . '/images/country/'.$country->id.'/';
            Input::file('icon')->move($destinationPath, $icon);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */

    public function getDelete($id)
    {
        $country = $id;
        // Show the page
        return view('admin/country/delete', compact('country'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     */
    public function postDelete(DeleteRequest $request,$id)
    {
        $country = Country::find($id);
        $country->delete();
    }

    /**
     * Show a list of all the countries posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $country = Country::whereNull('countries.deleted_at')
            ->select(array('countries.id', 'countries.name', 'countries.country_code',
                           'countries.icon as icon'));
//        "<span class='flag flag-$country_code' alt='flag'></span>"
        return Datatables::of($country)
//            ->edit_column('icon', '{!! ($icon!="")? "<img style=\"max-width: 30px; max-height: 30px;\" src=\"../images/Country/$id/$icon\">":""; !!}')
            ->edit_column('icon', '{!! ($icon!="")? "<span class=\"flag $icon\" alt=\"flag\">&nbsp</span>":""; !!}')

            ->add_column('actions', '<a href="{{{ URL::to(\'admin/country/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span> {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ URL::to(\'admin/country/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>
                    <input type="hidden" name="row" value="{{$id}}" id="row">')
            ->remove_column('id')

            ->make();
    }
}
