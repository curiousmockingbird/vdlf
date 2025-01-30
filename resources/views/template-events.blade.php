{{-- 
    Template Name: Events
--}}
@extends('layouts.app')

@section('content')
    <page-header>
        <div class="container px-3">
            <h1>@php(the_title())</h1>
        </div>
    </page-header>
    <event-list></event-list>
@endsection
