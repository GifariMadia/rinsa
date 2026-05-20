<div style="max-width:640px">
    <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1.5rem">
        <a href="{{ route('orders.index') }}" style="color:var(--rinsa-gray);text-decoration:none;font-size:.85rem">← Kembali</a>
        <h1 class="page-title" style="margin:0">{{ $isEditing ? 'Edit Order' : 'Tambah Order' }}</h1>
    </div>

    <div class="form-card">
        <form wire:submit="save">

            <div class="form-group">
                <label class="form-label">Pelanggan</label>
                <select wire:model="customerId" class="form-select" {{ $isEditing ? 'disabled' : '' }} required>
                    <option value="0">— Pilih Pelanggan —</option>
                    @foreach($customers as $c)
                        <option value="{{ $c->id }}">
                            {{ $c->name }}{{ $c->phone ? " ({$c->phone})" : '' }}
                        </option>
                    @endforeach
                </select>
                @error('customerId') <span style="color:var(--rinsa-red);font-size:.78rem">{{ $message }}</span> @enderror
                @if(!$isEditing)
                    <div style="margin-top:.4rem">
                        <a href="{{ route('customers.create') }}" style="font-size:.78rem;color:var(--rinsa-green)">
                            + Tambah pelanggan baru
                        </a>
                    </div>
                @endif
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Berat (kg)</label>
                    <input
                        type="number"
                        wire:model.live="weightKg"
                        class="form-input"
                        placeholder="3.5" step="0.5" min="0.5" required
                    />
                    @error('weightKg') <span style="color:var(--rinsa-red);font-size:.78rem">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Layanan</label>
                    <select wire:model.live="service" class="form-select" required>
                        @foreach($services as $val => $label)
                            <option value="{{ $val }}">
                                {{ $label }} — Rp {{ number_format($priceMap[$val], 0, ',', '.') }}/kg
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if($isEditing)
            <div class="form-group">
                <label class="form-label">Status</label>
                <select wire:model="status" class="form-select" required>
                    @foreach($statuses as $val => $label)
                        <option value="{{ $val }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            @endif

            <div class="form-group">
                <label class="form-label">Opsi Pengambilan / Pengiriman</label>
                <select wire:model="deliveryOption" class="form-select" required>
                    <option value="pickup">Pickup (Ambil Sendiri)</option>
                    <option value="delivery">Delivery (Kirim ke Alamat)</option>
                </select>
                @error('deliveryOption') <span style="color:var(--rinsa-red);font-size:.78rem">{{ $message }}</span> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Estimasi Selesai</label>
                    <input type="date" wire:model="estimatedDone" class="form-input" />
                </div>
                <div class="form-group">
                    <label class="form-label">Catatan</label>
                    <input type="text" wire:model="notes" class="form-input" placeholder="Pisahkan warna, dll." />
                </div>
            </div>

            {{-- Live price preview — updates reactively --}}
            <div style="background:var(--rinsa-cream);border-radius:8px;padding:.9rem 1rem;margin-bottom:1.25rem;display:flex;justify-content:space-between;align-items:center">
                <div>
                    <span style="font-size:.78rem;color:var(--rinsa-gray)">Harga/kg: </span>
                    <span style="font-size:.82rem;color:var(--rinsa-dark)">Rp {{ $pricePerKg }}</span>
                </div>
                <div>
                    <span style="font-size:.78rem;color:var(--rinsa-gray)">Total: </span>
                    <strong style="color:var(--rinsa-green);font-size:1rem">
                        Rp {{ number_format($totalPrice, 0, ',', '.') }}
                    </strong>
                </div>
            </div>

            <div style="display:flex;gap:.75rem;justify-content:flex-end">
                <a href="{{ route('orders.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-save" wire:loading.attr="disabled" wire:loading.class="opacity-50">
                    <span wire:loading.remove>{{ $isEditing ? 'Simpan Perubahan' : 'Simpan Order' }}</span>
                    <span wire:loading>Menyimpan...</span>
                </button>
            </div>
        </form>
    </div>
</div>
