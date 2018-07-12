@extends('layouts.common-header-config')

@section('content')
<div id="app">

    <header-component></header-component>

    <div class="container-fluid">
        <div class="row">
            <sidebar current-tab="members"></sidebar>
            <!-- <div class="nav-padding-top col-sm-10 offset-sm-2">
                <test-component></test-component>
            </div> -->

            <h1 class="nav-padding-top col-sm-10 offset-sm-2">Members</h1>

            <div class="col-sm-10 offset-sm-2">
                <user-list></user-list>
            </div>
        </div>
    </div>

</div>
@endsection
