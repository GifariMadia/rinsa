<div>
    <div class="topbar">
        <h1 class="page-title" style="margin:0">Pelanggan</h1>
        <div style="display:flex;gap:.75rem;align-items:center;flex-wrap:wrap;width:100%">
            <input type="text" wire:model.live.debounce.300ms="search" class="search-input" placeholder="Cari nama / nomor HP..." style="flex:1;min-width:140px" />
            <a href="{{ route('customers.create') }}" class="btn-add">+ Tambah</a>
        </div>
    </div>

    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

    {{-- Desktop table --}}
    <div class="table-wrap desktop-only">
        <table>
            <thead><tr><th>Nama</th><th>No. HP</th><th>Alamat</th><th>Total Order</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($customers as $c)
                <tr wire:key="tbl-c-{{ $c->id }}">
                    <td style="font-weight:600">{{ $c->name }}</td>
                    <td>{{ $c->phone ?? '—' }}</td>
                    <td style="font-size:.82rem;color:var(--rinsa-gray)">{{ $c->address ?? '—' }}</td>
                    <td><span style="background:var(--rinsa-cream);padding:2px 10px;border-radius:99px;font-size:.78rem;font-weight:600">{{ $c->orders_count }}</span></td>
                    <td>
                        <div class="table-action">
                            <a href="{{ route('customers.edit', $c) }}" class="btn-sm btn-edit">Edit</a>
                            <button wire:click="deleteCustomer({{ $c->id }})" wire:confirm="Hapus pelanggan {{ $c->name }}?" class="btn-sm btn-del">Hapus</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align:center;padding:3rem;color:var(--rinsa-gray)">Belum ada pelanggan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Mobile card list --}}
    <div class="mobile-card-list">
        @forelse($customers as $c)
        <div class="order-mobile-card" wire:key="mob-c-{{ $c->id }}">
            <div class="order-mobile-card-top">
                <div>
                    <div class="order-mobile-name">{{ $c->name }}</div>
                    <div class="order-mobile-code">{{ $c->phone ?? 'Tanpa nomor HP' }}</div>
                </div>
                <span style="background:var(--rinsa-cream);padding:3px 10px;border-radius:99px;font-size:.78rem;font-weight:600;color:var(--rinsa-dark)">{{ $c->orders_count }} order</span>
            </div>
            @if($c->address)
            <div style="font-size:.8rem;color:var(--rinsa-gray);margin-bottom:8px">{{ $c->address }}</div>
            @endif
            <div class="order-mobile-actions">
                <a href="{{ route('customers.edit', $c) }}" class="btn-sm btn-edit" style="flex:1;text-align:center">Edit</a>
                <button wire:click="deleteCustomer({{ $c->id }})" wire:confirm="Hapus?" class="btn-sm btn-del" style="flex:1">Hapus</button>
            </div>
        </div>
        @empty
        <div style="text-align:center;padding:3rem 1rem;color:var(--rinsa-gray)">Belum ada pelanggan.</div>
        @endforelse
    </div>

    @if($customers->hasPages())
        <div style="margin-top:1rem">{{ $customers->links() }}</div>
    @endif
</div>
