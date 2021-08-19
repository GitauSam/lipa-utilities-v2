<ul class="flex flex-col w-full">
    @forelse($userUtilities as $u)
    <li class="border-gray-400 flex flex-row mb-2">
        <div class="transition duration-500 shadow ease-in-out transform hover:-translate-y-1 hover:shadow-lg select-none cursor-pointer bg-white dark:bg-gray-800 rounded-md flex flex-1 items-center p-4">
            <!-- <div class="flex flex-col w-10 h-10 justify-center items-center mr-4">
                <a href="#" class="block relative">
                    <img alt="profil" src="/images/person/6.jpg" class="mx-auto object-cover rounded-full h-10 w-10 " />
                </a>
            </div> -->
            <div class="flex-1 pl-1 md:mr-16">
                <div class="font-medium dark:text-white">
                    {{ $u->utility->utility_name }}
                </div>
                <!-- <div class="text-gray-600 dark:text-gray-200 text-sm">
                    Developer
                </div> -->
            </div>
            <!-- <button class="w-24 text-right flex justify-end">
                        <svg width="12" fill="currentColor" height="12" class="hover:text-gray-800 dark:hover:text-white dark:text-gray-200 text-gray-500" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1363 877l-742 742q-19 19-45 19t-45-19l-166-166q-19-19-19-45t19-45l531-531-531-531q-19-19-19-45t19-45l166-166q19-19 45-19t45 19l742 742q19 19 19 45t-19 45z">
                            </path>
                        </svg>
                    </button> -->
            <div class="flex flex-col">
                @foreach($u->utility->utilityPaymentMethods as $pm)
                @if($pm->payment_method_name == 'M-Pesa' && $pm->status == 1)
                <a class="model-btn bg-green-500 hover:bg-green-800 m-2 py-1 px-2 text-white rounded" href="{{ route('utility.lipa-na-mpesa.get', \Illuminate\Support\Facades\Crypt::encryptString($u->id)) }}">
                    Pay with {{ $pm->payment_method_name }}
                </a>
                @elseif($pm->payment_method_name == 'Equitel' && $pm->status == 1)
                <a class="model-btn bg-yellow-600 hover:bg-yellow-800 m-2 py-1 px-2 text-white rounded" href="{{ route('utility.edit', \Illuminate\Support\Facades\Crypt::encryptString($u->id)) }}">
                    Pay with {{ $pm->payment_method_name }}
                </a>
                @elseif($pm->payment_method_name == 'Card' && $pm->status == 1)
                <a class="model-btn bg-pink-600 hover:bg-pink-800 m-2 py-1 px-2 text-white rounded" href="{{ route('utility.edit', \Illuminate\Support\Facades\Crypt::encryptString($u->id)) }}">
                    Pay with {{ $pm->payment_method_name }}
                </a>
                @elseif($pm->payment_method_name == 'Paypal' && $pm->status == 1)
                <a class="model-btn bg-blue-600 hover:bg-blue-800 m-2 py-1 px-2 text-white rounded" href="{{ route('utility.edit', \Illuminate\Support\Facades\Crypt::encryptString($u->id)) }}">
                    Pay with {{ $pm->payment_method_name }}
                </a>
                @endif
                @endforeach
                <div class="flex flex-col sm:flex-row gap-y-2 mx-2 sm:m-0 sm:px-2 text-white text-center">
                    <a class="model-btn bg-blue-600 hover:bg-blue-800 sm:flex-1 py-1 sm:mr-1 rounded" href="{{ route('utility.edit', \Illuminate\Support\Facades\Crypt::encryptString($u->id)) }}">
                        Edit
                    </a>
                    <a href="#" class="model-btn bg-red-500 hover:bg-red-800 sm:flex-1 py-1 sm:ml-1 rounded">
                        Delete
                    </a>
                <div>
            </div>
        </div>
    </li>
    @empty
    <li class="border-gray-400 flex flex-row mb-2">
        <div class="transition duration-500 shadow ease-in-out transform hover:-translate-y-1 hover:shadow-lg select-none cursor-pointer bg-white dark:bg-gray-800 rounded-md flex flex-1 items-center p-4">
            <div class="flex-1 pl-1 md:mr-16">
                <div class="text-gray-600 dark:text-gray-200 text-sm">
                    There are no utilities present in our store.
                </div>
            </div>
        </div>
    </li>
    @endforelse
    {{ $userUtilities->links() }}
</ul>