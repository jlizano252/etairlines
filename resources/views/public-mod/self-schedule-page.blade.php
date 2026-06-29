@extends('layout.public-layout')

@section('main-content')

<link rel="stylesheet" href="{{ asset('css/self-schedule.css') }}">

@livewire(
'public.enrollment-form.v1.self-schedule-appointment',
['student' => $student]
)

@endsection