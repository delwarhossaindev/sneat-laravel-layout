<!DOCTYPE html>
@php $userTheme = auth()->user()?->theme ?? 'light'; @endphp
<html
  lang="en"
  class="light-style layout-menu-fixed {{ $userTheme === 'dark' ? 'dark-mode' : '' }}"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets') }}/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>@yield('title', 'Dashboard') | {{ config('app.name', 'Sneat') }}</title>

    <meta name="description" content="@yield('description', '')" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    {{-- Icons --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    {{-- Core CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/dark-mode.css') }}" />

    {{-- Vendors CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    {{-- Page CSS --}}
    @stack('page-css')

    {{-- Helpers --}}
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
  </head>

  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">

        @include('layouts.partials.sidebar')

        <div class="layout-page">

          @include('layouts.partials.navbar')

          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              @yield('content')
            </div>

            @include('layouts.partials.footer')

            <div class="content-backdrop fade"></div>
          </div>
        </div>
      </div>

      <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    @include('layouts.partials.toasts')

    {{-- Core JS --}}
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    {{-- Vendors JS --}}
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    {{-- Main JS --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>

    {{-- Center active sidebar menu item on load --}}
    <script>
      (function () {
        function centerActiveMenuItem() {
          var menuInner = document.querySelector('#layout-menu .menu-inner');
          if (!menuInner) return;
          var actives = menuInner.querySelectorAll('li.menu-item.active');
          if (!actives.length) return;
          // Pick the deepest active (leaf). Parents have `.active.open`; leaf is just `.active`.
          var leaf = menuInner.querySelector('li.menu-item.active:not(.open)') || actives[actives.length - 1];
          var link = leaf.querySelector(':scope > .menu-link') || leaf;
          var offsetTop = link.getBoundingClientRect().top - menuInner.getBoundingClientRect().top + menuInner.scrollTop;
          var target = offsetTop - (menuInner.clientHeight / 2) + (link.offsetHeight / 2);
          target = Math.max(0, Math.min(target, menuInner.scrollHeight - menuInner.clientHeight));
          menuInner.scrollTop = target;
          if (window.PerfectScrollbar && menuInner.querySelector('.ps__rail-y')) {
            menuInner.dispatchEvent(new Event('ps-scroll-y'));
          }
        }
        if (document.readyState === 'loading') {
          document.addEventListener('DOMContentLoaded', function () { setTimeout(centerActiveMenuItem, 50); });
        } else {
          setTimeout(centerActiveMenuItem, 50);
        }
      })();
    </script>

    {{-- Theme toggle --}}
    <script>
      (function () {
        var btn = document.getElementById('themeToggle');
        if (!btn) return;
        btn.addEventListener('click', function () {
          var html = document.documentElement;
          var isDark = html.classList.toggle('dark-mode');
          var icon = btn.querySelector('i');
          if (icon) icon.className = isDark ? 'bx bx-sun fs-4 lh-0' : 'bx bx-moon fs-4 lh-0';
          fetch('{{ route('preferences.theme') }}', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
              'Accept': 'application/json'
            },
            body: JSON.stringify({ theme: isDark ? 'dark' : 'light' })
          });
        });
      })();
    </script>

    {{-- Page JS --}}
    @stack('page-js')

    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
