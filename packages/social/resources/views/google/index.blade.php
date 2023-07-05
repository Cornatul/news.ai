@extends('marketing::layouts.app')

@section('title', __('Google My Business Sharing Tool'))

@section('heading')
    {{ __('Google My Business') }}
@endsection

@section('content')
    <!-- The nav !-->
    @include('social::partials.nav')



    <!-- Cards !-->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('Google My Business') }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                @if(session()->has('google_access_token'))
                    <div class="col-md-12">
                        <form action="{{ route('social.linkedin.shareAction') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title">{{ __('Title') }}</label>
                                <input type="text" name="title" id="title" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="title">{{ __('Image') }}</label>
                                <input type="text" name="image" id="url" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="title">{{ __('Url') }}</label>
                                <input type="text" name="url" id="url" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="message">{{ __('Summary') }}</label>
                                <textarea name="summary" id="summary" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="message">{{ __('Message') }}</label>
                                <textarea name="message" id="message" class="form-control" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Share</button>
                        </form>

                    </div>
                @else
                <div class="col-md-12">
                    <a href="{{ route('social.google.login') }}" class="btn btn-info">
                        Login with Google
                    </a>
                </div
                @endif
            </div>
        </div>

    </div>
@endsection
