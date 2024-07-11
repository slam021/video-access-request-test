<?php

namespace App\Http\Controllers\Pages;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('pages.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('pages.customers.create');
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'full_name' => 'required',
            'nick_name' => 'required',
            'telp' => 'required',
            'kelamin' => 'required',
            'email' => 'required|email|unique:users,email',
            'alamat' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $create_customer = Customer::create($validation);

            // Debugging log
            Log::info('Customer created:', ['id' => $create_customer->id]);

            if ($create_customer) {
                $create_akun = User::create([
                    'name' => $validation['full_name'],
                    'user_name' => $validation['nick_name'],
                    'email' => $validation['email'],
                    'customer_id' => $create_customer->id,
                    'role_id' => 2, // id role customer
                    'password' => Hash::make('12345678'), //default password jika tambah customer, bisa diupdate di menu user
                ]);

                // Debugging log
                Log::info('User created:', ['id' => $create_akun->id]);

                if (!$create_akun) {
                    throw new \Exception('Gagal Membuat Akun!');
                }
            } else {
                throw new \Exception('Gagal Menambahkan Customer!');
            }

            DB::commit();

            return redirect()->route('customer.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('customer.index')->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $customer = Customer::findOrFail($id);

        return view('pages.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'full_name' => 'required',
            'nick_name' => 'required',
            'telp' => 'required',
            'kelamin' => 'required',
            'email' => 'required|email|unique:users,email',
            'alamat' => 'required',
        ]);

        DB::beginTransaction();

        try {
            // Update Customer
            $customer = Customer::findOrFail($id);
            $customer->update($validation);

            // Update User
            $user = User::where('customer_id', $id)->firstOrFail();
            $user->update([
                'name' => $validation['full_name'],
                'user_name' => $validation['nick_name'],
                'email' => $validation['email'],
            ]);

            DB::commit();

            return redirect()->route('customer.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('customer.index')->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        $customer = Customer::findOrFail($id);

        $customer->delete();

        //redirect to index
        return redirect()->route('customer.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
