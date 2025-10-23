<header class="container mx-auto my-7 px-4">
  <div class="flex flex-col md:flex-row justify-between items-center gap-4">
    <h1 class="text-3xl md:text-4xl font-bold tracking-tighter">BRUTAL BLOG BOX</h1>
    <nav>
      <ul class="flex flex-wrap justify-center items-center gap-2 md:gap-3">
        <li>
          <a class="border-2 border-borderLight dark:border-borderDark rounded-sm px-3 md:px-4 py-2 font-bold hover:bg-gray-100 dark:hover:bg-gray-800 transition {{ request()->routeIs('dashboard') ? 'bg-gray-200 dark:bg-gray-700' : '' }}" 
             href="{{ route('dashboard') }}">HOME</a>
        </li>
        <li>
          <a class="border-2 border-borderLight dark:border-borderDark rounded-sm px-3 md:px-4 py-2 font-bold hover:bg-gray-100 dark:hover:bg-gray-800 transition {{ request()->routeIs('pengelolaan') ? 'bg-gray-200 dark:bg-gray-700' : '' }}" 
             href="{{ route('pengelolaan') }}">PENGELOLAAN</a>
        </li>
        <li>
          <a class="border-2 border-borderLight dark:border-borderDark rounded-sm px-3 md:px-4 py-2 font-bold hover:bg-gray-100 dark:hover:bg-gray-800 transition {{ request()->routeIs('profile') ? 'bg-gray-200 dark:bg-gray-700' : '' }}" 
             href="{{ route('profile') }}">PROFILE</a>
        </li>
        <li>
          <button id="darkModeToggle" 
            class="border-2 border-borderLight dark:border-borderDark rounded-sm w-16 md:w-20 px-2 md:px-4 py-2 font-bold hover:bg-gray-100 dark:hover:bg-gray-800 transition">
            DARK
          </button>
        </li>
      </ul>
    </nav>
  </div>
</header>