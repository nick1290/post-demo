<div>
    <div class="row m-4">
        <div class="col-6">
            <div class="card ">
                <div class="card-header">
                    <h5 class="card-title">Create Post</h5>
                </div>
                <div class="card-body">
                    @if (session()->has('postmsg'))
                        <div class="alert alert-success">
                            {{ session('postmsg') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="createPost" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" wire:model="title" class="form-control" id="title">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea wire:model="content" class="form-control" id="content"></textarea>
                            @error('content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" wire:model="image" id="image">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create Post</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6" wire:poll='bindPosts'>
            @forelse ($posts as $post)
                <div class="card mb-3">
                    <img src="{{ asset('posts/' . $post->image) }}" height="100" style="object-fit: cover"
                        class="card-img-top" alt="...">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">
                          <h5>  {{ $post->title }}</h5>
                        </div>
                        <h6 class="card-subtitle mb-2 text-muted">{{$post->user->name}} created at {{date('h:m a',strtotime($post->created_at))}}</h6>
                    </div>
                    <div class="card-body">
                        <p>
                            {{ $post->description }}
                        </p>

                        @foreach ($post->comments as $value)
                            <p style="background: #ccc; color:#000;padding:5px">
                                {{$value->comment}}
                                <span class="d-flex justify-content-end align-items-center">{{date('d/m/y, h:m a',strtotime($value->created_at))}}</span>
                            </p>
                        @endforeach

                        <form wire:submit.prevent="addComment({{$post->id}})">
                            <div class="form-group">
                                <label for="content">Content</label>
                                <div class="d-flex justify-content-center align-items-center">
                                    <input type="text" wire:model="comment.{{$post->id}}" class="form-control" id="title">
                                    <button type="submit" class="btn btn-primary">
                                        <img style="height: 20px;" src="{{asset('send.png')}}" alt="" srcset="">
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            @empty
            <div class="card mb-3">
                <div class="card-body">
                   <h5> No Posts Found!</h5>
                </div>
            </div>
            @endforelse
        </div>
    </div>

</div>
