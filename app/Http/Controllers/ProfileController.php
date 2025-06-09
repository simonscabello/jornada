<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\File;
use App\Services\FileUploaderService;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct(
        private readonly FileUploaderService $fileUploader
    ) {}

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
        $data = $request->validated();
        $data['goals_visibility'] = $request->boolean('goals_visibility');

        if ($request->hasFile('profile_photo')) {
            $file = $this->fileUploader->uploadImage($request->file('profile_photo'), [
                'max_width' => 400,
                'quality' => 80,
                'fileable_type' => User::class,
                'fileable_id' => $request->user()->id
            ]);

            if ($request->user()->profile_photo_id) {
                $oldFile = File::find($request->user()->profile_photo_id);
                if ($oldFile) {
                    Storage::disk('s3')->delete($oldFile->path);
                    $oldFile->delete();
                }
            }

            $data['profile_photo_id'] = $file->id;
        }

        $request->user()->fill($data);

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
}
