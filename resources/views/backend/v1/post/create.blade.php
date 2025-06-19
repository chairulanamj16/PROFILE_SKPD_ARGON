@extends('layouts.app2')

@section('content')
    @livewire('v1.' . request()->segment(1) . '.create', ['account' => $account])
@endsection
