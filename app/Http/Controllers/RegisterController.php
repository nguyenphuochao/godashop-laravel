<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    protected $messenger = [
        'required' => ':attribute không được để trống',
        'name.regex' => ':attribute không được chứa số hoặc ký tự đặc biệt',
        'password.regex' => ':attribute phải ít nhất 8 ký tự bao gồm chữ thường, chữ hoa, số và ký tự đặc biệt',
        'mobile.regex' => ':attribute phải bắt đầu là 0, có 9 hoặc 10 số theo sau',
        'email' => ':attribute phải là định dạng email.',
        'min' => ':attribute không được ít hơn :min ký tự',
        'max' => ':attribute không được lớn hơn :max ký tự',
        'unique' => ':attribute đã tồn tại',
        'same' => ':attribute phải trùng khớp với mật khẩu',
        'same' => ':attribute phải trùng khớp với mật khẩu',
        'g-recaptcha-response.required' => ':attribute phải được chọn',
    ];

    protected $customName = [
        'name' => 'Họ và tên',
        'password' => 'Mật khẩu',
        'mobile' => 'Số điện thoại',
        'email' => 'Email',
        'password_confirmation' => 'Nhập lại mật khẩu',
        'g-recaptcha-response' => 'Google reCAPTCHA'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($data)
    {
        $customer = [
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'is_active' => 0, // chưa kích hoạt = 0
        ];

        Customer::create($customer);

        // send mail to active account
        $input = $customer;
        $email = $data["email"];
        $token = hash('sha256', $email);

        $cus = Customer::where('email', $email)->first();
        $link_active  = route('verification.verify', ['id' => $cus->id, 'hash' => $token]);

        $input['link_active'] = $link_active;
        Mail::send(
            'customer.active_account',
            $input,
            function ($message) use ($input) {
                $to = $input['email'];
                $message->to($to, $input["name"])->subject('Godashop : Active account')
                    ->from(env('MAIL_SHOP', 'nguyenphuochao456@gmail.com'));
            }
        );

        if (Mail::failures()) {
            // error
            session()->put('error', 'Gửi mail không thành công');
        } else {
            // success
            session()->put('success', 'Thành công. Kiểm tra mail của bạn để kích hoạt tài khoản');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|regex:/^[a-zA￾ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộ
        ớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/i|max:100',
            'email' => 'required|string|email|max:100|unique:customers',
            'password' => 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/|required_with:password_confirmation',
            'password_confirmation' => 'required|min:6|same:password',
            'mobile' => 'required|min:10|max:11|regex:/^0([0-9]{9,10})$/',
            'g-recaptcha-response' => 'required|captcha',
        ], $this->messenger, $this->customName);
    }

    public function register(Request $request)
    {
        //validate
        $this->validator($request->all())->validate();
        // var_dump($request->all());
        $this->create($request->all());
        return redirect()->route('index');
    }

    public function existingEmail(Request $request)
    {
        // email tồn tại sẽ echo "false"
        // ngược lại echo "true"
        $email = $request->input('email');
        $customers = Customer::where('email', '=', $email)->get();
        if ($customers->count() > 0) {
            echo "false";
        } else {
            echo "true";
        }
    }

    function verify()
    {
        // valid active token
        $id = request()->route('id');
        $token = request()->route('hash');

        $customer = Customer::find($id);

        // Không có id customer tồn tại
        if (empty($customer)) {
            session()->put('error', 'Customer invalid');
            return redirect()->route('index');
        }

        // token invalid
        $email = $customer->email;
        $systemHash = hash('sha256', $email);
        if ($token != $systemHash) {
            session()->put('error', 'Token invalid');
            return redirect()->route('index');
        }

        // ok
        $customer->is_active = 1; // active = 1
        $customer->save();
        Auth::login($customer); // login lun khi active
        return redirect()->route('index');
    }
}
