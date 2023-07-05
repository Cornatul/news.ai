<ul class="nav nav-pills mb-4">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('social.linked') ? 'active'  : '' }}"
           href="{{ route('social.linkedin.index') }}">{{ __('LinkedIn') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('social.google') ? 'active'  : '' }}"
           href="{{ route('social.google.index') }}">{{ __('Google Business') }}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('social.twitter') ? 'active'  : '' }}"
           href="{{ route('social.twitter.index') }}">{{ __('Twitter') }}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('social.github') ? 'active'  : '' }}"
           href="{{ route('social.github.index') }}">{{ __('Github') }}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('social.medium') ? 'active'  : '' }}"
           href="{{ route('social.medium.index') }}">{{ __('Medium') }}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('social.devto') ? 'active'  : '' }}"
           href="{{ route('social.devto.index') }}">{{ __('DevTo') }}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('social.tumblr') ? 'active'  : '' }}"
           href="{{ route('social.tumblr.index') }}">{{ __('Tumblr') }}</a>
    </li>
</ul>
