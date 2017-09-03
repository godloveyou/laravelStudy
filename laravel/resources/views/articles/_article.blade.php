<div class="panel panel-primary">
    <div class="panel-heading">{{$user->name}}</div>

    <div class="panel-body">
        {{$article->content}}

        @can('destroy', $article)
            <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-sm btn-danger status-delete-btn">删除</button>
            </form>
        @endcan

    </div>
  
</div>
