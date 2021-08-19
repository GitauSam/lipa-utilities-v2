<x-app-beta> 
    <x-slot name="links">
        @if(auth()->user()->hasRole(config('services.general.user_role')))
            <div class="link">
                <a href="{{ route('utility.index') }}">View Utilities</a>
            </div>
            <div class="link">
                <a href="{{ route('utility.create') }}">Add Utility</a>
            </div>
        @else
            <div class="link">
                <a href="{{ route('admin.utility.index') }}">View Utilities</a>
            </div>
            <div class="link">
                <a href="{{ route('admin.utility.create') }}">Add Utility</a>
            </div>
        @endif
    </x-slot>
    <x-slot name="games">
        <div class="games">
            <div class="status">
                <h1>View Payments</h1>
            </div>
            @if(session('success_notif'))
                <div x-show="success_notif" class="notification-card notification-card-success" x-cloak>
                    <p>{{ session('success_notif') }}</p>
                    <i @click="success_notif = false" class="far fa-window-close"></i>
                </div>
            @elseif(session('failure_notif'))
                <div x-show="failure_notif" class="notification-card notification-card-failure" x-cloak>
                    <p>{{ session('failure_notif') }}</p>
                    <i @click="failure_notif = false" class="far fa-window-close"></i>
                </div>
            @endif
            <div class="cards">
                @forelse($userUtilityPayments as $u)
                    {{-- dd($u->transactionLog) --}}
                    <div class="card">
                        <div class="card-info">
                            <h2>{{ $u->transactionLog->userUtility->utility->utility_name }}</h2>
                        </div>
                        <hr class="rounded">
                        <div class="card-info">
                            <div class="flex flex-col sm:flex-row">
                                <p class="flex-1">Amount</p>
                                <p class="flex-1">Ksh. {{ $u->amount_paid }}</p>
                            </div>
                            <div class="flex flex-col sm:flex-row">
                                <p class="flex-1">Date Paid</p>
                                <p class="flex-1">
                                    {{ Illuminate\Support\Carbon::parse($u->payment_date)->format(config('services.general.month_date_year_format')) }}
                                </p>
                            </div>
                            <div class="flex flex-col sm:flex-row">
                                <p class="flex-1">Status</p>
                                <p class="flex-1">
                                    @if($u->transactionLog->mpesa_callback_result_code == '1032')
                                        Cancelled by user
                                    @elseif($u->transactionLog->mpesa_callback_result_code == '0')
                                        Successful
                                    @else
                                        N/A
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card">
                        <div class="card-info">
                            <p>There are no payment records present in our store.</p>
                        </div>
                    </div>
                @endforelse
                {{ $userUtilityPayments->links() }}
            </div>
        </div>
    </x-slot>
</x-app-beta>