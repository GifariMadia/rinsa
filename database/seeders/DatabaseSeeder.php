<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderStatusLog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // === USERS ===
        $admin = User::create([
            'name'      => 'Admin Rinsa',
            'email'     => 'admin@rinsa.id',
            'password'  => Hash::make('rinsa123'),
            'role'      => 'admin',
            'is_active' => true,
        ]);

        User::create([
            'name'      => 'Kasir Rinsa',
            'email'     => 'kasir@rinsa.id',
            'password'  => Hash::make('rinsa123'),
            'role'      => 'kasir',
            'is_active' => true,
        ]);

        // === CUSTOMERS ===
        $customers = [
            ['name' => 'Budi Santoso',  'phone' => '08123456789', 'address' => 'Jl. Mawar No. 5'],
            ['name' => 'Siti Rahayu',   'phone' => '08987654321', 'address' => 'Jl. Melati No. 12'],
            ['name' => 'Andi Pratama',  'phone' => '08111222333', 'address' => 'Jl. Kenanga No. 3'],
            ['name' => 'Dewi Lestari',  'phone' => '08222333444', 'address' => 'Jl. Anggrek No. 7'],
            ['name' => 'Reza Firmansyah', 'phone' => '08333444555', 'address' => 'Jl. Cempaka No. 9'],
        ];

        $createdCustomers = collect($customers)->map(
            fn($c) => Customer::create($c)
        );

        // === ORDERS (demo) ===
        $orders = [
            [
                'customer' => $createdCustomers[0],
                'weight'   => 3.0,
                'service'  => 'cuci_setrika',
                'status'   => 'pickup',
                'days_ago' => 3,
            ],
            [
                'customer' => $createdCustomers[1],
                'weight'   => 5.0,
                'service'  => 'cuci_kering',
                'status'   => 'washing',
                'days_ago' => 1,
            ],
            [
                'customer' => $createdCustomers[2],
                'weight'   => 2.0,
                'service'  => 'express',
                'status'   => 'pending',
                'days_ago' => 0,
            ],
            [
                'customer' => $createdCustomers[3],
                'weight'   => 4.5,
                'service'  => 'cuci_setrika',
                'status'   => 'done',
                'days_ago' => 2,
            ],
            [
                'customer' => $createdCustomers[4],
                'weight'   => 1.5,
                'service'  => 'express',
                'status'   => 'pending',
                'days_ago' => 0,
            ],
        ];

        foreach ($orders as $o) {
            $pricePerKg = Order::PRICE_MAP[$o['service']];
            $createdAt  = now()->subDays($o['days_ago']);

            $order = Order::create([
                'order_code'     => Order::generateCode(),
                'customer_id'    => $o['customer']->id,
                'created_by'     => $admin->id,
                'weight_kg'      => $o['weight'],
                'service'        => $o['service'],
                'status'         => $o['status'],
                'price_per_kg'   => $pricePerKg,
                'total_price'    => $o['weight'] * $pricePerKg,
                'estimated_done' => $createdAt->copy()->addDay(),
                'picked_up_at'   => $o['status'] === 'pickup' ? $createdAt->copy()->addDays(2) : null,
                'created_at'     => $createdAt,
                'updated_at'     => $createdAt,
            ]);

            // Seed status logs realistically
            $statusFlow = Order::STATUS_FLOW;
            $curIdx     = array_search($o['status'], $statusFlow);
            $prevStatus = null;

            for ($i = 0; $i <= $curIdx; $i++) {
                OrderStatusLog::create([
                    'order_id'   => $order->id,
                    'changed_by' => $admin->id,
                    'old_status' => $prevStatus,
                    'new_status' => $statusFlow[$i],
                    'note'       => $i === 0 ? 'Order dibuat' : null,
                    'changed_at' => $createdAt->copy()->addHours($i * 4),
                ]);
                $prevStatus = $statusFlow[$i];
            }
        }
    }
}
