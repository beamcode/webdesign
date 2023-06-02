<div class="flex flex-col h-screen min-w-[350px]">
    <div class="flex-1 bg-gray-900 text-gray-100 px-6 py-4 overflow-y-scroll">
        <div class="max-w-lg mx-auto">
            <div class="flex items-start mb-4">
                <div class="w-10 h-10 bg-gray-700 rounded-full"></div>
                <div class="ml-4 flex-1">
                    <div class="w-1/2 h-3 bg-gray-700 rounded"></div>
                    <div class="mt-1 w-3/4 h-3 bg-gray-700 rounded"></div>
                </div>
            </div>
            <div class="flex items-start mb-4">
                <div class="w-10 h-10 bg-gray-700 rounded-full"></div>
                <div class="ml-4 flex-1">
                    <div class="w-3/4 h-3 bg-gray-700 rounded"></div>
                    <div class="mt-1 w-2/4 h-3 bg-gray-700 rounded"></div>
                </div>
            </div>
            <div class="flex items-start mb-4">
                <div class="w-10 h-10 bg-gray-700 rounded-full"></div>
                <div class="ml-4 flex-1">
                    <div class="w-2/4 h-3 bg-gray-700 rounded"></div>
                    <div class="mt-1 w-3/4 h-3 bg-gray-700 rounded"></div>
                </div>
            </div>
            <!-- Add more chat messages here -->
        </div>
    </div>

    <div class="bg-gray-800 px-4 py-4 flex">
        <input type="text" id="messageInput" class="w-full px-3 py-2 bg-gray-700 text-gray-100 border border-gray-600 rounded focus:outline-0" placeholder="Type a message..." required>
        <button id="submitButton" class="absolute right-5 bottom-5 p-[10px] py-[9px] rounded dark:hover:bg-gray-900 dark:disabled:hover:bg-transparent disabled:text-gray-400 enabled:bg-brand-purple text-white disabled:opacity-40 {{!$text ? 'bg-gray-800' : 'bg-green-500'}}">
            <span class="" data-state="closed">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="none" class="h-4 w-4 " stroke-width="2">
                    <path class="" d="M.5 1.163A1 1 0 0 1 1.97.28l12.868 6.837a1 1 0 0 1 0 1.766L1.969 15.72A1 1 0 0 1 .5 14.836V10.33a1 1 0 0 1 .816-.983L8.5 8 1.316 6.653A1 1 0 0 1 .5 5.67V1.163Z">
                    </path>
                </svg>
            </span>
        </button>
    </div>
</div>