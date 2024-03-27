<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $data = $request->validate([
                'email'         => 'required',
                'password'      => 'required',
                'mac_address'   => 'required'
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
                if ($user->mac_address == $request->mac_address) {
                    return response()->json([
                        'message' => 'success',
                        'data' => $user->makeVisible('api_token')
                    ]);
                } else {
                    return response()->json([
                        'message' => 'error',
                        'data' => 'wrong device'
                    ]);
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
                'name'          => 'required',
                'mobile'        => 'required',
                'parent_mobile' => 'nullable',
                'email'         => 'required|unique:users',
                'password'      => 'required',
                'mac_address'      => 'required',
            ]);
            $random = rand(100000, 99999999);
            $data = User::create([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'mac_address' => $request->mac_address,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'api_token' => Hash::make($random),
                'parent_mobile' => $request->parent_mobile,
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
    public function update(Request $request)
    {
        try {
            $data = $request->validate([
                'name'          => 'required',
                'mobile'        => 'required',
                'parent_mobile' => 'nullable',
                'email'         => 'required|unique:users',
            ]);
            $user = User::find(auth()->guard('api')->id());
            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->email = $request->email;
            if ($request->parent_mobile) {
                $user->parent_mobile = $request->parent_mobile;
            }
            $user->save();
            return response()->json([
                'message' => 'success',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e
            ]);
        }
    }
    public function profile(Request $request)
    {
        try {
            $data = User::find(auth()->guard('api')->id());
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
    public function adminlogin(Request $request)
    {
        try {
            $data = $request->validate([
                'email'         => 'required',
                'password'      => 'required',
            ]);
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
                'admin' => 1,
            ];
            if (auth()->attempt($credentials)) {
                $user = User::where('email', $request->email)->first();
                if ($user->api_token == null) {
                    User::where('id', $user->id)->update([
                        'api_token' => Hash::make(rand(100000, 99999999))
                    ]);
                    $user = User::where('email', $request->email)->first();
                }
                return response()->json([
                    'message' => 'success',
                    'data' => $user->makeVisible('api_token')
                ]);
            } else {
                $user = User::where('email', $request->email)->first();
                if (!$user) {
                    return response()->json([
                        'message' => 'error',
                        'data' => 'email not found'
                    ]);
                } else {
                    if ($user->admin == 0) {
                        return response()->json([
                            'message' => 'error',
                            'data' => 'not admin'
                        ]);
                    }
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
    public function activate(Request $request)
    {
        try {
            $data = $request->validate([
                'user_id'         => 'required',
            ]);
            $data = User::find($request->user_id);
            $data->status = 1;
            $data->save();
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
    public function destroy(Request $request)
    {
        try {
            $data = $request->validate([
                'user_id'         => 'required',
            ]);
            $data = User::find($request->user_id);
            $data->delete();
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
                $subject = "univecourses reset password";
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

    public function checkCode(Request $request)
    {
        try {
            $data = $request->validate([
                'code'           => 'required',
                'email'       => 'required',
            ]);
            $user = User::where(['email' => $request->email, 'remember_token' => $request->code])->first();
            if ($user) {
                return response()->json([
                    'message' => 'success',
                    'data' => 'code success'
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

    public function newPassword(Request $request)
    {
        try {
            $data = $request->validate([
                'code'           => 'required',
                'email'          => 'required',
                'password'       => 'required',
            ]);
            $user = User::where(['email' => $request->email, 'remember_token' => $request->code])->first();
            $user->password = Hash::make($request->password);
            $user->remember_token = '';
            $user->save();
            return response()->json([
                'message' => 'success',
                'data' => 'password updated success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }

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
