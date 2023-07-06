<div class="flex-1 flex flex-col min-h-screen max-h-screen w-full">

    <div id="message-container" class="px-4 pt-4 h-full grow bg-gray-900 text-gray-100 overflow-y-auto"></div>

    <form id="ChatForm" method="POST" onsubmit="sendMessage(event);">
        <div class="relative bg-gray-800 px-4 py-4 flex">
            <div class="flex-1 flex gap-2">
                <input name="message" type="text" autocomplete="off" id="message" class="resize-none flex-grow px-3 py-2 bg-gray-700 text-gray-100 border border-gray-600 rounded focus:outline-0" placeholder="Type a message..." required />
            </div>
            <button type="submit" class="absolute right-4 p-[13px] rounded dark:disabled:hover:bg-transparent disabled:text-gray-400 enabled:bg-brand-purple text-white disabled:opacity-40">
                <span class="" data-state="closed">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="gray" class="h-4 w-4 " stroke-width="2">
                        <path class="" d="M.5 1.163A1 1 0 0 1 1.97.28l12.868 6.837a1 1 0 0 1 0 1.766L1.969 15.72A1 1 0 0 1 .5 14.836V10.33a1 1 0 0 1 .816-.983L8.5 8 1.316 6.653A1 1 0 0 1 .5 5.67V1.163Z" />
                    </svg>
                </span>
            </button>
        </div>
    </form>

</div>