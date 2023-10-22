<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserService
{
    private ApiService $apiService;

    public function __construct()
    {
        $this->apiService = new ApiService();
    }

    /**
     * Get a new query builder for the users table.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(): Builder
    {
        return User::query();
    }

    /**
     * Find a user by ID or username/email.
     *
     * @param int|null $id The ID of the user to find.
     * @param string $usernameOrEmail The username or email of the user to find.
     * @return User|null The user found, or null if not found.
     */
    public function findOne(?int $id = null, string $usernameOrEmail = ''): ?User
    {
        if(!is_null($id))
        {
            return $this->query()->find($id);
        }
       
        return $this->query()
                    ->withoutTrashed()
                    ->with('userProfile', 'role')
                    ->where('username', $usernameOrEmail)
                    ->orWhere('email', $usernameOrEmail)
                    ->first();
    }

    /**
     * Get the logged user's profile.
     *
     * @param  User  $user
     * @return ApiResponse
     */
    public function getLoggedUserProfile(User $user)
    {
        $user->load(['userProfile', 'role'])
            ->setHidden(['password']);

        return $this->apiService
                 ->setResponseData(compact('user'))
                 ->getApiResponse()
                 ->throwResponse();
    }

    /**
     * Update user profile.
     *
     * @param User|null $user The user instance to be updated.
     * @param array $data The data to be updated.
     * @return ApiResponse The API response.
     */
    public function update(?User $user, array $data)
    {
        DB::beginTransaction();
        try{
            $userIsEloquentInstance = $user instanceof User;
            if(!$userIsEloquentInstance || empty($data))
            {
                throw new \InvalidArgumentException('User data not found or data argument is invalid.');
            }

            $user->email = $data['email'];

            $this->updateUserProfile($user, $data);
            $this->updateUserProfileImage($user, $data);

            $user->save();
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return $this->apiService
                        ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)
                        ->setStatus('error')
                        ->setResponseMessage('Failed to update user profile.')
                        ->setErrorData($e->getMessage())
                        ->getApiResponse()
                        ->throwResponse();
        }

        return $this->apiService
                    ->setResponseData(compact('user'))
                    ->setResponseMessage('User profile updated successfully.')
                    ->getApiResponse()
                    ->throwResponse();
    }

    /**
     * Update user profile with given data.
     *
     * @param User $user The user to update the profile for.
     * @param array $data The data to update the profile with.
     * @return void
     */
    private function updateUserProfile(User $user, array $data)
    {
        $user->userProfile()->updateOrCreate(['user_id' => $user->id], [
            'full_name'     => $data['name'],
            'address'       => $data['address'],
            'date_of_birth' => $data['date_of_birth'],
            'gender_id'     => $data['gender_id'],
            'profile_bio'   => $data['bio'] ?? null,
        ]);
    }

    /**
     * Update user profile image.
     *
     * @param  User   $user The user object.
     * @param  array  $data The data array containing the profile image.
     * @return void
     */
    private function updateUserProfileImage(User $user, array $data)
    {
        $profileImageIsNotUploaded = !isset($data['profile_image']);
        if($profileImageIsNotUploaded) return;

        $currentProfileImagePath = 'public/' . $user->userProfileAttachment->path;
        $imageFileExists = !is_null($user->userProfileAttachment) && Storage::exists($currentProfileImagePath);
        if($imageFileExists)
        {
            Storage::delete($currentProfileImagePath);
        }

        $imagePath      = $data['profile_image']->store('profile-images', 'public');
        $imageExtension = $data['profile_image']->getClientOriginalExtension();
        $imageSize      = $data['profile_image']->getSize();
        $imageUrl       = "{$data['host']}/{$imagePath}";

        $user->userProfileAttachment()->updateOrCreate(['user_id' => $user->id], 
        [
            'url'       => $imageUrl,
            'extension' => $imageExtension,
            'size'      => $imageSize,
            'name'      => $imagePath,
            'path'      => $imagePath,
        ]);
    }
}