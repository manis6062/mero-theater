@php $lastLoginTime = \Illuminate\Support\Facades\Auth::guard('counter')->user()->last_login_time; @endphp
@if($lastLoginTime != null)
    @php $lastLoginTimeArray = array_map('trim', explode(' ',$lastLoginTime)); @endphp
    @php $lastLoginDate = $lastLoginTimeArray[0]; @endphp
    @php $lastLoginTime = $lastLoginTimeArray[1]; @endphp
    @php $displayLastLoginDate = date('M d, Y', strtotime($lastLoginDate)); @endphp
    @php $displayLastLoginTime = date('h:i A', strtotime($lastLoginTime)); @endphp
    <span class="last-login">Last Login: {{$displayLastLoginDate.' '.$displayLastLoginTime}}</span>
@else
    <span class="last-login">Last Login: No last login data found !</span>
@endif