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

        /*
         | RETRIEVING AGGREGATING
         |  
         | $user = UserModel::where('level_id', 2)->count();
         */

        /*
         | RETRIEVING AND CREATING USER MODEL WITH firstOrNew METHOD
         | 
         | $user = UserModel::firstOrNew([
         |   'username' => 'customer-2',
         |   'nama' => 'New Customer'
         | ]);
         */
        
        /*
         | RETRIEVING AND CREATING USER MODEL WITH firstOrCreate METHOD
         |
         | $user = UserModel::firstOrCreate([
         |   'username' => 'manager22',
         |   'nama' => 'Manager Dua Dua',
         |   'password' => Hash::make('12345'),
         |   'level_id' => 2,
         | ]); 
         */

        /*
         | RETRIEVE AND CREATING MODEL, SAVE TO STORE DATA
         |
         | $user = UserModel::firstOrNew([
         |    'username' => 'manager33',
         |    'nama' => 'Manager TIga Tiga Tiga',
         |    'password' => Hash::make('12345'),
         |    'level_id' => 2
         | ]);
         | $user->save();
         */

        /*
         | ATTRIBUTE CHANGES [CLEAN OR DIRTY]
         |
         | $user = UserModel::create([
         |   'username' => 'manager44',
         |   'nama' => 'Manager44',
         |   'password' => Hash::make('12345'),
         |   'level_id' => 2,
         | ]);
         |
         | $user->username = 'manager45';
         | 
         | $user->isDirty(); // true
         | $user->isDirty('username'); // true
         | $user->isDirty('nama'); // false
         | $user->isDirty(['nama', 'username']); // true
        
         | $user->isClean(); // false
         | $user->isClean('username'); // false
         | $user->isClean('nama'); // true
         | $user->isClean(['nama', 'username']); // false

         | $user->save();

         | $user->isDirty();
         | $user->isClean();
         | dd($user->isClean()); 
         */

        $user = UserModel::create([
            'username' => 'manager11',
            'nama' => 'Manager11',
            'password' => Hash::make('12345'),
            'level_id' => 2,
        ]);

        $user->username = 'manager12';

        $user->save();

        $user->wasChanged();
        $user->wasChanged('username');
        $user->wasChanged(['username', 'level_id']);
        $user->wasChanged('nama');
        dd($user->wasChanged(['nama', 'username']));
    }
}

