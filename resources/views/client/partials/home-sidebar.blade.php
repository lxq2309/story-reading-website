<div class="list list-truyen list-cat col-xs-12">
    <div class="title-list">
        <h4>Thể loại</h4>
    </div>
    <div class="row">
        @foreach ($genres as $genre)
            <div class="col-xs-6"><a href="{{ route('genres.show', $genre->id) }}" title="{{ $genre->name }}">{{ $genre->name }}</a></div>
        @endforeach
    </div>
</div>
