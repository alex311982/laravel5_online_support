{{-- TODO: --}}
{{--<div class="input-group">--}}
{{--<input type="text" class="form-control" placeholder="Search...">--}}
{{--<span class="input-group-btn">--}}
{{--<button class="btn btn-default" type="button">--}}
{{--<i class="fa fa-search"></i>--}}
{{--</button>--}}
{{--</span>--}}
{{--</div>--}}

<div class="metismenu">
<ul class="nav nav-pills nav-stacked">
    <li class="{{set_active('admin/dashboard')}}">
        <a href="{{url('admin/dashboard')}}">
            <i class="fa fa-dashboard fa-fw"></i>
            <span class="hidden-sm text"> Dashboard</span>
        </a>
    </li>
    <li class="{{set_active('admin/country*')}}">
        <a href="{{url('admin/country')}}">
            <i class="fa fa-country"></i>
            <span class="hidden-sm text"> Country</span>
        </a>
    </li>
    <li class="{{set_active('admin/question*')}}">
        <a href="#">
            <i class="glyphicon glyphicon-bullhorn"></i> Question items
            <span class="fa arrow"></span>
        </a>
        <ul class="nav collapse">
            <li class="{{set_active('admin/questioncategories')}}">
                <a href="{{url('admin/questioncategories')}}">
                    <i class="glyphicon glyphicon-list"></i>
                    <span class="hidden-sm text"> Question categories</span>
                </a>
            </li>
            <li class="{{set_active('admin/questions')}}">
                <a href="{{url('admin/questions')}}">
                    <i class="glyphicon glyphicon-bullhorn"></i>
                    <span class="hidden-sm text"> Questions</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="{{set_active('admin/users*')}}">
        <a href="{{url('admin/users')}}">
            <i class="glyphicon glyphicon-user"></i>
            <span class="hidden-sm text"> Users</span>
        </a>
    </li>
</ul>
</div>