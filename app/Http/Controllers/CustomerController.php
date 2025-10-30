<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function customers(Request $request)
    {
        $query = Customer::query();

        // Tìm kiếm
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('customer_code', 'like', "%$keyword%")
                  ->orWhere('full_name', 'like', "%$keyword%")
                  ->orWhere('phone_number', 'like', "%$keyword%");
            });
        }

        // Sắp xếp
        $sortBy = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'asc');

        if (!in_array($sortBy, ['customer_code', 'full_name'])) {
            $sortBy = 'id';
        }

        $query->orderBy($sortBy, $sortOrder);
        $customers = $query->get();

        return view('admin.customers', compact('customers', 'sortBy', 'sortOrder'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'customer_code' => 'required|string|max:20|unique:customers,customer_code',
                'full_name'     => 'required|string|max:255',
                'phone_number'  => 'required|string|max:20|unique:customers,phone_number',
                'email'         => 'nullable|email|unique:customers,email',
            ], [
                'customer_code.unique' => 'Mã khách hàng đã tồn tại!',
                'email.unique'         => 'Email này đã được sử dụng!',
                'phone_number.unique'  => 'Số điện thoại đã tồn tại!',
            ]);

            Customer::create($request->all());
            return redirect()->back()->with('success', 'Thêm khách hàng thành công!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Thêm khách hàng thất bại: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $customer = Customer::findOrFail($id);

            $request->validate([
                'customer_code' => 'required|string|max:20|unique:customers,customer_code,' . $id,
                'full_name'     => 'required|string|max:255',
                'phone_number'  => 'required|string|max:20|unique:customers,phone_number,' . $id,
                'email'         => 'nullable|email|unique:customers,email,' . $id,
            ], [
                'customer_code.unique' => 'Mã khách hàng đã tồn tại!',
                'email.unique'         => 'Email này đã được sử dụng!',
                'phone_number.unique'  => 'Số điện thoại đã tồn tại!',
            ]);

            $customer->update($request->all());
            return redirect()->back()->with('success', 'Cập nhật thông tin khách hàng thành công!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật không thành công: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Customer::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Xóa khách hàng thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không thể xóa khách hàng: ' . $e->getMessage());
        }
    }
}
