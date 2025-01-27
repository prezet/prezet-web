<div
    x-data="{
        isLegacyVersion: {{ str_contains(request()->path(), 'v0.x') ? 'true' : 'false' }},
        switchVersion(isLegacy) {
            let currentPath = window.location.pathname;
            let newPath;
            
            if (isLegacy) {
                // If switching to v0.x, add it to the path if not already present
                if (!currentPath.includes('/v0.x/')) {
                    newPath = '/v0.x' + (currentPath === '/' ? '' : currentPath);
                }
            } else {
                // If switching to v1.0, remove v0.x from the path
                newPath = currentPath.replace('/v0.x', '');
            }
            
            if (newPath) {
                window.location.href = newPath;
            }
        }
    }"
    x-menu
    class="relative"
>
    <!-- Menu Button -->
    <button x-menu:button class="relative flex items-center whitespace-nowrap justify-center gap-2 py-2 rounded-lg shadow-sm bg-white hover:bg-gray-50 text-gray-800 border border-gray-200 hover:border-gray-200 px-4 text-sm">
        <span x-text="isLegacyVersion ? 'v0.x' : 'v1.0'"></span>

        <!-- Heroicon: micro chevron-down -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
            <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
        </svg>
    </button>

    <!-- Menu Items -->
    <div
        x-menu:items
        x-transition.origin.top.left
        class="absolute left-0 min-w-48 rounded-lg shadow-sm mt-2 z-10 origin-top-left bg-white divide-y divide-gray-200 outline-none border border-gray-200"
        x-cloak
    >
        <div class="p-1.5" role="group">
            <button
                x-menu:item
                type="button"
                @click="switchVersion(false)"
                :class="{
                    'bg-gray-50': !isLegacyVersion,
                    'opacity-50 cursor-not-allowed': $menuItem.isDisabled,
                }"
                class="px-2.5 py-1.5 w-full flex items-center rounded-md transition-colors focus:outline-none text-left text-gray-800"
            >
                v1.0
            </button>

            <button
                x-menu:item
                type="button"
                @click="switchVersion(true)"
                :class="{
                    'bg-gray-50': isLegacyVersion,
                    'opacity-50 cursor-not-allowed': $menuItem.isDisabled,
                }"
                class="px-2.5 py-1.5 w-full flex items-center rounded-md transition-colors focus:outline-none text-left text-gray-800"
            >
                v0.x
            </button>
        </div>
    </div>
</div>
