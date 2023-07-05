@extends('marketing::layouts.app')

@section('title', __('Social Twitter'))

@section('heading')
    {{ __('Social Twitter') }}
@endsection

@section('content')
    <!-- The nav !-->
    @include('social::partials.nav')

    <div id="accordion">
        <!-- Trends card !-->
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                    aria-controls="collapseOne">
                        Trending Terms
                </h2>
            </div>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>{{ __('Query') }}</th>
                        <th>{{ __('Volume') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($trends as $item)
                        <tr>
                            <td>
                                <a href="{{ $item->url }}" target="_blank">
                                    {{ $item->name }}
                                </a>
                            </td>
                            <td>
                                <a href="#">
                                    {{ $item->tweet_volume }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>

        <!-- Share Card !-->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Twitter Share') }}</h3>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12">
                        <form action="{{ route('social.twitter.shareAction') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="title">{{ __('Url') }}</label>
                                <small class="form-text text-muted">
                                    {{ __('The url you want to share') }}
                                </small>
                                <input type="text" name="url" id="url" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="message">{{ __('Message') }}</label>
                                <small class="form-text text-muted">
                                    {{ __('The message you want to share - You can add even #tags') }}
                                </small>
                                <textarea name="message" id="message" class="form-control" rows="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Share</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>


@endsection
