<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Exam;
use App\Models\Image;
use App\Models\Lesson;
use App\Models\Lesson_member;
use App\Models\Post;
use App\Models\Top;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::where('email', $request->email)->first();
            $admin = Admin::where('user_id', $user->id)->first();
            if ($admin) {
                return redirect(url('admin/dashboard'))->with('success', 'user login successfully');
            } else {
                return back()->with('faild', 'You are not authorized to access');
            }
        } else {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return back()->with('faild', 'email not found');
            } else {
                return back()->with('faild', 'password not found');
            }
        }
        return back()->with('faild', '');
    }

    public function index()
    {
        return view('admin.users.index', [
            'maincategories' => Category::where('parent', 0)->get(),
            'users' => User::all(),
        ]);
    }
    public function old()
    {
        return view('admin.users.index', [
            'maincategories' => Category::where('parent', 0)->get(),
            'users' => User::where('status', 1)->get(),
        ]);
    }
    public function new()
    {
        return view('admin.users.index', [
            'maincategories' => Category::where('parent', 0)->get(),
            'users' => User::where('status', 0)->get(),
        ]);
    }
    public function tops()
    {
        return view('admin.users.index', [
            'maincategories' => Category::where('parent', 0)->get(),
            'users' => User::wherehas('top')->get(),
        ]);
    }
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        $a = $user->groupid;
        $b = $user->category->parent;

        $usersLessons = Lesson_member::where('user_id', $user->id)->pluck('lesson_id')->toArray();
        $lessons = Lesson::whereNotIn('id', $usersLessons)->where(function ($query) use ($a, $b) {
            $query->where('category_id', $a)
                ->orWhere('category_id', $b);
        })->get();

        $mainanswers = Answer::where('user_id', $user->id)->pluck('exam_id')->toArray();
        $exams = Exam::whereNotIn('id', $mainanswers)->where(function ($query) use ($a, $b) {
            $query->where('category_id', $a)
                ->orWhere('category_id', $b);
        })->get();

        return view('admin.users.show', [
            'user' => $user,
            'lessons' => $lessons,
            'exams' => $exams
        ]);
    }

    public function settings()
    {
        return view('admin.settings.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            'category' => 'required',
        ]);
        $user = new User();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->username = $request->username;
        $user->groupid  = $request->category;
        $user->phone    = $request->phone;
        $user->status   = 1;
        $user->only     = 0;
        $user->save();
        return back()->with('success', 'تم اضافة الطالب بنجاح');
    }

    public function destroy(Request $request)
    {
        $id = $request->user_id;
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return back()->with('success', 'تم حذف الطالب بنجاح');
        } else {
            return back()->with('faild', 'يوجد خطأ');
        }
    }

    public function activate(Request $request)
    {
        $id = $request->user_id;
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->status = 1;
            $user->save();
            return back()->with('success', 'تم تفعيل الطالب بنجاح');
        } else {
            return back()->with('faild', 'يوجد خطأ');
        }
    }
    public function top(Request $request)
    {
        $id = $request->user_id;
        $user = User::where('id', $id)->first();
        if ($user) {
            $top = new Top();
            $top->user_id = $user->id;
            $top->save();
            $post = new Post();
            $post->post_name        = 'الطلاب المتفوقين';
            $post->post_description = 'الطلاب المتفوقين للصف ' . $user->category->category_name . '<br>' . 'الطالب ' . '<b class="text-primary">' . $user->name . '</b>';
            $post->allow_comment    = 1;
            $post->tags             = 'الطلاب_المتفوقين';
            $post->type             = 1;
            $post->user_id          = $user->id;
            $post->category_id      = $user->category->id;
            $post->save();
            $entry = new Image();
            $entry->post_id          = $post->id;
            $entry->filename         = 'tops';
            $entry->url              = $user->avatar ? $user->avatar : asset('web_files/top.jpg');
            $entry->save();

            return back()->with('success', 'تم تعيين الطالب بنجاح');
        } else {
            return back()->with('faild', 'يوجد خطأ');
        }
    }
    public function nottop(Request $request)
    {
        $id = $request->user_id;
        $user = User::where('id', $id)->first();
        if ($user) {
            $top = Top::where('user_id', $user->id)->first();
            $top->delete();
            $post = Post::where('user_id', $user->id)->first();
            $post->delete();
            return back()->with('success', 'تم تعيين الطالب بنجاح');
        } else {
            return back()->with('faild', 'يوجد خطأ');
        }
    }
    public function update(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->username = $request->username;
        $user->groupid  = $request->category;
        $user->phone    = $request->phone;
        $user->save();
        return back()->with('success', 'تم تعديل الطالب بنجاح');
    }

    public function disabled_all(Request $request)
    {
        $users = User::where('only', '!=', 1)->get();
        if ($users) {
            foreach ($users as $user) {
                $user->status = 0;
                $user->save();
            }
            return back()->with('success', 'تم الغاء تعيل جميع الطلاب بنجاح');
        } else {
            return back()->with('faild', 'يوجد خطأ');
        }
    }

    public function not_activiate(Request $request)
    {
        $id = $request->user_id;
        $user = User::where('id', $id)->first();
        if ($user) {
            $user->status = 0;
            $user->save();
            return back()->with('success', 'تم الغاء تفعيل الطالب بنجاح');
        } else {
            return back()->with('faild', 'يوجد خطأ');
        }
    }
    public function editCurrentUser(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        if ($user) {
            $user->groupid = $request->category;
            $user->save();
            return back()->with('success', 'تم التعديل بنجاح');
        } else {
            return back()->with('faild', 'يوجد خطأ');
        }
    }
}
