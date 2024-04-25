<div class="btn-group">
    @php
        $previousChapter = $chapter->previous;
    @endphp
    @if ($previousChapter)
        <a class="btn btn-success btn-chapter-nav" id="prev_chap"
           href="{{ route('articles.chapters.show', [$article->id, $previousChapter->number]) }}">
            <span class="glyphicon glyphicon-chevron-left"></span> Prev
        </a>
    @else
        <a class="btn btn-success btn-chapter-nav disabled" href="javascript:void(0)"
           title="There is no chapter">
            <span class="glyphicon glyphicon-chevron-left"></span> Prev
        </a>
    @endif
    <button type="button" class="btn btn-success btn-chapter-nav chapter_jump">
        <span class="glyphicon glyphicon-list-alt"></span>
    </button>
    <select class="btn btn-success btn-chapter-nav form-control chapter_jump"
            onchange="window.location.href='/articles/{{ $article->id }}/chapters/'+this.value;">
        @foreach ($articleChapters as $articleChapter)
            <option
                    value="{{ $articleChapter->number }}" {{ $articleChapter->number == $chapter->number ? 'selected' : '' }}>{{ $articleChapter->number_text . ': ' .  $articleChapter->title }}</option>
        @endforeach
    </select>

    @php
        $nextChapter = $chapter->next;
    @endphp
    @if ($nextChapter)
        <a class="btn btn-success btn-chapter-nav" id="next_chap"
           href="{{ route('articles.chapters.show', [$article->id, $nextChapter->number]) }}">
            Next <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    @else
        <a class="btn btn-success btn-chapter-nav disabled" href="javascript:void(0)"
           title="There is no chapter">
            Next <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    @endif
</div>
