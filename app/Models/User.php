<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'role_id';

    public function get_all_user()
    {
        return DB::table($this->table)
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->select('users.*', 'roles.name as role')
            ->get();
    }

    public function get_single_user($id)
    {
        $user = DB::table($this->table)->where('id', $id)->first();
        return $user;
    }

    public function create_user($data)
    {
        return DB::table($this->table)->insert($data);
    }

    public function update_user($data, $id)
    {
        return DB::table($this->table)->where('id', $id)->update($data);
    }

    public function delete_user($id)
    {
        return DB::table($this->table)->where('id', $id)->delete();
    }
}
