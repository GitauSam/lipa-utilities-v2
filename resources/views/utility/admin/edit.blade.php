<x-app-beta>
    <x-slot name="links">
        <div class="link">
            <a href="{{ route('admin.utility.create') }}">Add Utility</a>
        </div>
        <div class="link">
            <a href="{{ route('admin.utility.index') }}">View Utilities</a>
        </div>
    </x-slot>
    <x-slot name="pro">
        <h2>Join pro for free games.</h2>
        <img src="{{ asset('images/controller.png') }}" alt="" />
    </x-slot>
    <x-slot name="games">
        <div class="games">
            <div class="status">
                <h1>Edit Utility</h1>
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
                @if($utility)
                    <div class="card">
                        <form class="w-full" action="{{ route('admin.utility.update', \Illuminate\Support\Facades\Crypt::encryptString($utility->id)) }}" method="POST">
                            @csrf
                            {{ method_field('PATCH') }}
                            <div class="status">
                                <label class="sm:mr-4 text-lg font-semibold">Name</label>
                                <input type="text" class="w-full" placeholder="Utility Name" name="utility_name" value="{{ $utility->utility_name }}" required/>
                            </div>
                            
                            @foreach($utility->utilityPaymentMethods as $pm)
                                @if($pm->payment_method_name == 'M-Pesa') 
                                    @if($pm->status == 1)
                                        <div id="mpesa_paybill_number_container" class="status form-input">
                                            <label class="sm:mr-4 text-lg font-semibold">Paybill Number</label>
                                            <input id="mpesa_paybill_number_input" class="w-full" type="text" placeholder="Paybill Number" name="paybill_number" value="{{ $pm->lipa_na_mpesa_paybill }}" required/>
                                        </div>
                                    @else
                                        <div id="mpesa_paybill_number_container" style="display: none;" class="status form-input">
                                            <label class="sm:mr-4 text-lg font-semibold">Paybill Number</label>
                                            <input id="mpesa_paybill_number_input" class="w-full" type="text" placeholder="Paybill Number" name="paybill_number" value="{{ $pm->lipa_na_mpesa_paybill }}"/>
                                        </div>
                                    @endif
                                @endif
                            @endforeach

                            @if($mpesaStatus == 0)
                                <div id="mpesa_paybill_number_container" style="display: none;" class="status form-input">
                                    <label class="sm:mr-4 text-lg font-semibold">Paybill Number</label>
                                    <input id="mpesa_paybill_number_input" type="text" placeholder="Paybill Number" name="paybill_number"/>
                                </div>
                            @endif
                            
                            <div class="status text-center text-lg font-semibold">
                                <label>Payment Methods</label>
                            </div>
                            <div class="mb-12">
                                <input class="input-checkbox cursor-pointer" 
                                        type="checkbox" 
                                        name="utility_payment_methods[]" 
                                        id="utility_payment_mpesa" 
                                        value="M-Pesa"
                                        {{ in_array('M-Pesa', $paymentMethods) ? 'checked' : ''}}
                                        onchange="handleMpesaInput(this)"
                                />    
                                <label class="ml-2 text-lg font-semibold">M-Pesa</label>
                            </div>
                            <div class="mb-12">
                                <input class="input-checkbox cursor-pointer" 
                                        type="checkbox" 
                                        name="utility_payment_methods[]" 
                                        id="utility_payment_equitel" 
                                        value="Equitel"
                                        {{ in_array('Equitel', $paymentMethods) ? 'checked' : ''}}
                                />    
                                <label class="ml-2 text-lg font-semibold">Equitel</label>
                            </div>
                            <div class="mb-12">
                                <input class="input-checkbox cursor-pointer" 
                                        type="checkbox" 
                                        name="utility_payment_methods[]" 
                                        id="utility_payment_card" 
                                        value="Card"
                                        {{ in_array('Card', $paymentMethods) ? 'checked' : ''}}
                                />    
                                <label class="ml-2 text-lg font-semibold">Card</label>
                            </div>
                            <div class="mb-12">
                                <input class="input-checkbox cursor-pointer" 
                                        type="checkbox" 
                                        name="utility_payment_methods[]" 
                                        id="utility_payment_paypal" 
                                        value="Paypal"
                                        {{ in_array('Paypal', $paymentMethods) ? 'checked' : ''}}
                                />    
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
                @else
                    <div class="card">
                        <p>Cannot edit utility. Please contact support.</p>
                    </div>
                @endif
            </div>
        </div>
    </x-slot>
</x-app-beta>