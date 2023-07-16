<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'role-show',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-show',
            'client-list',
            'client-create',
            'client-edit',
            'client-delete',
            'governorate-list',
            'governorate-create',
            'governorate-edit',
            'governorate-delete',
            'city-list',
            'city-create',
            'city-edit',
            'city-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'article-list',
            'article-create',
            'article-edit',
            'article-delete',
            'article-show',
            'donation-request-list',
            'donation-request-delete',
            'donation-request-show',
            'settings-edit',
            'contact-list',
            'contact-delete',



        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}