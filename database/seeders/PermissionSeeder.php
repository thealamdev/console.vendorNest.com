<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = storage_path('permissions/all-permissions.json');
        $permissions = (object) json_decode(file_get_contents($filePath));
        $data = [];
        foreach ($permissions as $module => $items) {
            foreach ($items as $slug) {
                $parts = explode('.', $slug);
                $action = $parts[1];
                $data[] = [
                    'id' => strtolower(Str::ulid()),
                    'module' => $module,
                    'name' => ucwords(str_replace('.', ' ', $slug)),
                    'slug' => $slug,
                    'action' => $action,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        DB::table('permissions')->insert($data);
    }
}
