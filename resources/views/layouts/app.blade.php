<?php $current = \Route::currentRouteName() ?? 'home';
if($current == 'login') $title = __('Login');
if($current == 'register') $title = __('Register');
$params = [];
if(request()->id) $params['id'] = request()->id;
$metaDescription = @$description ? __($description) : __("If you want to learn something new - start your project.").' '.__("Community support keeps you motivated and helps you find new ideas.").' '.__("Share your experience and gain even more.");
$metaTitle = (@$title ? __($title).' | ' : '') . config('app.name', 'New project');
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ $metaTitle }}</title>
  <meta name="description" content="{{ $metaDescription }}">
  <meta property="og:url" content="{{ route($current, array_merge($params, ['locale' => app()->getLocale()])) }}" />
  <meta property="og:type" content="article" />
  <meta property="og:title" content="{{ $metaTitle }}" />
  <meta property="og:description" content="{{ $metaDescription }}" />
  <meta property="og:image" content="{{ asset('images/logo.png') }}"/>
  <meta property="og:image:secure_url" content="{{ str_replace('https', 'http', asset('images/logo.png')) }}" />
  <meta property="og:image:type" content="image/png" />
  <meta name="image" content="{{ asset('images/logo.png')}}" property="og:image" />

  <link rel="canonical" href="{{ $current == 'home' ? url('/') : route($current, array_merge($params, ['locale' => 'en'])) }}" />
  <link rel="alternate" hreflang="en" href="{{ route($current, array_merge($params, ['locale' => 'en'])) }}" />
  <link rel="alternate" hreflang="ru" href="{{ route($current, array_merge($params, ['locale' => 'ru'])) }}" />
  <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120-precomposed.png" /> 
  <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152-precomposed.png" />
  <!-- Scripts -->
  @auth
  <script>
    window.apiToken = '{{ \Auth::user()->api_token }}'
  </script>
  @endauth
  <script src="{{ asset('js/app.js') }}"></script>
  @yield('head-scripts')

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

  <link rel="preload" href="{{ asset('css/app.css') }}" as="style" type="text/css">
  <link rel="preload" href="{{ asset('css/custom.css') }}" as="style" type="text/css">
  <link rel="preload" href="{{ asset('js/app.js') }}" as="script" type="text/javascript">
  <link rel="preload" href="{{ asset('js/jquery.min.js') }}" as="script" type="text/javascript">
  <link rel="preload" href="{{ asset('js/bootstrap.min.js') }}" as="script" type="text/javascript">
  <link rel="{{ $current == 'home' ? 'preload' : 'prefetch' }}" href="{{ asset('images/logo.png') }}" as="image" type="image/png">
  <link rel="{{ $current == 'home' ? 'preload' : 'prefetch' }}" href="{{ asset('images/beginner.jpg') }}" as="image" type="image/jpeg">
  <link rel="{{ $current == 'home' ? 'preload' : 'prefetch' }}" href="{{ asset('images/expert.jpg') }}" as="image" type="image/jpeg">
</head>
<body class="bg-white">
  <nav class="navbar navbar-expand-md navbar-light shadow">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}" itemprop="url">
        <span itemprop="name">{{ config('app.name', 'Laravel') }}</span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto py-3 py-md-0">
          <form action="{{ route('search', app()->getLocale()) }}" class="ml-md-4 input-group" autocomplete="off" id="search-form">
            <input type="text" class="form-control" name="q" placeholder="{{ __("Let's search anything") }}..." value="{{ \Request::get('q') }}">
            <input type="hidden" value="" name="tab" id="search-tab-input">
            <div class="input-group-append">
              <button class="input-group-text bg-primary">
                <img src="/images/icons/search.svg" alt="Search" height="15">
              </button>
            </div>
          </form>
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mr-md-4">
            <a href="{{ route('blog', app()->getLocale()) }}" class="nav-link" itemprop="url">
              <span itemprop="name">{{ __('Blog') }}</span>
            </a>
          </li>
          <li class="nav-item mr-md-4">
            <a href="{{ route('projects', app()->getLocale()) }}" class="nav-link" itemprop="url">
              <span itemprop="name">{{ __('Projects') }}</span>
            </a>
          </li>
          @guest
          <li class="nav-item mr-md-3">
            <a class="nav-link" href="{{ route('login', app()->getLocale()) }}" itemprop="url">
              <span itemprop="name">{{ __('Login') }}</span>
            </a>
          </li>
          @if (Route::has('register'))
          <li class="nav-item mr-md-4">
            <a class="nav-link" href="{{ route('register', app()->getLocale()) }}" itemprop="url">
              <span itemprop="name">{{ __('Register') }}</span>
            </a>
          </li>
          @endif
          @else
          <li class="nav-item mr-md-4 dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('profile', app()->getLocale()) }}" itemprop="url">
                <span itemprop="name">{{ __('Profile') }}</span>
              </a>
              <a class="dropdown-item" href="{{ route('profile.settings', app()->getLocale()) }}" itemprop="url">
                <span itemprop="name">{{ __('Settings') }}</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout', app()->getLocale()) }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </li>
          @endguest
          <li class="nav-item d-flex align-items-center">
            <a class="nav-link {{ app()->getLocale() == 'ru' ? 'underline' : '' }}" href="{{ route($current, array_merge($params, ['locale' => 'ru'])) }}">
              RU
            </a>
            <div class="nav-text">/</div>
            <a class="nav-link {{ app()->getLocale() == 'en' ? 'underline' : '' }}" href="{{ route($current, array_merge($params, ['locale' => 'en'])) }}">
              EN
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main>
    @yield('content')
  </main>
  <footer class="py-5 bg-secondary">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="mb-2">
            <a class="text-white" href="{{ route('home', app()->getLocale()) }}">{{ __('Home') }}</a>
          </div>
          <div class="mb-2">
            <a class="text-white" href="{{ route('projects', app()->getLocale()) }}">{{ __('Projects') }}</a>
          </div>
          <div class="mb-2">
            <a class="text-white" href="{{ route('blog', app()->getLocale()) }}">{{ __('Blog') }}</a>
          </div>
        </div>
        <div class="col-sm-6 d-flex justify-content-end">
          <a class="text-white {{ app()->getLocale() == 'ru' ? 'underline' : '' }}" href="{{ route($current, array_merge($params, ['locale' => 'ru'])) }}">RU</a>
          <div class="mx-2 text-white">/</div>
          <a class="text-white {{ app()->getLocale() == 'en' ? 'underline' : '' }}" href="{{ route($current, array_merge($params, ['locale' => 'en'])) }}">EN</a>
        </div>
      </div>
    </div>
  </footer>
  <script type="application/ld+json">
    {
      "@context" : "http://schema.org",
      "@type" : "Organization",
      "name" : "New project",
      "url" : "{{ url('/') }}",
      "logo": "{{ asset('images/logo.png') }}",
      "brand": "ToU",
      "description": "{{$metaDescription }}",
      "image": "{{ asset('images/logo.png') }}",
      "sameAs" : [
      "{{config('app.contact.facebook')}}",
      "{{config('app.contact.instagram')}}",
      "{{config('app.contact.youtube')}}",
      "{{config('app.contact.linkedin')}}",
      "{{config('app.contact.twitter')}}"
      ],
      "address": {
      "@type": "PostalAddress",
      "streetAddress": "",
      "addressRegion": "Pavlodar",
      "postalCode": "14000",
      "addressCountry": "Kazakhstan"
    }
  }
</script>
<script type="application/ld+json">
  {
    "@context": "https://schema.org/", 
    "@type": "BreadcrumbList", 
    "itemListElement": [{
    "@type": "ListItem", 
    "position": 1, 
    "name": "New project",
    "item": "{{ url('/') }}"  
  },{
  "@type": "ListItem", 
  "position": 2, 
  "name": "{{ $metaTitle }}",
  "item": "{{ route($current, array_merge($params, ['locale' => app()->getLocale()])) }}"  
}]
}
</script>
<script type="application/ld+json">
  {
    "@context": "https://schema.org/",
    "@type": "WebSite",
    "name": "New project",
    "url": "{{ url('/') }}",
    "potentialAction": [{
    "@type": "SearchAction",
    "target": "{{ url('/') }}/search{search_term_string}",
    "query-input": "required q=search_term_string"
  }]
}
</script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
@yield('scripts')
</body>
</html>
