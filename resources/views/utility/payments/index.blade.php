<x-dashboard-v2-layout>
    <div class="flex flex-col mx-auto w-full items-center justify-center">
        <div class="px-4 py-5 sm:px-6 w-full border dark:bg-gray-800 bg-white shadow mb-2 rounded-md">
            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">
                Utility Payments
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-200">
                View all your utility payments below.
            </p>
        </div>
        <ul class="flex flex-col w-full">
            @forelse($userUtilityPayments as $u)
            <li class="border-gray-400 flex flex-row mb-2">
                <div class="transition duration-500 shadow ease-in-out transform hover:-translate-y-1 hover:shadow-lg select-none cursor-pointer bg-white dark:bg-gray-800 rounded-md flex flex-1 items-center p-4">
                    <div class="flex-1 flex flex-col pl-1 md:mr-16">
                        <div class="font-semibold text-xl dark:text-white">
                            {{ $u->transactionLog->userUtility->utility->utility_name }}
                        </div>
                        <table>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr>
                                <td class="font-semibold">Amount</td>
                                <td>Kes. {{ $u->amount_paid }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold">Date</td>
                                <td>{{ Illuminate\Support\Carbon::parse($u->payment_date)->format(config('services.general.month_date_year_format')) }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold">Status</td>
                                <td>
                                    @if($u->transactionLog->mpesa_callback_result_code == '1032')
                                        Cancelled by user
                                    @elseif($u->transactionLog->mpesa_callback_result_code == '0')
                                        Successful
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </li>
            @empty
            <li class="border-gray-400 flex flex-row mb-2">
                <div class="transition duration-500 shadow ease-in-out transform hover:-translate-y-1 hover:shadow-lg select-none cursor-pointer bg-white dark:bg-gray-800 rounded-md flex flex-1 items-center p-4">
                    <div class="flex-1 pl-1 md:mr-16">
                        <div class="text-gray-600 dark:text-gray-200 text-sm">
                            You have not made any payments yet.
                        </div>
                    </div>
                </div>
            </li>
            @endforelse
        </ul>
    </div>
</x-dashboard-v2-layout>