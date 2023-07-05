@extends('marketing::layouts.app')

@section('title', __('Social Sharing Github'))

@section('heading')
    {{ __('Social Sharing Github') }}
@endsection

@section('content')
    <!-- The nav !-->
    @include('social::partials.nav')



    <!-- Cards !-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Github Gist') }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">

                    @if(session()->has('github_access_token'))
                        <form action="{{ route('social.github.shareAction') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title">{{ __('Title') }}</label>
                                <small class="text-muted">
                                    {{ __('The title of the gist.') }}
                                </small>
                                <input placeholder="Title" type="text" name="title" id="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="title">{{ __('Message') }}</label>
                                <small class="text-muted">
                                    {{ __('The content of the gist.') }}
                                </small>
                                <textarea name="message" id="content" rows="20" class="form-control" placeholder="Message"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Share</button>
                        </form>
                    @else

                        <a href="{{ route('social.github.login') }}" class="btn btn-primary">Login with Github</a>

                    @endif
                </div>
            </div>
        </div>

    </div>
    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
    <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
    <script>
        const easyMDE = new EasyMDE({element: document.getElementById('content')});
    </script>
@endsection
