<?php

namespace App\Http\Controllers;

use App\Contracts\Services\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

/**
 * handles HTTP requests related to user operations
 */
class UserController extends Controller
{
    /**
     * user controller constructor
     * @param UserServiceInterface $userService inject the user service
     */
    public function __construct(
        protected UserServiceInterface $userService
    ) {}

    /**
     * user list page
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        return Inertia::render(page('User.Index'), [
            "users" => $this->userService->getList()
        ]);
    }

    /**
     * user create page
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render(page('User.Create'), $this->appendOptions());
    }

    /**
     * store user
     * @param UserRequest $request validated user request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $user = $this->userService->store($request);

        if ($user) {
            return redirect()->route('user.show', $user->id);
        } else {
            return redirect()->route('user.create');
        }
    }

    /**
     * user detail page
     * @param int $id user id
     * @return \Inertia\Response
     */
    public function show(int $id): Response
    {
        return Inertia::render(page('User.Detail'), [
            "user" => $this->userService->show($id)
        ]);
    }

    /**
     * user edit page
     * @param int $id user id
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     * @return \Inertia\Response
     */
    public function edit(int $id): Response
    {
        if ($this->userService->isSuperAdmin($id)) {
            abort(403);
        }

        return Inertia::render(page('User.Edit'), [
            "user" => $this->userService->show($id),
            ...$this->appendOptions()
        ]);
    }

    /**
     * update user
     * @param int $id user id
     * @param UserRequest $request validated user request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(int $id, UserRequest $request): RedirectResponse
    {
        $this->userService->update($id, $request);
        return redirect()->route('user.show', $id);
    }

    /**
     * delete user
     * @param int $id user id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->userService->destroy($id);
        return redirect()->route('user.index');
    }

    /**
     * user request list page
     * @return \Inertia\Response
     */
    public function request(): Response
    {
        return Inertia::render(page('User.Request'));
    }

    /**
     * to append form options to user form pages
     * @return array{roles: array, genders: array}
     */
    protected function appendOptions(): array
    {
        return [
            'roles' => config('constants.USER.ROLES.OPTIONS'),
            'genders' => config('constants.USER.GENDERS.OPTIONS')
        ];
    }
}
