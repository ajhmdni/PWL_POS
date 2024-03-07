<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        /*
         | INSERT DATA
         | 
         | $data = [
         |  'username' => 'customer-1',
         |  'nama' => 'Pelanggan',
         |  'password' => Hash::make('12345'),
         |  'level_id' => 5
         | ];
         |
         | UserModel::create($data);
         */
        
         /*
          | UPDATE DATA
          |
          | $data = [
          |   'nama' => 'Pelanggan Pertama',
          | ];
          | UserModel::where('username', 'customer-1')->update($data);                                                                                  
          */
        
        /*
         | CREATE USER MANAGER
         |
         | $data = [
         |   'level_id' => 2,
         |   'username' => 'manager_dua',
         |   'nama' => 'Manager 2',
         |   'password' => Hash::make('12345')
         | ];
         | UserModel::create($data);
         */

        /*
         | QUERYING DATA
         |
         | $user = UserModel::all();
         */


        /*
         | CREATE USER WITH UNFILLABLE ATTRIBUTE
         |
         | $data = [
         |   'level_id' => 2,
         |   'username' => 'manager_tiga',
         |   'nama' => 'Manager 3',
         |   'password' => Hash::make('12345') 
         | ];
         | UserModel::create($data); 
         */

        /*
         | QUERYING SPECIFIC DATA
         | 
         | $user = UserModel::find(1);
         */
         
         /*
         | FILTERING DATA
         | 
         | $user = UserModel::where('level_id', 1)->first();
         */

         /*
         | GETTING FIRST DATA WITH FILTER
         | 
         | $user = UserModel::firstWhere('level_id', 1);
         */

         /*
         | GETTING FIRST DATA WITH FILTER
         | 
         | $user = UserModel::findOr(1, ['username', 'nama'], function () {
         |   abort(404);
         | });
         */

        /*
         | GET DATA WITH INVALID ID <Expected to throw 404 not found error>
         | 
         | $user = UserModel::findOr(20, ['username', 'nama'], function () {
         |   abort(404);
         | });
         */

        /*
         | GET DATA WITH INVALID ID <Expected to throw 404 not found error>
         | 
         | $user = UserModel::where('username', 'manager9')->firstOrFail();
         */

        $user = UserModel::where('level_id', 2)->count();
        return view('user', ['data' => $user]);
    }
}

