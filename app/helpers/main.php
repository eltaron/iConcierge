<?php

function sendResponseSuccess($message, $data)
{
    return response([
        "success" => true,
        "message" => $message,
        "data"    => $data,
    ], 200);
}

function sendResponseDebug($message)
{
    return response([
        "success" => false,
        "message" => $message,
    ], 200);
}

function sendResponseFail($message)
{
    // $data = new \App\Models\ErrorLog();
    // $data->exception = $message;
    // if(userLogin()){
    //     $data->user_id = userLogin()->id;
    // }
    // $data->save();
    return response([
        "success" => false,
        // "message" => trans('app.sorry_somthing_wrong')
        "message" => $message
    ], 200);
}

function sendResponseError($message)
{
    return response([
        "success" => false,
        // "message" => trans('app.sorry_somthing_wrong')
        "message" => $message
    ], 200);
}

function sendResponseValid($message)
{
    return response([
        "success" => false,
        // "message" => trans('app.sorry_somthing_wrong')
        "message" => $message
    ], 200);
}

function GetLanguage()
{
    return app()->getLocale();
}

function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip;
}

function userLogin()
{
    return JWTAuth::parseToken()->authenticate();
}

if (!function_exists('aurl')) {
    function aurl($url)
    {
        return url('/admin/' . $url);
    }
}

if (!function_exists('rurl')) {
    function rurl($url)
    {
        return url('/restaurantDash/' . $url);
    }
}

if (!function_exists('surl')) {
    function surl($url)
    {
        $path = explode('/', request()->path())[1];
        return url("/restaurant/" . $path . "/" . $url);
    }
}

if (!function_exists('restaurantName')) {
    function restaurantName($restaurantName)
    {
        return \App\Models\User::whereHas('restaurant', function ($query) use ($restaurantName) {
            $query->where('restaurant_name', $restaurantName);
        })->with('restaurant')->first();
    }
}

if (!function_exists('userrestaurant')) {
    function userTrader()
    {
        return \App\Models\User::where('id', \Auth::user()->id)->with('restaurant')->first();
    }
}

if (!function_exists('storeNameData')) {
    function storeNameData()
    {
        $path = explode('/', request()->path())[1];
        return \App\Models\User::whereHas('restaurant', function ($query) use ($path) {
            $query->where('restaurant_name', $path);
        })->with('restaurant')->first();
    }
}

if (!function_exists('categories')) {
    function categories()
    {
        return \App\Models\Category::with('children')->where('parent_id', null)->get();
    }
}

if (!function_exists('notifications')) {
    function notifications()
    {
        return \App\Models\Notification::where('type', '!=', 'newUser')->where('user_id', \Auth::user()->id)->where('read_at', null)->latest()->take(30)->get();
    }
}

if (!function_exists('notificationsCount')) {
    function notificationsCount()
    {
        return \App\Models\Notification::where('type', '!=', 'newUser')->where('read_at', null)->where('user_id', \Auth::user()->id)->count();
    }
}
if (!function_exists('MessageCount')) {
    function MessageCount()
    {
        return \App\Models\Message::count();
    }
}
if (!function_exists('adminNotifications')) {
    function adminNotifications()
    {
        return \App\Models\Notification::where('type', 'newUser')->where('read_at', Null)->with('user')->latest()->take(15)->get();
    }
}

if (!function_exists('adminNotificationsCount')) {
    function adminNotificationsCount()
    {
        return \App\Models\Notification::where('type', 'newUser')->where('read_at', Null)->with('user')->latest()->take(15)->count();
    }
}

if (!function_exists('shopCategories')) {
    function shopCategories()
    {
        $user = storeNameData();

        $subCategory = \App\Models\Category::whereHas('products', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->pluck('id');

        $category = \App\Models\Category::with(['children' => function ($query) {
            $query->withCount('products');
        }])->whereHas('children', function ($query) use ($subCategory) {
            $query->whereIn('id', $subCategory);
        })->where('parent_id', null)->get();

        return $category;
    }
}


if (!function_exists('activeMenu')) {
    function activeMenu($url)
    {
        if (Request::is('admin/' . $url)) {
            return 'active';
        }
    }
}

if (!function_exists('cartsCount')) {
    function cartsCount()
    {
        if (\Auth::check()) {
            return \App\Models\Cart::where('user_id', \Auth::user()->id)->count();
        }
        return 0;
    }
}

if (!function_exists('chatCount')) {
    function chatCount()
    {
        if (\Auth::check()) {
            return \App\Models\Chat::where('store_id', storeNameData()->store->id)->count();
        }
        return 0;
    }
}

if (!function_exists('wislhlistsCount')) {
    function wislhlistsCount()
    {
        if (\Auth::check()) {
            return \App\Models\Wishlist::where('user_id', \Auth::user()->id)->count();
        }
        return 0;
    }
}

if (!function_exists('lang')) {
    function lang()
    {
        if (session()->has('lang')) {
            return session()->get('lang');
        } else {
            session()->put('lang', 'ar');
            return 'ar';
        }
    }
}

if (!function_exists('currencies')) {
    function currencies()
    {
        return \App\Models\Currency::latest()->get();
    }
}


if (!function_exists('currentCurrency')) {
    function currentCurrency()
    {
        if (Request::is('api/*')) {
            return request()->header('Accept-Currency');
        } else {
            if (session()->has('current_currency')) {
                return session()->get('current_currency');
            } else {
                $currency = \App\Models\Currency::where('is_default', 1)->first();
                if ($currency) {
                    session()->put('current_currency', $currency->code);
                    return $currency->code;
                } else {
                    return trans("web.EGP");
                }
            }
        }
    }
}
