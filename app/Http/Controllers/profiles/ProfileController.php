<?php
/**
 * Created by PhpStorm.
 * User: assem
 * Date: 9/24/19
 * Time: 3:43 PM
 */

namespace App\Http\Controllers\profiles;


use App\File;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProfileController extends Controller
{

    /**
     * @var User $user
     */
    protected $user;

    /**
     * @var File $file
     */
    protected $file;

    /**
     * ProfileController constructor.
     * @param User $user
     * @param File $file
     */
    public function __construct(User $user, File $file)
    {
        $this->user = $user;
        $this->file = $file;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->user->find(Auth()->id());

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|exists:users|unique:users,email,'.$user->id,
            'image' => 'required|mimes:pdf,jpeg,jpg,bmp,png|max:10000',
            'passport' => 'required|mimes:pdf,jpeg,jpg,bmp,png|max:20000',

        ]);

        $user->update($request->all());

        if ($request->file('image')) {
            if (empty($user->image)) {
                $attributes['local_path'] = 'profile/images';
                $attributes['file'] = $request->file('image');
                $attributes['description'] = User::$PROFILE_IMAGE;
                $attributes['fileable_id'] = $user->id;
                $attributes['fileable_type'] = User::class;

                $this->file->createFile($attributes);
            } else {

                $attributes['local_path'] = 'profile/images';
                $attributes['file'] = $request->file('image');
                $attributes['description'] = User::$PROFILE_IMAGE;
                $attributes['fileable_id'] = $user->id;
                $attributes['fileable_type'] = User::class;

                $attributes['old_file'] = $user->image->path;

                $user->image->updateFile($attributes);
            }
        }

            if ($request->file('passport')) {
                if (empty($user->passport)) {
                    $attributes['local_path'] = 'profile/passports';
                    $attributes['file'] = $request->file('passport');
                    $attributes['description'] = User::$PROFILE_PASSPORT;
                    $attributes['fileable_id'] = $user->id;
                    $attributes['fileable_type'] = User::class;

                    $this->file->createFile($attributes);
                }else{

                    $attributes['local_path'] = 'profile/passports';
                    $attributes['file'] = $request->file('passport');
                    $attributes['description'] = User::$PROFILE_PASSPORT;
                    $attributes['fileable_id'] = $user->id;
                    $attributes['fileable_type'] = User::class;

                    $attributes['old_file'] = $user->passport->path;

                    $user->passport->updateFile($attributes);
                }
        }

        return redirect()->route('profiles.myProfile')->with('message',['type'=>'success','text'=>'Successfully updated']);
    }

    /**
     * @return Factory|View
     */
    public function myProfile()
    {
        $user = $this->user->find(Auth()->id());
        return view('profiles.myProfile')->with('user', $user);
    }


}
