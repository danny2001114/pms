<?php

namespace App\Http\Controllers;

use App\Contracts\Services\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function __construct(
        protected UserServiceInterface $userService
    ) {}

    public function index()
    {
        return Inertia::render(page('User.Index'), [
            "users" => $this->userService->getList()
        ]);
    }

    public function create()
    {
        return Inertia::render(page('User.Create'), $this->appendOptions());
    }

    public function store(UserRequest $request)
    {
        $user = $this->userService->store($request);

        if ($user) {
            return redirect()->route('user.show', $user->id);
        } else {
            return redirect()->route('user.create');
        }
    }

    public function show(int $id)
    {
        return Inertia::render(page('User.Detail'), [
            "user" => $this->userService->show($id)
        ]);
    }

    public function edit(int $id)
    {
        if ($this->userService->isSuperAdmin($id)) {
            abort(403);
        }

        return Inertia::render(page('User.Edit'), [
            "user" => $this->userService->show($id),
            ...$this->appendOptions()
        ]);
    }

    public function update(int $id, UserRequest $request)
    {
        $this->userService->update($id, $request);
        return redirect()->route('user.show', $id);
    }

    public function destroy(int $id)
    {
        $this->userService->destroy($id);
        return redirect()->route('user.index');
    }

    public function request()
    {
        return Inertia::render(page('User.Request'));
    }

    protected function appendOptions(): array
    {
        return [
            'roles' => config('constants.USER.ROLES.OPTIONS'),
            'genders' => config('constants.USER.GENDERS.OPTIONS')
        ];
    }
}
