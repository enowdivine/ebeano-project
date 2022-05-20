@extends('layouts.artisan')

@section('title', 'Artisans Dashboard')

@section('content')
<div class="row">
@php
   $name = Str::of(Auth::user()->name)->explode(' ');
   $user_name = $name[0];
@endphp
    <div class="col-lg-3">
        @include('artisans/partials/menuhome')
    </div>
    <div class="col-lg-9">
        @include('artisans/partials/employer_board')
    </div>

</div>
@endsection