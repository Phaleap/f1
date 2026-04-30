@extends('layouts.app')

@section('title', 'Profile — F1 Store')

@section('content')

@include('home._navbar')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;500&display=swap" rel="stylesheet">

<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
    --red: #E10600;
    --dark: #080808;
    --off-white: #f0ece4;
    --muted: rgba(240,236,228,0.35);
    --border: rgba(255,255,255,0.06);
    --border-mid: rgba(255,255,255,0.10);
    --surface: #0d0d0d;
}

body { background: var(--dark); }

.profile-page {
    background: var(--dark);
    color: var(--off-white);
    font-family: 'Barlow', sans-serif;
    font-weight: 300;
    min-height: 100vh;
    padding-top: 92px;
}

.accent-strip { height: 2px; background: var(--red); }

.page-header {
    padding: 48px 48px 40px;
    border-bottom: 1px solid var(--border);
}
.page-eyebrow {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.6rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--red);
    margin-bottom: 14px;
}
.eyebrow-line { display: inline-block; width: 28px; height: 1px; background: var(--red); }
.page-title {
    font-family: 'Bebas Neue', cursive;
    font-size: 2.8rem;
    letter-spacing: 3px;
    color: var(--off-white);
    line-height: 1;
}
.page-sub { font-size: 0.78rem; color: var(--muted); margin-top: 8px; }

.profile-wrap {
    max-width: 760px;
    margin: 0 auto;
    padding: 48px;
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.profile-card {
    background: #0a0a0a;
    border: 1px solid var(--border);
    overflow: hidden;
}

.profile-card-header {
    padding: 20px 28px;
    border-bottom: 1px solid var(--border);
    background: #111;
}

.profile-card-title {
    font-size: 0.6rem;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--muted);
    font-weight: 400;
}

.profile-card-body { padding: 28px; }

.field-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
    margin-bottom: 20px;
}
.field-group:last-of-type { margin-bottom: 0; }

.field-label {
    font-size: 0.6rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--muted);
}

.field-input {
    width: 100%;
    padding: 12px 16px;
    background: #111;
    border: 1px solid var(--border-mid);
    color: var(--off-white);
    font-family: 'Barlow', sans-serif;
    font-size: 0.88rem;
    font-weight: 300;
    outline: none;
    transition: border-color 0.2s;
}
.field-input:focus { border-color: rgba(225,6,0,0.5); }
.field-input::placeholder { color: rgba(240,236,228,0.18); }

select.field-input { cursor: pointer; color-scheme: dark; }
input[type="date"].field-input { color-scheme: dark; }

.field-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.field-error {
    font-size: 0.62rem;
    letter-spacing: 2px;
    color: var(--red);
}

.btn-save {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 24px;
    background: var(--red);
    border: none;
    color: #fff;
    font-family: 'Barlow', sans-serif;
    font-size: 0.62rem;
    font-weight: 500;
    letter-spacing: 4px;
    text-transform: uppercase;
    cursor: pointer;
    transition: opacity 0.2s;
    margin-top: 20px;
}
.btn-save:hover { opacity: 0.88; }

.success-msg {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.62rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: #22c55e;
    margin-top: 14px;
}

@media (max-width: 768px) {
    .profile-wrap { padding: 32px 24px; }
    .page-header { padding: 40px 24px 32px; }
    .field-row { grid-template-columns: 1fr; }
}
</style>

<div class="profile-page">
    <div class="accent-strip"></div>

    <div class="page-header">
        <div class="page-eyebrow">
            <span class="eyebrow-line"></span>
            My Account
        </div>
        <h1 class="page-title">Profile Settings</h1>
        <p class="page-sub">Manage your account information and security settings</p>
    </div>

    <div class="profile-wrap">

        {{-- Profile Information --}}
        <div class="profile-card">
            <div class="profile-card-header">
                <span class="profile-card-title">Profile Information</span>
            </div>
            <div class="profile-card-body">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="field-row">
                        <div class="field-group">
                            <label class="field-label">Full Name</label>
                            <input type="text" name="full_name" class="field-input"
                                   value="{{ old('full_name', $user->full_name) }}"
                                   placeholder="Your full name">
                            @error('full_name')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="field-group">
                            <label class="field-label">Phone</label>
                            <input type="text" name="phone" class="field-input"
                                   value="{{ old('phone', $user->phone) }}"
                                   placeholder="+1 234 567 8900">
                            @error('phone')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label">Email Address</label>
                        <input type="email" name="email" class="field-input"
                               value="{{ old('email', $user->email) }}"
                               placeholder="your@email.com">
                        @error('email')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field-row">
                        <div class="field-group">
                            <label class="field-label">Gender <span style="font-size:0.56rem;">(optional)</span></label>
                            <select name="gender" class="field-input">
                                <option value="">Select gender</option>
                                <option value="male"   {{ old('gender', $user->gender) === 'male'   ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other"  {{ old('gender', $user->gender) === 'other'  ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="field-group">
                            <label class="field-label">Date of Birth <span style="font-size:0.56rem;">(optional)</span></label>
                            <input type="date" name="date_of_birth" class="field-input"
                                   value="{{ old('date_of_birth', $user->date_of_birth?->format('Y-m-d')) }}">
                        </div>
                    </div>

                    @if($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div style="padding:12px 16px;border:1px solid rgba(234,179,8,0.2);background:rgba(234,179,8,0.04);margin-bottom:16px;">
                        <div style="font-size:0.62rem;letter-spacing:3px;text-transform:uppercase;color:#eab308;">
                            Email not verified.
                            <form method="POST" action="{{ route('verification.send') }}" style="display:inline;">
                                @csrf
                                <button type="submit" style="background:none;border:none;color:#eab308;font-size:0.62rem;letter-spacing:3px;text-transform:uppercase;cursor:pointer;text-decoration:underline;">
                                    Resend verification email
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif

                    <button type="submit" class="btn-save">Save Changes</button>

                    @if(session('status') === 'profile-updated')
                    <div class="success-msg">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <circle cx="7" cy="7" r="6" stroke="#22c55e" stroke-width="1.2"/>
                            <path d="M4.5 7l2 2 3-3" stroke="#22c55e" stroke-width="1.2" stroke-linecap="round"/>
                        </svg>
                        Profile updated successfully
                    </div>
                    @endif
                </form>
            </div>
        </div>

        {{-- Update Password --}}
        <div class="profile-card">
            <div class="profile-card-header">
                <span class="profile-card-title">Update Password</span>
            </div>
            <div class="profile-card-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="field-group">
                        <label class="field-label">Current Password</label>
                        <input type="password" name="current_password" class="field-input"
                               placeholder="Enter current password" autocomplete="current-password">
                        @error('current_password', 'updatePassword')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field-row">
                        <div class="field-group">
                            <label class="field-label">New Password</label>
                            <input type="password" name="password" class="field-input"
                                   placeholder="New password" autocomplete="new-password">
                            @error('password', 'updatePassword')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="field-group">
                            <label class="field-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="field-input"
                                   placeholder="Confirm new password" autocomplete="new-password">
                        </div>
                    </div>

                    <button type="submit" class="btn-save">Update Password</button>

                    @if(session('status') === 'password-updated')
                    <div class="success-msg">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <circle cx="7" cy="7" r="6" stroke="#22c55e" stroke-width="1.2"/>
                            <path d="M4.5 7l2 2 3-3" stroke="#22c55e" stroke-width="1.2" stroke-linecap="round"/>
                        </svg>
                        Password updated successfully
                    </div>
                    @endif
                </form>
            </div>
        </div>

        {{-- Danger Zone --}}
        <div class="profile-card" style="border-color:rgba(225,6,0,0.15);">
            <div class="profile-card-header" style="background:#0d0505;">
                <span class="profile-card-title" style="color:rgba(225,6,0,0.5);">Danger Zone</span>
            </div>
            <div class="profile-card-body">
                <p style="font-size:0.82rem;color:var(--muted);line-height:1.7;margin-bottom:20px;">
                    Once your account is deleted, all of its resources and data will be permanently deleted.
                    Before deleting your account, please download any data or information that you wish to retain.
                </p>
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    <div class="field-group">
                        <label class="field-label">Confirm with Password</label>
                        <input type="password" name="password" class="field-input"
                               placeholder="Enter your password to confirm">
                        @error('password', 'userDeletion')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn-save"
                            style="background:transparent;border:1px solid rgba(225,6,0,0.4);color:var(--red);"
                            onclick="return confirm('Are you sure? This cannot be undone.')">
                        Delete My Account
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

@include('home._footer')
@endsection