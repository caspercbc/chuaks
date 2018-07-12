@extends('layouts.common-header-config')

<!-- 
<script src="https://unpkg.com/vue/dist/vue.js"></script>
<script src="https://unpkg.com/vue-router/dist/vue-router.js"></script> -->

@section('content')
<div id="app">

    <header-component></header-component>

    <div class="container-fluid">
        <div class="row">
            <sidebar current-tab="dashboard"></sidebar>

            <h1 class="nav-padding-top col-sm-10 offset-sm-2">Dashboard</h1>

        </div>
    </div>

</div>
@endsection
