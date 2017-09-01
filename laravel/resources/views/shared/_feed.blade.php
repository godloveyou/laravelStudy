@if (count($feed_items))
    <ol class="statuses" style="margin-bottom: 10px">
        @foreach ($feed_items as $article)
            @include('articles._article', ['user' => $article->user])
        @endforeach
        {!! $feed_items->render() !!}

    </ol>
@endif