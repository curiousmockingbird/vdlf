{{-- 
    Template Name: Media Mentions
--}}
@extends('layouts.app')

@section('content')
    <page-header>
        <div class="container px-3">

            <h1>@php(the_title())</h1>
        </div>
    </page-header>

    <media-mention></media-mention>
    
@endsection
