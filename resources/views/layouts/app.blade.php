<!doctype html>
<html lang="en" class="scroll-smooth">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JurnalApp</title>

    <style>
      html { scroll-behavior: smooth; }
      :root {
        --bg: #f8fafc;
        --card: #ffffff;
        --text: #0f172a;
        --muted: #6b7280;
        --border: #e5e7eb;
        --primary: #4f46e5;
        --primary-foreground: #ffffff;
        --muted-2: #9ca3af;
        --hero-from: #eef2ff;
        --hero-to: #ffffff;   
      }
      html.dark {
        --bg: #07111a;           
        --card: #0f1b2b;        
        --text: #e7f0fb;         
        --muted: #9fb0c4;        
        --border: #112231;       
        --primary: #7c3aed;      
        --primary-foreground: #ffffff;
        --muted-2: #6b7280;
        --hero-from: rgba(6,10,16,0.6);
        --hero-to: rgba(5,7,11,0.88);
      }

 
      body { background-color: var(--bg); color: var(--text); transition: background-color 250ms ease, color 250ms ease; }
      .bg-white { background-color: var(--card) !important; transition: background-color 250ms ease; }
      .bg-gray-50 { background-color: var(--bg) !important; }
      .bg-gray-100 { background-color: rgba(255,255,255,0.02) !important; }
      .bg-gray-200 { background-color: rgba(255,255,255,0.03) !important; }
      .bg-gray-300 { background-color: rgba(255,255,255,0.04) !important; }
      .bg-gray-800 { background-color: rgba(255,255,255,0.02) !important; }

    
      .text-gray-900, .text-gray-800 { color: var(--text) !important; }
      .text-gray-700, .text-gray-600, .text-gray-500, .text-gray-400 { color: var(--muted) !important; }
      .text-indigo-600, .text-indigo-700 { color: var(--primary) !important; }


      .border-gray-200, .border-gray-300, .border-gray-100, .border { border-color: var(--border) !important; }
      .bg-indigo-600 { background-color: var(--primary) !important; }
      .text-white { color: var(--primary-foreground) !important; }
      .shadow { box-shadow: 0 6px 18px rgba(2,6,23,0.4); }


      input, textarea, select, .form-control {
        background-color: var(--card) !important;
        color: var(--text) !important;
        border: 1px solid var(--border) !important;
      }

      .bg-card { background-color: var(--card) !important; transition: background-color 250ms ease; }
      a { color: var(--primary) !important; }
      .btn { background-color: var(--primary) !important; color: var(--primary-foreground) !important; }


      table, th, td { color: var(--text) !important; }
      th, td { border-color: var(--border) !important; }


      * { transition: background-color 220ms ease, color 220ms ease, border-color 220ms ease; }
      .hero-bg { background: linear-gradient(to right, var(--hero-from), var(--hero-to)); }
      .soft-card {
        background-color: rgba(255,255,255,0.94);
        border: 1px solid rgba(15,23,42,0.04);
        box-shadow: 0 10px 30px rgba(15,23,42,0.06);
        transition: background-color 220ms ease, box-shadow 220ms ease, border-color 220ms ease;
      }
      html.dark .soft-card {
        background-color: rgba(15,27,40,0.52);
        border: 1px solid rgba(255,255,255,0.03);
        box-shadow: 0 8px 24px rgba(2,6,23,0.55);
      }
    </style>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
      @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else

      <script src="https://cdn.tailwindcss.com"></script>
      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif
  </head>
  <body class="bg-gray-50 text-gray-900 min-h-screen">
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <div class="flex items-center space-x-4">
            <a href="{{ url('/welcome') }}" class="flex items-center gap-3">
              <svg class="h-9 w-9" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <defs>
                  <linearGradient id="g1" x1="0" x2="1">
                    <stop offset="0" stop-color="#6366F1"/>
                    <stop offset="1" stop-color="#06B6D4"/>
                  </linearGradient>
                </defs>
                <rect x="4" y="6" width="30" height="36" rx="2" fill="url(#g1)" opacity="0.12" />
                <path d="M8 10h22v4H8z" fill="#EEF2FF" />
                <path d="M8 16h22v4H8z" fill="#E0F2FE" />
                <path d="M36 8h4v32h-4z" fill="#0EA5A4" opacity="0.9" />
                <path d="M10 26h16v2H10z" fill="#A78BFA" opacity="0.9" />
                <path d="M10 30h12v2H10z" fill="#7DD3FC" opacity="0.9" />
              </svg>
              <span class="text-lg font-semibold text-gray-900">JurnalApp</span>
            </a>
          </div>

          <div class="flex items-center space-x-3">
            <button id="theme-toggle" type="button" aria-label="Toggle theme" class="p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-800">
              <svg id="theme-toggle-light-icon" class="w-5 h-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <circle cx="12" cy="12" r="4" />
                <path d="M12 2v2" />
                <path d="M12 20v2" />
                <path d="M4.93 4.93l1.41 1.41" />
                <path d="M17.66 17.66l1.41 1.41" />
                <path d="M2 12h2" />
                <path d="M20 12h2" />
                <path d="M4.93 19.07l1.41-1.41" />
                <path d="M17.66 6.34l1.41-1.41" />
              </svg>
              <svg id="theme-toggle-dark-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 116.707 2.707 8 8 0 0017.293 13.293z"/></svg>
            </button>

            @guest
              <a href="{{ route('login') }}" class="px-3 py-2 bg-indigo-600 text-white text-sm rounded">Login</a>
              <a href="{{ route('register') }}" class="px-3 py-2 border border-indigo-600 text-indigo-600 text-sm rounded">Register</a>
            @endguest

            @auth
              <div class="hidden sm:flex items-center gap-3">
                <a href="{{ route('profile') }}" class="text-sm text-gray-700 hover:underline">{{ auth()->user()->name ?? auth()->user()->email }}</a>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="px-3 py-2 bg-red-600 text-white text-sm rounded">Logout</button>
                </form>
              </div>
            @endauth
          </div>
        </div>
      </div>
    </header>

    <main class="max-w-7xl mx-auto p-4">
      <div id="page-wrapper" class="transition-all duration-700 ease-out opacity-0 -translate-y-4"> 
      @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-50 border border-green-200 text-green-800">{{ session('success') }}</div>
      @endif

      @yield('content')
      </div>
    </main>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        var el = document.getElementById('page-wrapper');
        if (!el) return;
        requestAnimationFrame(function () {
          el.classList.remove('opacity-0','-translate-y-4');
          el.classList.add('opacity-100','translate-y-0');
        });

        (function(){
          var toggle = document.getElementById('theme-toggle');
          if (!toggle) return;
          var lightIcon = document.getElementById('theme-toggle-light-icon');
          var darkIcon = document.getElementById('theme-toggle-dark-icon');

          function showIcons(theme){
            if (theme === 'dark'){
              if (darkIcon) darkIcon.classList.remove('hidden');
              if (lightIcon) lightIcon.classList.add('hidden');
            } else {
              if (lightIcon) lightIcon.classList.remove('hidden');
              if (darkIcon) darkIcon.classList.add('hidden');
            }
          }

          function applyTheme(t){
            if (t === 'dark') document.documentElement.classList.add('dark');
            else document.documentElement.classList.remove('dark');
            showIcons(t);
          }

          var stored = localStorage.getItem('theme');
          if (stored) applyTheme(stored);
          else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) applyTheme('dark');
          else applyTheme('light');

          toggle.addEventListener('click', function(){
            var isDark = document.documentElement.classList.contains('dark');
            var next = isDark ? 'light' : 'dark';
            applyTheme(next);
            localStorage.setItem('theme', next);
          });
        })();
      });
    </script>
    @stack('scripts')
  </body>
</html>