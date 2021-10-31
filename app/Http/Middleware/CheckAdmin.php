<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\DbModels\Admin;
class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        if(!empty(auth()->guard('admin')->id()))
        {
            $count = Admin::where('_id',auth()->guard('admin')->id())->count();
            if ($count == 0)
            {
                return redirect()->intended('admin/login/')->with('status', 'You do not have access to admin side');
            }
            return $next($request);
        }
        else 
        {
            return redirect()->intended('admin/login/')->with('status', 'Please Login to access admin area');
        }
        
         
    }
}