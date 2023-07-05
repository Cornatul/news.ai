@extends('marketing::layouts.app')

@section('title', __('Social Sharing Tumblr'))

@section('heading')
    {{ __('Social Sharing Tumblr') }}
@endsection

@section('content')
    <!-- The nav !-->
    @include('social::partials.nav')


    @if(session()->has('tumblr_access_token'))
      <div class="card">
          <div class="card-header">
              <h3 class="card-title">{{ __('Tumblr Share') }}</h3>
          </div>
          <div class="card-body">
              <form action="{{ route('social.tumblr.shareAction') }}" method="post">
                  @csrf
                  <div class="form-group">
                      <label for="title">{{ __('Title') }}</label>
                      <input type="text" name="title" id="title" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="title">{{ __('Tags') }}</label>
                      <small class="text-muted">
                          {{ __('Comma separated tags') }}
                        </small>
                      <input type="text" name="tags" id="title" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="title">{{ __('Image') }}</label>
                      <input type="text" name="image" id="title" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="content">{{ __('Content') }}</label>
                      <small class="text-muted">
                          {{ __('The content of the post in html format') }}
                        </small>
                      <textarea name="body" id="summernote" class="form-control" rows="5"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Share</button>
              </form>
          </div>
      </div>
    @else
        <!-- Cards !-->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Tumblr Login') }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('social.tumblr.login') }}" class="btn btn-info">
                            Login with Tumblr
                        </a>
                    </div>
                </div>
            </div>

        </div>
    @endif


@endsection
