{{-- 
    Template Name: Press Relases & Updates
--}}
@extends('layouts.app')

@php 
  $key = isset($_GET["keywords"]) ? $_GET["keywords"] : "";
  $sort = isset($_GET["sort"]) ? $_GET["sort"] : "latest";
  $cat = isset($_GET["cat"]) ? $_GET["cat"] : "all";
@endphp

@section('content')
    <page-header>
        <div class="container px-3">

            <h1>Updates & Press Releases</h1>
        </div>
    </page-header>

    <updates-press
        keys="{{$key}}"
        sorting="{{$sort}}"
        cat="{{$cat}}"
    ></updates-press>
    
@endsection
