@extends('layouts.app2')

@section('content')
    <div class="flex-grow-1">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-text">
                    @livewire($data['versi'] . '.' . request()->segment(1) . '.index')
                </div>
            </div>
        </div>
    </div>
@endsection
