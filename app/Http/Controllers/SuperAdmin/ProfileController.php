<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
	/**
	 * Display the super admin profile page.
	 */
	public function index()
	{
		return view('super_admin.profile.profile');
	}

	/**
	 * Update profile details.
	 */
	public function update(Request $request)
	{
		$user = $request->user();

		$data = $request->validate([
			'first_name' => ['required', 'string', 'max:255'],
			'middle_name' => ['nullable', 'string', 'max:255'],
			'last_name' => ['required', 'string', 'max:255'],
			'email' => ['nullable', 'email', Rule::unique('users')->ignore($user->id)],
			'contact_number' => ['nullable', 'string', 'max:50'],
			'username' => ['required', 'string', Rule::unique('users')->ignore($user->id)],
			'avatar' => ['nullable', 'file', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
		]);

		$user->first_name = $data['first_name'];
		$user->middle_name = $data['middle_name'] ?? null;
		$user->last_name = $data['last_name'];
		$user->email = $data['email'] ?? $user->email;
		$user->contact_number = $data['contact_number'] ?? $user->contact_number;
		$user->username = $data['username'];

		// Handle avatar upload
		if ($request->hasFile('avatar')) {
			// delete previous avatar if exists
			if (! empty($user->avatar) && Storage::disk('public')->exists($user->avatar)) {
				Storage::disk('public')->delete($user->avatar);
			}

			$path = $request->file('avatar')->store('avatars', 'public');
			$user->avatar = $path;
		}

		$user->save();

		return back()->with('success', 'Profile updated successfully.')->with('swal', [
			'title' => 'Profile Updated',
			'text' => 'Your profile has been updated successfully.',
			'icon' => 'success',
			
		]);
	}

	/**
	 * Change account password.
	 */
	public function password(Request $request)
	{
		$user = $request->user();

		$request->validate([
			'current_password' => ['required'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
		]);

		if (! Hash::check($request->input('current_password'), $user->password)) {
			return back()->withErrors(['current_password' => 'Current password is incorrect.']);
		}

		$user->password = Hash::make($request->input('password'));
		$user->save();

		return back()->with('success', 'Password updated successfully.')->with('swal', [
			'title' => 'Password Updated',
			'text' => 'Your password has been changed successfully.',
			'icon' => 'success',
			
		]);
	}
}

