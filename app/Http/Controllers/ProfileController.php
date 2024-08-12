<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileStoreRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function getUpdateeProfile()
    {
        $authuser = Auth::user();
        return view('admin.pages.profile.update-profile', compact('authuser'));
    }

    public function updateProfile(ProfileStoreRequest $request)
    {
        $user = User::whereEmail($request->email)->first();
        $this->image_upload($request, $user->id);
        Toastr::success('Profile Updated Successfully!!');
        return back();
    }

    public function image_upload($request, $user_id)
    {
        //check it image uploaeded
        if ($request->hasFile('user_image')) {
            $user = User::find($user_id);

            //check if already exists previous image
            if ($user->user_image != null) {
                // delete old photo
                $old_photo_path = 'public/uploads/profile_images/' . $user->user_image;
                unlink(base_path($old_photo_path));
            }

            // create image manager with desired driver
            $manager = new ImageManager(new Driver());

            $photo_location = 'public/uploads/profile_images/';
            $uploaded_photo = $request->file('user_image');

            // read image from file system
            $image = $manager->read($uploaded_photo);
            $image = $image->resize(300, 300);

            $new_photo_name = $user_id . '.' . $uploaded_photo->getClientOriginalExtension(); // 1.jpg
            $new_photo_location = $photo_location . $new_photo_name; //public/uploads/profile_images/1.jpg

            $image->save(base_path($new_photo_location));

            $user->update([
                'user_image' => $new_photo_name,
            ]);

        }
    }
}
