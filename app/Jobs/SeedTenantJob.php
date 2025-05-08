<?php

namespace App\Jobs;


use App\Models\User;
use App\Models\Tenant;
use App\Models\category;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SeedTenantJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

   
    protected  $tenant;
    public function __construct(Tenant $tenant)
    {
        $this->tenant= $tenant;
    }

    public function handle(): void
    {
        $this->tenant->run(function(){
            User::create([
                'name'=>$this->tenant->name,
                'email'=>$this->tenant->email,
                'password'=>$this->tenant->password,
            ]);
            $user=User::latest()->first();
            $user->type='admin';
            $user->save();
            category::create([
                'categoryname'=>'Electronics',
                ]);

        });
    }
}