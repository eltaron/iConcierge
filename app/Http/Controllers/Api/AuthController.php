<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PromoCode;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        try {
            $data = $request->validate([
                'email'         => 'required',
                'password'      => 'required',
            ]);
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];
            if (auth()->attempt($credentials)) {
                $user = User::where('email', $request->email)->first();
                if ($user->api_token == null) {
                    User::where('id', $user->id)->update([
                        'api_token' => Hash::make(rand(100000, 99999999))
                    ]);
                    $user = User::where('email', $request->email)->first();
                }
            } else {
                $user = User::where('email', $request->email)->first();
                if (!$user) {
                    return response()->json([
                        'message' => 'error',
                        'data' => 'email not found'
                    ]);
                } else {
                    return response()->json([
                        'message' => 'error',
                        'data' => 'password not found'
                    ]);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e
            ]);
        }
    }
    public function register(Request $request)
    {
        try {
            $data = $request->validate([
                'username'          => 'required',
<<<<<<< HEAD
                'email'                 => 'required|unique:users',
                'password'              => 'required',
            ]);
            $random = rand(100000, 99999999);
            $data = User::create([
                'username' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'api_token' => Hash::make($random),
=======
                // 'mobile'        => 'required',
                // 'parent_mobile' => 'nullable',
                'email'                 => 'required|unique:users',
                'password'              => 'required',
                'password'              => 'required',
                'confirm_password'      => 'required',
                // 'mac_address'      => 'required',
            ]);
            if ($request->password != $request->confirm_password) {
                throw new \Exception("Password and confirm password do not match");
            }
            $random = rand(100000, 99999999);
            $data = User::create([
                'username' => $request->name,
                // 'mobile' => $request->mobile,
                // 'mac_address' => $request->mac_address,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'api_token' => Hash::make($random),
                // 'parent_mobile' => $request->parent_mobile,
>>>>>>> 2de2f21a8cf3b84ab9d7f3861c8ac056ea510ec8
            ]);
            return response()->json([
                'message' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e
            ]);
        }
    }
    public function forgetPassword(Request $request)
    {
        try {
            $data = $request->validate([
                'email'         => 'required',
            ]);
            $checkMail = User::where('email', $request->email)->first();
            if ($checkMail) {
                $code = $this->generateCode();
                $checkMail->remember_token = $code;
                $checkMail->save();
                $name = $checkMail->name;
                $data = [];
                $data['name'] = $name;
                $data['code'] = $code;
                $to = $request->email;
<<<<<<< HEAD
                $subject = "iconcierge reset password";
=======
                $subject = "univecourses reset password";
>>>>>>> 2de2f21a8cf3b84ab9d7f3861c8ac056ea510ec8
                $txt = '
                <div style="display:block;padding:15px;background-color:#fff">
                    <div>
                        Hi ' . $name . ',
                    </div>
                    <br>
                    <div>
                        We received a request to reset your Account password. <br>
                        Enter the following password reset code
                    </div>
                    <br>
                    <div>
                        <span style="background-color:lightblue;padding:10px;margin-top:20px; border:1px solid blue;color:#333;font-size:18px;font-weight:bold">
                            ' . $code . '
                        </span>
                    </div>
                </div>
                ';
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: <support@univecourses.com>";
                mail($to, $subject, $txt, $headers);
                return response()->json([
                    'message' => 'success',
                    'data' => 'email send successful'
                ]);
            }
            return response()->json([
                'message' => 'error',
                'data' => 'email not found'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }

    public function newpassword(Request $request)
    {
        try {
            $data = '';
            return response()->json([
                'message' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }
    public function logout(Request $request)
    {
        try {
            $data = $request->validate([
                'api_token' => 'required',
            ]);
            $token = $request->api_token;
            $user = User::where('api_token', $token)->first();
            $user->api_token = null;
            $user->save();
            return response()->json([
                'message' => 'success',
                'data' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e
            ]);
        }
    }
    public function update(Request $request)
    {
        try {
            $data = '';
            return response()->json([
                'message' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }
    public function changetype(Request $request)
    {
        try {
            $data = '';
            return response()->json([
                'message' => 'success',
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }
    public function promocode(Request $request)
    {
        try {
            $data = $request->validate([
                'code'           => 'required',
                'email'       => 'required',
            ]);
<<<<<<< HEAD
            $code = PromoCode::where('code', $request->code)->first();
=======
            $code=PromoCode::where('code',$request->code)->first();
>>>>>>> 2de2f21a8cf3b84ab9d7f3861c8ac056ea510ec8
            $user = User::where(['email' => $request->email])->first();

            if ($user && $code) {
                return response()->json([
                    'message' => 'success',
                    'data' => $code
                ]);
            }
            return response()->json([
                'message' => 'error',
                'data' => 'code wrong'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }

<<<<<<< HEAD
=======





>>>>>>> 2de2f21a8cf3b84ab9d7f3861c8ac056ea510ec8
    function generateCode()
    {
        $code = mt_rand(100000, 999999);
        if ($this->codeExists($code)) {
            return $this->generateCode();
        }
        return $code;
    }

    function codeExists($code)
    {
        return User::where('remember_token', $code)->exists();
    }
}
