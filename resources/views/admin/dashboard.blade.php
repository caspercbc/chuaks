@extends('layouts.common-header-config')

@section('content')
<div id="app">

    <header-component></header-component>

    <div class="container-fluid">
        <div class="row">
            <sidebar current-tab="dashboard"></sidebar>

            <h1 class="nav-padding-top col-sm-10 offset-sm-2">Dashboard</h1>

            <div class="col-sm-10 offset-sm-2">
                
            </div>
        </div>
    </div>

</div>
@endsection

