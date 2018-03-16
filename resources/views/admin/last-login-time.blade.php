@php $numOfSeconds = \Carbon\Carbon::now()->diffInSeconds(\Carbon\Carbon::parse(\Illuminate\Support\Facades\Auth::guard('admin')->user()->login_time)); @endphp
@php $seconds = $numOfSeconds % 60; @endphp
@php $numOfMinutes = ($numOfSeconds-$seconds) / 60; @endphp
@php $minutes = ($numOfMinutes) % 60; @endphp
@php $hours = abs(($numOfMinutes) / 60); @endphp
<span class="last-login">Last Login: {{(floor($hours) > 0) ? floor($hours) . ' hours ' .$minutes.' minutes ago' : $minutes.' minutes ago'}}</span>