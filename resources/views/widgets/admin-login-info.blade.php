<div class="user-nav d-sm-flex d-none">
    <span class="user-name text-bold-600">
        {{ Auth::guard('admin')->user()->name }}
    </span>
</div>
<span>{{-- <img class="round" src="{{url('public/images/profile/'.$profileImage) }}" alt="avatar" height="40" width="40" /> --}}</span>