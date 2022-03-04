{{-- 
    Template Name: Press Relases & Updates
--}}
@extends('layouts.app')

@section('content')
    <page-header-alt>
        <div class="container px-3">

            <h1>@php(the_title())</h1>
        </div>
    </page-header-alt>

    <updates-press></updates-press>
    
@endsection
