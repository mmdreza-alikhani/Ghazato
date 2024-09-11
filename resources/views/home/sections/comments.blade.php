@foreach($comments as $comment)
    <div class="comments-group rtl text-right">
        <div class="comments-item">
            <a href="#" class="thumb">
                <img src="{{ Str::contains($comment->user->avatar, 'https://') ? $comment->user->avatar : env('USER_AVATAR_UPLOAD_PATH') . '/' . $comment->user->avatar }}" alt="{{ $comment->user->title . '-avatar' }}" width="100">
            </a>
            <div class="comments-content">
                <div class="heading">
                    <h6>
                        <a href="#">{{ $comment->user->username }}</a>
                    </h6>
                    <div class="comments-time">{{ verta($comment->updated_at)->format('%d %B، %Y') }}</div>
                </div>
                <div class="body">
                    <p>
                        {{ $comment->text }}
                    </p>
                    <a class="replyBtn" data-id="{{ $comment->id }}" href="{{ \Illuminate\Support\Facades\Request::url() . '#addComment' }}">
                        <i class="zmdi zmdi-mail-reply-all"></i>
                        پاسخ
                    </a>
                </div>
            </div>
        </div>
{{--        @include('home.sections.comments' , ['comments' => $comment->replies])--}}
    </div>
@endforeach
