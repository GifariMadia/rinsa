<div>
    {{-- Topbar --}}
    <div class="topbar">
        <h1 class="page-title" style="margin:0">Manajemen Order</h1>
        <div style="display:flex;gap:.75rem;align-items:center;flex-wrap:wrap;width:100%">
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                class="search-input"
                placeholder="Cari order / pelanggan..."
                style="flex:1;min-width:140px"
            />
            <select wire:model.live="statusFilter" class="form-select" style="width:auto;font-size:.82rem;padding:7px 10px">
                <option value="">Semua Status</option>
                @foreach($statusLabels as $val => $label)
                    <option value="{{ $val }}">{{ $label }}</option>
                @endforeach
            </select>
            <a href="{{ route('orders.create') }}" class="btn-add">+ Tambah</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- ===== DESKTOP: Table ===== --}}
    <div class="table-wrap desktop-only">
        <table>
            <thead>
                <tr>
                    <th><button wire:click="sortBy('order_code')" style="background:none;border:none;cursor:pointer;font:inherit;color:inherit;font-size:.72rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px;padding:0">ID {{ $sortBy==='order_code' ? ($sortDir==='asc'?'↑':'↓') : '' }}</button></th>
                    <th>Pelanggan</th>
                    <th><button wire:click="sortBy('weight_kg')" style="background:none;border:none;cursor:pointer;font:inherit;color:inherit;font-size:.72rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px;padding:0">Berat {{ $sortBy==='weight_kg' ? ($sortDir==='asc'?'↑':'↓') : '' }}</button></th>
                    <th>Layanan</th>
                    <th>Status</th>
                    <th><button wire:click="sortBy('total_price')" style="background:none;border:none;cursor:pointer;font:inherit;color:inherit;font-size:.72rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px;padding:0">Total {{ $sortBy==='total_price' ? ($sortDir==='asc'?'↑':'↓') : '' }}</button></th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr wire:key="tbl-{{ $order->id }}">
                    <td><span style="font-family:monospace;font-size:.78rem;color:var(--rinsa-gray)">{{ $order->order_code }}</span></td>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->weight_kg }} kg</td>
                    <td style="font-size:.8rem">
                        {{ $order->service_label }}<br>
                        <span style="font-size:.7rem; color:var(--rinsa-gray)">
                            {{ $order->delivery_option === 'delivery' ? 'Kirim Kurir' : 'Ambil Sendiri' }}
                        </span>
                    </td>
                    <td><span class="badge badge-{{ $order->status }}">{{ $order->status_label }}</span></td>
                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td style="font-size:.78rem;color:var(--rinsa-gray)">{{ $order->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="table-action">
                            <a href="{{ route('orders.show', $order) }}" class="btn-sm btn-view">Detail</a>
                            <a href="{{ route('orders.edit', $order) }}" class="btn-sm btn-edit">Edit</a>
                            <button wire:click="deleteOrder({{ $order->id }})" wire:confirm="Hapus order {{ $order->order_code }}?" class="btn-sm btn-del">Hapus</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;padding:3rem;color:var(--rinsa-gray)">Tidak ada order ditemukan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ===== MOBILE: Card List ===== --}}
    <div class="mobile-card-list">
        @forelse($orders as $order)
        <div class="order-mobile-card" wire:key="mob-{{ $order->id }}">
            <div class="order-mobile-card-top">
                <div>
                    <div class="order-mobile-name">{{ $order->customer->name }}</div>
                    <div class="order-mobile-code">{{ $order->order_code }}</div>
                </div>
                <span class="badge badge-{{ $order->status }}">{{ $order->status_label }}</span>
            </div>
            <div class="order-mobile-meta">
                <span class="order-mobile-detail">
                    {{ $order->weight_kg }} kg · {{ $order->service_label }} · 
                    {{ $order->delivery_option === 'delivery' ? 'Kirim Kurir' : 'Ambil Sendiri' }}
                </span>
                <span class="order-mobile-price">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
            <div class="order-mobile-actions">
                <a href="{{ route('orders.show', $order) }}" class="btn-sm btn-view">Detail</a>
                <a href="{{ route('orders.edit', $order) }}" class="btn-sm btn-edit">Edit</a>
                <button wire:click="deleteOrder({{ $order->id }})" wire:confirm="Hapus?" class="btn-sm btn-del">Hapus</button>
            </div>
        </div>
        @empty
        <div style="text-align:center;padding:3rem 1rem;color:var(--rinsa-gray)">Tidak ada order ditemukan.</div>
        @endforelse
    </div>

    @if($orders->hasPages())
        <div style="margin-top:1rem">{{ $orders->links() }}</div>
    @endif
</div>
