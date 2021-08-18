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
                        Buy Electricity Tokens
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
                    <form class="w-full" action="{{ route('utility.lipa-na-mpesa') }}" method="POST">
                        @csrf
                        <div class="relative w-full mb-6">
                            <input type="text" class="rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" placeholder="Enter amout..." name="amount" required />
                        </div>
                        @foreach($u->utility->utilityPaymentMethods as $p)
                            @if($p->payment_method_name == 'M-Pesa')
                                <input hidden type="text" name="pbno" value="{{ \Illuminate\Support\Facades\Crypt::encryptString($p->lipa_na_mpesa_paybill) }}" required/>
                            @endif
                        @endforeach
                        <input hidden type="text" name="acc_ref" value="{{ \Illuminate\Support\Facades\Crypt::encryptString($u->kenya_power_meter_number) }}" required/>
                        <input hidden type="text" name="utility_id" value="{{ \Illuminate\Support\Facades\Crypt::encryptString($u->id) }}" required/>
                        <div>
                            <span class="block w-full rounded-md shadow-sm">
                                <input type="submit" class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg" value="PAY" />
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