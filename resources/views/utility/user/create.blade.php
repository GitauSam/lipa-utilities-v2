<x-dashboard-v2-layout>
    <div class="bg-white rounded-lg shadow sm:w-full sm:mx-auto sm:overflow-hidden">
        <div class="px-4 py-8 sm:px-10">
            <div class="relative mt-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300">
                    </div>
                </div>
                <div class="relative flex justify-center text-sm leading-5">
                    <span class="px-2 text-gray-500 bg-white">
                        Utility Information
                    </span>
                </div>
            </div>
            <div class="mt-6">

                @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>
                            <div x-show="failure_notif" class="notification-card notification-card-failure" x-cloak>
                                <p>{{ $error }}</p>
                                <i @click="failure_notif = false" class="far fa-window-close"></i>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="w-full space-y-6">
                    <form class="w-full" action="{{ route('utility.store') }}" method="POST">
                        @csrf
                        <div class="w-full mb-6">
                            <div class="relative">
                                <label class="text-gray-700" for="animals">
                                    Utility
                                    <select
                                        class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500" 
                                        name="user_utility"
                                        onchange="handleUtilityAccountNoInput(this)" 
                                        required
                                    >
                                        <option value="">Select Utility</option>
                                        @foreach($utilities as $utility)
                                        <option value="{{ \Illuminate\Support\Facades\Crypt::encryptString($utility->id) }}">{{ $utility->utility_name }}</option>
                                        @endforeach
                                    </select>
                                </label>

                            </div>
                        </div>
                        <div id="kenya_power_meter_number_container" style="display: none;" class="w-full mb-6">
                            <div class="relative w-full">
                                <input type="text" id="kenya_power_meter_number_input" class="rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="Meter Number" name="kp_meter_number" required />
                            </div>
                        </div>
                        <div>
                            <span class="block w-full rounded-md shadow-sm">
                                <input type="submit" class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg" value="SAVE" />
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="px-4 py-6 border-t-2 border-gray-200 bg-gray-50 sm:px-10">
            <p class="text-xs leading-5 text-gray-500">
                The data is protected by lu-sec algorithm
            </p>
        </div>
    </div>
</x-dashboard-v2-layout>