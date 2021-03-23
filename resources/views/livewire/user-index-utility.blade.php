<div class="cards">
    @forelse($userUtilities as $u)
        <div class="card">
            <div class="card-info">
                <h2>{{ $u->utility->utility_name }}</h2>
            </div>
            <div class="card-info">
                @foreach($u->utility->utilityPaymentMethods as $pm)
                    @if($pm->payment_method_name == 'M-Pesa' && $pm->status == 1)
                        <a class="model-btn bg-green-500 hover:bg-green-800" 
                            href="{{-- route('utility.pay.mpesa.get', \Illuminate\Support\Facades\Crypt::encryptString($u->id)) --}}"
                        >
                            Pay with {{ $pm->payment_method_name }}
                        </a>
                    @elseif($pm->payment_method_name == 'Equitel' && $pm->status == 1)
                        <a class="model-btn bg-yellow-600 hover:bg-yellow-800" 
                            href="{{ route('utility.edit', \Illuminate\Support\Facades\Crypt::encryptString($u->id)) }}"
                        >
                            Pay with {{ $pm->payment_method_name }}
                        </a>
                    @elseif($pm->payment_method_name == 'Card' && $pm->status == 1)
                        <a class="model-btn bg-pink-600 hover:bg-pink-800" 
                            href="{{ route('utility.edit', \Illuminate\Support\Facades\Crypt::encryptString($u->id)) }}"
                        >
                            Pay with {{ $pm->payment_method_name }}
                        </a>
                    @elseif($pm->payment_method_name == 'Paypal' && $pm->status == 1)
                        <a class="model-btn bg-blue-600 hover:bg-blue-800" 
                            href="{{ route('utility.edit', \Illuminate\Support\Facades\Crypt::encryptString($u->id)) }}"
                        >
                            Pay with {{ $pm->payment_method_name }}
                        </a>
                    @endif
                @endforeach
                <a class="model-btn bg-blue-600 hover:bg-blue-800" 
                            href="{{ route('utility.edit', \Illuminate\Support\Facades\Crypt::encryptString($u->id)) }}"
                >
                    Edit
                </a>
                <a href="#"
                    class="model-btn bg-red-500 hover:bg-red-800"     
                >
                    Delete
                </a>
            </div>
        </div>
    @empty
        <div class="card">
            <div class="card-info">
                <p>There are no utilities present in our store.</p>
            </div>
        </div>
    @endforelse
    {{ $userUtilities->links() }}
</div>

