<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Foundation\Http\FormRequest;

class EmailVerificationRequest extends FormRequest
{
    public User $user; // = '';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $container = new UserRepositoryEloquent(new User());
        $user = $container->getByColumn('id', $this->route('id'));

        if (! hash_equals((string) $this->route('id'),
            (string) $user->getKey())) {
            return false;
        }

        if (! hash_equals((string) $this->route('hash'),
            sha1($user->getEmailForVerification()))) {
            return false;
        }
        $this->setUser($user);
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function setUser ($user) {
        $this->user = $user;
    }

    public function validated(): User
    {
        return $this->user;
    }
}
