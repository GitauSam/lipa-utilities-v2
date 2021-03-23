<div class="cards">
    {{-- dd($utilities) --}} 
    @forelse($utilities as $utility)
        <div class="card">
            <div class="card-info">
                <h2>{{ $utility->utility_name }}</h2>
            </div>
            <div class="card-info">
                <a class="model-btn bg-blue-300 hover:bg-blue-500" 
                    href="{{ route('utility.edit', \Illuminate\Support\Facades\Crypt::encryptString($utility->id)) }}"
                >
                    Edit
                </a>
                <a wire:click.prevent="deleteUtility('{{ \Illuminate\Support\Facades\Crypt::encryptString($utility->id) }}')"
                    href="#"
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
    {{ $utilities->links() }}
</div>
