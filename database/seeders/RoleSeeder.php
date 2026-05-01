<?php

namespace Database\Seeders;

use App\Models\Authorization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permesions=[];
        
      foreach(  config('authorization.permessions') as $permesion=>$value){
        $permesions[]=$permesion;
      }
        Authorization::create([
            'role'=>'Manager',
            'permessions'=>json_encode($permesions),
        ]);
    }
}
