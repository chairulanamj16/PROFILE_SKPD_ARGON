@extends('frontend.bootslander.template.index')

@section('content')
    <section class="dark-background">
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <img src="{{ url('storage/' . $post->thumb) }}" class="img-fluid rounded" alt="{{ $post->title }}"
                        width="100%">
                    <br>
                    <br>
                    <h2>
                        {{ $post->title }}
                    </h2>
                    <div>
                        <span class="text-uppercase">
                            {{ $post->office->subdomain }}
                        </span>
                        |
                        <span>
                            {{ dateFormat($post->created_at) }}
                        </span>
                        |
                        {{ $post->postCategories->pluck('name')->join(', ') }}
                    </div>
                    <br><br>
                    <div class="text-dark">
                        {!! $post->body !!}
                    </div>
                </div>
                <div class="col-md-4">
                    @php
                        $more_posts = @$office
                            ->posts()
                            ->where('id', '!=', $post->id)
                            ->orderBy('id', 'DESC')
                            ->whereHas(
                                'postCategories',
                                fn($q) => $q->whereIn('name', $post->postCategories->pluck('name')),
                            )
                            ->limit(4)
                            ->get();
                    @endphp
                    @foreach ($more_posts as $item)
                        <a href="{{ route('f.post.show', ['account' => $office->subdomain, 'post' => $item->uuid]) }}"
                            class="card mb-2">
                            <div class="card-body">
                                <img src="{{ url('storage/' . $item->thumb) }}" alt="{{ $item->title }}"
                                    class="img-fluid rounded">
                                <br>
                                <br>
                                <h5>{{ $item->title }}</h5>
                                <div class="text-dark">
                                    <div>
                                        <span class="text-uppercase">
                                            {{ $item->office->subdomain }}
                                        </span>
                                        |
                                        <span>
                                            {{ dateFormat($item->created_at) }}
                                        </span>
                                        |
                                        <span>
                                            {{ $item->postCategories->pluck('name')->join(', ') }}
                                        </span>
                                    </div>
                                    <br>
                                    {!! $item->excercept !!}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
