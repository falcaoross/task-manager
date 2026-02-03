@if (session('success'))
    <div class="glass-panel border-l-4 border-emerald-400/70 bg-emerald-50/80 text-emerald-800 px-4 py-3 shadow-lg">
        <div class="flex items-center gap-3">
            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-500 text-white">
                ✓
            </span>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="glass-panel border-l-4 border-rose-400/70 bg-rose-50/90 text-rose-800 px-4 py-3 shadow-lg">
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
