@extends('layouts.app2')

@section('content')
    @livewire('v1.pengaturan.index', ['account' => $account])
@endsection
