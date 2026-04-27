{{-- Shared minimal error page layout. Children supply: $code, $title, $message, $svg --}}
<!DOCTYPE html>
<html
  lang="en"
  class="light-style"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets') }}/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $code }} {{ $title }} | {{ config('app.name', 'Sneat') }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-misc.css') }}" />

    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
  </head>

  <body>
    <div class="container-xxl container-p-y">
      <div class="misc-wrapper text-center">
        <h1 class="mb-2 mx-2" style="font-size: 6rem; line-height: 1;">{{ $code }}</h1>
        <h4 class="mb-2 mx-2">{{ $title }} :(</h4>
        <p class="mb-4 mx-2">{{ $message }}</p>
        <a href="{{ url('/') }}" class="btn btn-primary mb-4">Back to home</a>
        <div class="mt-4">
          <img
            src="{{ asset('svg/' . $svg) }}"
            alt="{{ $code }} {{ $title }}"
            width="450"
            class="img-fluid"
          />
        </div>
      </div>
    </div>
  </body>
</html>
