<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Staff;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // authorization
        $this->authorize("viewAny", Staff::class);

        $staffs = Staff::all();

        return view("admin.staff.index", ["staffs" => $staffs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // authorization
        $this->authorize("create", Staff::class);

        $roles = Role::all();
        return view("admin.staff.create", ["roles" => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // authorization
        $this->authorize("create", Staff::class);

        // validate
        $data = $request->validate([
            "fullname" => "required",
            "mobile" => "required",
            "username" => "required",
            "password" => "required",
            "email" => "required",
            "roleId" => "required"
        ]);

        DB::beginTransaction();

        try {
            // create table staffs
            $staff = Staff::create([
                "name" => $data["fullname"],
                "mobile" => $data["mobile"],
                "username" => $data["username"],
                "password" => Hash::make($data["password"]),
                "email" => $data["email"],
                "is_active" => 1
            ]);

            // create table role_staff
            DB::table('role_staff')->insert([
                "staff_id" => $staff->id,
                "role_id"  => $request->roleId
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            request()->session()->put("error", "Lỗi tạo mới nhân viên");
            // throw new Exception($e->getMessage());
        }

        request()->session()->put("success", "Thêm mới thành công nhân viên " .$staff->name);
        return redirect()->route('admin.staff.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo "View sửa nhân viên";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
