@extends('layouts.common-header-config')

@section('content')
<div id="app">

    <header-component></header-component>

    <div class="container-fluid">
        <div class="row">
            <sidebar current-tab="reports"></sidebar>

            <h1 class="nav-padding-top col-sm-10 offset-sm-2">Reports</h1>
        </div>
    </div>

</div>
@endsection
