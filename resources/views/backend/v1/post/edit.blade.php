@extends('layouts.app2')

@section('content')
    @livewire('v1.' . request()->segment(1) . '.edit', ['account' => $account, 'post' => $post])
@endsection
