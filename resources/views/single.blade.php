@extends('layouts.app')

@section('content')
  <post-content>
    <div class="list-style-enable font-body text-lg container py-16">
      <h1>@php(the_title())</h1>
      
      @php(the_content())
    </div>
  </post-content>
@endsection