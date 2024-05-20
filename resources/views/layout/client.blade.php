<!DOCTYPE html>
<html>

<head
    prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# book: http://ogp.me/ns/book# profile: http://ogp.me/ns/profile#">
    <meta charset="UTF-8"/>
    <title>
        @if (trim($__env->yieldContent('template_title')))
            @yield('template_title') |
        @endif {{ config('app.name', 'Laravel') }}
    </title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <meta name="google-site-verification" content="NpqS36hKNT71PXOCitWUqI8ixOBrAPIr-DJ9VNwLmKY"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="rating" content="General">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" type="text/css" href="/resource/style.css"/>
    <script src="/resource/js/main.js"></script>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href=""/>
</head>

@php
    switch (true)
    {
        case is_route('genres.*'):
                $bodyId = "body_cat";
            break;
            case is_route('articles.*'):
                $bodyId = "body_truyen";
            break;
            case is_route('authors.*'):
                $bodyId = "body_author";
            break;
            case is_route('articles.view_chapter'):
                $bodyId = "body_chapter";
            break;
            default:
                $bodyId = "body_home";
                break;
    }
@endphp

<body id="{{ $bodyId }}">
<div id="wrap">
    @include('client.partials.header')
    @yield('content')
    @include('client.partials.footer')
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v19.0"
        nonce="ggm0ulbL"></script>
<script !src="">
    // Ngăn sự kiện keydown ở thanh tìm kiếm bị "nổi lên"
    $('.search-holder input[type="search"]').keydown(function (event) {
        event.stopPropagation();
    });
</script>
@yield('comment-article-scripts')
@yield('article-scripts')
</body>
</html>
