@extends('layouts.admin-config')

@section('content')

<div id="app">
  <header-component></header-component>

  <div class="container-fluid">
    <div class="row">
      <sidebar></sidebar>
      <div class="nav-padding-top col-sm-10 offset-sm-2">
          <router-view></router-view>
      </div>
    </div>
  </div>
</div>

@endsection

