@extends('layouts.front')
@section('title', 'FAQ — '.$group->name)
@section('content')
@include('faq::widget', ['group' => $group])
@endsection