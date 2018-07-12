@extends('layouts.common-header-config')



@section('content')
<div id="app">


    <h1>Hello App!</h1>
      <p>
        <!-- use router-link component for navigation. -->
        <!-- specify the link by passing the `to` prop. -->
        <!-- `<router-link>` will be rendered as an `<a>` tag by default -->
        <router-link to="/foo">Go to Foo</router-link>
        <router-link to="/bar">Go to Bar</router-link>
      </p>
      <!-- route outlet -->
      <!-- component matched by the route will render here -->
      <router-view></router-view>

    <!-- <header-component></header-component> -->

    <!-- <div class="container-fluid">
        <div class="row">
            <sidebar current-tab="Dashboard"></sidebar>
            <div class="nav-padding-top col-sm-10 offset-sm-2">
                <test-component></test-component>
            </div>

            <h1 class="nav-padding-top col-sm-10 offset-sm-2">Dashboard</h1>

            <div class="col-sm-10 offset-sm-2">
                <user-list></user-list>
            </div>
        </div>
    </div> -->

</div>
@endsection
