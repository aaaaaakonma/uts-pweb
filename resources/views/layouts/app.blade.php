<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Brutal Blog Box')</title>
    @vite('resources/css/app.css')
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap");
      body { font-family: "Space Mono", monospace; }
    </style>
  </head>

  <script>
    const publicPages = ['/login'];
    const currentPath = window.location.pathname;
    const loggedInUser = localStorage.getItem('username');

    if (!publicPages.includes(currentPath) && !loggedInUser) {
      window.location.href = '/login';
    }
  </script>

  <body class="bg-bgLight dark:bg-bgDark text-textLight dark:text-textDark transition-colors duration-200">
    <header class="container mx-auto my-7">
      <div class="flex justify-between items-center">
        <h1 class="text-4xl font-bold tracking-tighter">BRUTAL BLOG BOX</h1>
        <nav>
          <ul class="flex space-x-3">
            <li><a class="border-2 border-borderLight dark:border-borderDark rounded-sm px-4 py-2 font-bold" href="{{ route('dashboard') }}">HOME</a></li>
            <li><a class="border-2 border-borderLight dark:border-borderDark rounded-sm px-4 py-2 font-bold" href="{{ route('pengelolaan') }}">PENGELOLAAN</a></li>
            <li><a class="border-2 border-borderLight dark:border-borderDark rounded-sm px-4 py-2 font-bold" href="{{ route('profile') }}">PROFILE</a></li>
            <button id="darkModeToggle" class="border-2 border-borderLight dark:border-borderDark rounded-sm w-20 px-4 py-1 font-bold">DARK</button>
          </ul>
        </nav>
      </div>
    </header>

    <main class="container mx-auto min-h-[70vh]">
      @yield('content')
    </main>

    <footer class="container mx-auto mt-16 mb-8 text-sm">
      <div class="border-2 border-borderLight dark:border-borderDark rounded-sm p-2">
        <div class="flex justify-between items-center">
          <p>© {{ date('Y') }} BRUTAL BLOG BOX. NO RIGHTS RESERVED.</p>
          <p>BUILT WITH HTML AND RAGE</p>
        </div>
      </div>
    </footer>

    @yield('scripts')

    <script>
      const darkToggle = document.getElementById("darkModeToggle");
      const preferDark = window.matchMedia("(prefers-color-scheme: dark)");

      function applyTheme() {
        const currentTheme = localStorage.getItem('theme');
        if (currentTheme === 'dark' || (!currentTheme && preferDark.matches)) {
          document.documentElement.classList.add('dark');
          darkToggle.textContent = "LIGHT";
        } else {
          document.documentElement.classList.remove('dark');
          darkToggle.textContent = "DARK";
        }
      }

      darkToggle.addEventListener("mousedown", () => {
        const isDark = document.documentElement.classList.toggle("dark");
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        darkToggle.textContent = isDark ? "LIGHT" : "DARK";
      });

      applyTheme();
    </script>
  </body>
</html>
