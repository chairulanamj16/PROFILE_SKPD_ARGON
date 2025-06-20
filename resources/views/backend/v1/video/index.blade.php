@extends('layouts.app2')

@section('content')
    <div class="flex-grow-1">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-text">
                    @livewire('v1.' . request()->segment(1) . '.index', ['account' => $account])
                </div>
            </div>
        </div>
    </div>
@endsection
