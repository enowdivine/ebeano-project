@extends('layouts.theme')
@section('title','Ebeanomarket | About Us')
@section('content')

@php
    $page = App\Page::where('slug','about-us')->first();
@endphp
<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Home</a></li>
    <li class="breadcrumb-item active">About Us</li>
  </ul>
  
  <div class="card border-0 my-4">
     <div class="text-center border-bottom py-2">
         <h2>{{strtoupper($page['title'])}}</h2>
     </div>
     <div class="px-3 mt-2 pt-2">
         {!!$page['content']!!}
     </div>
  </div>
@endsection