@extends('layouts.app')

@section('content')
  <page-header>
    <h1>@php(the_title())</h1>
  </page-header>
  <div class="list-style-enable font-body text-lg container py-16">
      @php(the_content())
  </div>
@endsection