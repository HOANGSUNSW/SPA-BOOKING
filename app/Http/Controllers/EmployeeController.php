<?php

namespace App\Http\Controllers;
use App\Models\Users    ;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
         $query = Employee::query();

    // Tìm kiếm theo mã hoặc tên
    if ($request->filled('keyword')) {
        $keyword = $request->keyword;
        $query->where(function($q) use ($keyword) {
            $q->where('employee_code', 'like', "%$keyword%")
              ->orWhere('full_name', 'like', "%$keyword%");
        });
    }

    // Lọc theo chức vụ
    if ($request->filled('role')) {
        $query->where('role', $request->role);
    }

    // Sắp xếp
    $sortBy = $request->get('sort_by', 'id');
    $sortOrder = $request->get('sort_order', 'asc');

    if (!in_array($sortBy, ['employee_code', 'full_name'])) {
        $sortBy = 'id';
    }

    $query->orderBy($sortBy, $sortOrder);

    $employees = $query->get();

    return view('admin.staff', compact('employees', 'sortBy', 'sortOrder'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_code' => 'required|string|max:20|unique:employees,employee_code',
            'full_name'     => 'required|string|max:255',
            'email'         => 'nullable|email|unique:employees,email',
            'phone_number'  => 'nullable|string|max:20|unique:employees,phone_number',
        ], [
            'employee_code.unique' => 'Mã nhân viên đã tồn tại!',
            'email.unique'         => 'Email này đã được sử dụng!',
            'phone_number.unique'  => 'Số điện thoại đã tồn tại!',
        ]);

        Employee::create($request->all());

        return redirect()->back()->with('success', 'Thêm nhân viên thành công!');
    }

public function update(Request $request, $id)
{
    try {
        $emp = Employee::findOrFail($id);

        $request->validate([
            'employee_code' => 'required|string|max:20|unique:employees,employee_code,' . $id,
            'full_name'     => 'required|string|max:255',
            'email'         => 'nullable|email|unique:employees,email,' . $id,
            'phone_number'  => 'nullable|string|max:20|unique:employees,phone_number,' . $id,
        ], [
            'employee_code.unique' => 'Mã nhân viên đã tồn tại!',
            'email.unique'         => 'Email này đã được sử dụng!',
            'phone_number.unique'  => 'Số điện thoại đã tồn tại!',
        ]);

        $emp->update($request->all());

        return redirect()->back()->with('success', 'Cập nhật thông tin nhân viên thành công!');
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Bắt lỗi validate (Laravel sẽ tự redirect kèm lỗi)
        return redirect()->back()->withErrors($e->validator)->withInput();
    } catch (\Exception $e) {
        // Bắt các lỗi khác (DB, logic, v.v.)
        return redirect()->back()->with('error', 'Cập nhật thông tin không thành công ' . $e->getMessage());
    }
}


    public function destroy($id)
    {
        Employee::findOrFail($id)->delete();
        return redirect()->route('admin.staff')->with('success', 'Xóa nhân viên thành công!');
    }
}