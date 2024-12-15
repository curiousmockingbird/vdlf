{{-- 
    Template Name: Staff
--}}
@extends('layouts.app')

@section('content')
    <page-header>
        <div class="container px-3">
            <h1>@php(the_title())</h1>
        </div>
    </page-header>
    <staff-board :show-category-title="{{ get_field("show_category_title") ? 'true' : 'false' }}"></staff-board>
@endsection
