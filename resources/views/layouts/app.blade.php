<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Brutal Blog Box')</title>
    @vite('resources/css/app.css')

    <style>
      @import url("https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap");
      body { 
        font-family: "Space Mono", monospace; 
      }
      
      /* Custom scrollbar */
      ::-webkit-scrollbar {
        width: 10px;
      }
      
      ::-webkit-scrollbar-track {
        background: var(--bg-color);
      }
      
      ::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 5px;
      }
      
      ::-webkit-scrollbar-thumb:hover {
        background: #555;
      }

      * {
        transition: background-color 0.2s ease, border-color 0.2s ease;
      }
    </style>
  </head>

  <script>
    // Auth check and redirection
    const publicPages = ['/login'];
    const currentPath = window.location.pathname;
    const loggedInUser = localStorage.getItem('username');

    if (!publicPages.includes(currentPath) && !loggedInUser) {
      window.location.href = '/login';
    }
  </script>

  <body class="bg-bgLight dark:bg-bgDark text-textLight dark:text-textDark transition-colors duration-200">

    @include('components.navbar')
    <main class="container mx-auto min-h-[70vh] px-4">
      @yield('content')
    </main>
    
    @include('components.footer')

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

      darkToggle.addEventListener("click", () => {
        const isDark = document.documentElement.classList.toggle("dark");
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        darkToggle.textContent = isDark ? "LIGHT" : "DARK";
      });

      applyTheme();

      preferDark.addEventListener('change', (e) => {
        if (!localStorage.getItem('theme')) {
          applyTheme();
        }
      });
    </script>
  </body>
</html>