<button
    x-data="{}"
    class="group flex items-center justify-center p-2"
    aria-label="Toggle dark mode"
    onclick="
                                        const isDark = document.documentElement.classList.toggle('dark');
                                        localStorage.setItem('theme', isDark ? 'dark' : 'light');
                                    "
>
    <x-lucide-sun class="block size-4 text-gray-400 group-hover:text-gray-600 dark:hidden" />
    <x-lucide-moon class="hidden size-4 text-gray-400 group-hover:text-gray-600 dark:block" />
</button>
