<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function abilities(){
        return $this->hasMany(RoleAbility::class);
    }

    public static function createWithAbility(Request $request){
        DB::beginTransaction();
        try {
            $role = Role::create([
                'name' => $request->post('name'),
            ]);
            foreach ($request->post('abilities') as $ability => $value) {
                RoleAbility::create([
                    'role_id' => $role->id,
                    'ability' => $ability,
                    'type' => $value,
                ]);
            }
            DB::commit();
            return $role;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }


    }
    public  function UpdateWithAbility(Request $request){
        DB::beginTransaction();
        try {
            $this->update([
                'name' => $request->post('name'),
            ]);
            foreach ($request->post('abilities') as $ability => $value) {
                RoleAbility::updateOrCreate([
                    'role_id' => $this->id,
                    'ability' => $ability,


                ],[
                    'type' => $value,
                ]);
            }
            DB::commit();
            return $this;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }


    }
}
