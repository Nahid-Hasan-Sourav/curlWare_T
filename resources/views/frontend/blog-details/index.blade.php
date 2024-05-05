@extends('frontend.master')

@section('body')

<div class="container">
  
    <div class="card">
        <img src="{{ $blog->featured_image }}" class="card-img" style="height: 350px !important" alt="Stony Beach"/>
        <div class="card-img-overlay">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">
          {{ $blog->title }}
          </p>
          <p class="card-text">Last updated 3 mins ago</p>
        </div>

        <p class="p-3">{!! $blog->content !!}</p>
      </div>

</div>

<!-- Comments section -->
<div class="mt-4">
    <h3>Comments</h3>
    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="blog_id" value="{{ $blog->id }}">
        <div class="form-group">
            <label for="comment">Add a comment:</label>
            <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>
</div>

<!-- Display existing comments -->
<div class="mt-4">
    <h4>Existing Comments:</h4>
    @forelse($blog->comments as $comment)
        <div class="card mt-2">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted">{{ $comment->user->name }} <small>{{ $comment->created_at->diffForHumans() }}</small></h6>
                <p class="card-text">{{ $comment->comment }}</p>
                <!-- Reply form for each comment -->
                <form action="{{ route('replies.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                    <div class="form-group">
                        <label for="reply">Reply:</label>
                        <textarea class="form-control" id="reply" name="reply" rows="2"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Reply</button>
                </form>
                <!-- Display replies for each comment -->
                <div class="mt-2">
                    <h6>Replies:</h6>
                    @foreach($comment->replies as $reply)
                        <div class="card mt-2">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted">{{ $reply->user->name }} <small>{{ $reply->created_at->diffForHumans() }}</small></h6>
                                <p class="card-text">{{ $reply->reply }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @empty
        <p>No comments yet.</p>
    @endforelse
</div>
 
@endsection
