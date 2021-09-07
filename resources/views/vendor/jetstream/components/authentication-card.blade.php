<div class="min-h-screen flex flex-col justify-center items-center 
            pt-6 sm:pt-0"
>
    <div class="">
        <div class="">
            <a style="font-family: 'Source Sans Pro', sans-serif;"
                class="toggleColour text-white no-underline hover:underline font-bold text-2xl lg:text-4xl" 
                href="{{ url('/') }}"
            >
                lipa utilities
            </a>
        </div>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-2xl overflow-hidden rounded-lg"
        style="font-family: 'Source Sans Pro', sans-serif;"
    >
        {{ $slot }}
    </div>
</div>
