@switch (true)
    @case(is_route('articles.*'))
        @include('client.partials.article-sidebar')
        @break;
    @case(is_route('home.index'))
        @include('client.partials.home-sidebar')
        @break
    @case(is_route('genres.*'))
    @case(is_route('authors.*'))
    @case(is_route('home.show_hot_articles'))
    @case(is_route('home.show_new_update_articles'))
    @case(is_route('home.show_completed_articles'))
    @case(is_route('home.search'))
        @include('client.partials.list-article-sidebar')
        @break
    @default
        @break
@endswitch
