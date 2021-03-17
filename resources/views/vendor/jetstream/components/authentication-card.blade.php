<div 
    style="background: linear-gradient(to bottom, #d9fcf5, #a8effa);"
    class="min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0"
>
    <!-- <div>
        {{-- $logo --}}
    </div> -->

    <div class="nav-content nav-content-sm">
        <div class="nav-content-logo nav-content-logo-sm">
            <a href="{{ url('/') }}">Lipia Utilities</a>
        </div>
        <div class="nav-content-links nav-content-links-sm">
        </div>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-lg overflow-hidden rounded-lg authentication-card">
        {{ $slot }}
    </div>
</div>
