<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Psr\Log\LoggerInterface;
use Throwable;

class UserController extends Controller
{
    /** @var int  */
    private const PAGE_SIZE = 20;

    /** @var LoggerInterface */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $users = User::paginate(self::PAGE_SIZE);
        return view('user.all', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $userData = $this->getUserDataFromRequest($request);
        $validator = Validator::make($userData, $this->getValidationRules());
        if ($validator->fails()) {
            return Redirect::to('users/create')->withErrors($validator->messages());
        }

        try {
            $passwordHash = Hash::make($userData['password']);
            $userData['password'] = $passwordHash;
            $user = User::create($userData);
            $user->save();
            return Redirect::to('users');
        } catch (Throwable $error) {
            $this->logger->critical($error);
            return Redirect::to('users/create')->withErrors('Something went wrong. See logs for details.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        return view('user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $userData =$this->getUserDataFromRequest($request);
        $validator = Validator::make($userData, $this->getValidationRules());
        if ($validator->fails()) {
            return Redirect::route('users.edit', [ $user->id])->withErrors($validator->messages());
        }

        try {
            $passwordHash = Hash::make($userData['password']);
            $userData['password'] = $passwordHash;
            $user->update($userData);
            return Redirect::route('users.show', [ $user->id]);
        } catch (Throwable $error) {
            $this->logger->critical($error);
            return Redirect::route('users.edit', [ $user->id])
                ->withErrors('Something went wrong. See logs for details.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return Redirect::to('users');
    }

    /**
     * Get user data from request
     *
     * @param Request $request
     * @return array
     */
    public function getUserDataFromRequest(Request $request): array
    {
        return [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
    }

    /**
     * Get validation rules
     *
     * @return string[]
     */
    private function getValidationRules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ];
    }
}
