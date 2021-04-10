<div class="min-h-screen flex flex-col justify-center items-center 
            pt-6 sm:pt-0 authentication-card"
>
    <!-- <div>
        {{-- $logo --}}
    </div> -->

    <div class="nav-content nav-content-sm">
        <div class="nav-content-logo nav-content-logo-sm">
            <a href="{{ url('/') }}">lipa utilities</a>
        </div>
        <div class="nav-content-links nav-content-links-sm">
        </div>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-lg overflow-hidden rounded-lg authentication-card">
        {{ $slot }}
    </div>
</div>
