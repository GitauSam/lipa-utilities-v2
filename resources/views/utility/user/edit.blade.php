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
            <div class="cards"
                @if($userUtility->utility->utility_name == 'Electricity')
                    x-data="{ electricity: true }"
                @endif
            >
                <div class="card">
                    <form class="w-full" action="{{ route('utility.update', \Illuminate\Support\Facades\Crypt::encryptString($userUtility->id)) }}" method="POST">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="status form-input">
                            <label class="sm:mr-4 pt-2 text-lg font-semibold">Utility</label>
                            <select name="user_utility" required>
                                <option value="{{ $userUtility->utility->utility_name }}">{{ $userUtility->utility->utility_name }}</option>
                            </select>
                        </div>
                        <div x-show="electricity" id="kenya_power_meter_number_container" class="status form-input">
                            <label class="sm:mr-4 text-lg font-semibold">Meter Number</label>
                            <input x-bind:required=electricity 
                                    id="kenya_power_meter_number_input" 
                                    type="text" 
                                    placeholder="Meter Number" 
                                    name="kp_meter_number"
                                    class="w-full"
                                    value="{{ $userUtility->kenya_power_meter_number }}"
                            />
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