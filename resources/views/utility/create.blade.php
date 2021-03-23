<x-app-beta>
    <x-slot name="links"> 
        <div class="link">
            <a href="{{ route('utility.index') }}">View Utilities</a>
        </div>
    </x-slot>
    <x-slot name="pro">
        <h2>Join pro for free games.</h2>
        <img src="{{ asset('images/controller.png') }}" alt="" />
    </x-slot>
    <x-slot name="games">
        <div class="games">
            <div class="status">
                <h1>Create Utility</h1>
            </div>
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
            <div class="cards">
                <div class="card">
                    <form class="w-full" action="{{ route('admin.utility.store') }}" method="POST">
                        @csrf
                        <div class="status form-input">
                            <label class="sm:mr-4 text-lg font-semibold">Name</label>
                            <input type="text" class="w-full" placeholder="Utility Name" name="utility_name" required/>
                        </div>
                        <div id="mpesa_paybill_number_container" style="display: none;" class="status form-input">
                            <label class="sm:mr-4 text-lg font-semibold">Paybill Number</label>
                            <input id="mpesa_paybill_number_input" type="text" placeholder="Paybill Number" name="paybill_number"/>
                        </div>
                        <div class="status text-center text-lg font-semibold">
                            <label>Payment Methods</label>
                        </div>
                        <div class="mb-12">
                            <input class="input-checkbox cursor-pointer" type="checkbox" name="utility_payment_methods[]" id="utility_payment_mpesa" value="M-Pesa" onchange="handleMpesaInput(this)"/>    
                            <label class="ml-2 text-lg font-semibold">M-Pesa</label>
                        </div>
                        <div class="mb-12">
                            <input class="input-checkbox cursor-pointer" type="checkbox" name="utility_payment_methods[]" id="utility_payment_equitel" value="Equitel"/>    
                            <label class="ml-2 text-lg font-semibold">Equitel</label>
                        </div>
                        <div class="mb-12">
                            <input class="input-checkbox cursor-pointer" type="checkbox" name="utility_payment_methods[]" id="utility_payment_card" value="Card"/>    
                            <label class="ml-2 text-lg font-semibold">Card</label>
                        </div>
                        <div class="mb-12">
                            <input class="input-checkbox cursor-pointer" type="checkbox" name="utility_payment_methods[]" id="utility_payment_paypal" value="Paypal"/>    
                            <label class="ml-2 text-lg font-semibold">Paypal</label>
                        </div>
                        <div class="submit">
                            <input type="submit" 
                                    class="w-full bg-blue-300 rounded-2xl py-1 text-lg text-white font-semibold
                                            hover:bg-blue-500 cursor-pointer" 
                                    value="SAVE"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-beta>
    