<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Notifications\NewUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        try {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

            $user = User::create($validatedData);
            $user->roles()->attach($request->input('role_id'));

            $user->notify(new NewUser($request->email, $request->password));

            return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao criar usuário: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $user->password = bcrypt($user->password);

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        try {
        if (!$request->filled('password')) {
            $request->request->remove('password');
        } else {
            $validatedData = $request->validate([
                'password' => 'nullable|string|min:8',
            ]);
            $user->update(['password' => bcrypt($request->input('password'))]);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validatedData);
        $user->roles()->sync($request->input('role_id'));

        $this->sendFCMNotification($user);

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar usuário: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (Auth::user()->id === $user->id) {
            return redirect()->route('users.index')->with('error', 'Você não pode excluir a si mesmo!');
        }

        $user->roles()->detach();
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso!');
    }

    private function sendFCMNotification(User $user)
    {
        $token = $user->device_token;

        $factory = (new Factory)
            ->withServiceAccount(base_path('laravel-eb094-firebase-adminsdk-32br1-f06094db8e.json'))
            ->withDatabaseUri('https://laravel-eb094-default-rtdb.firebaseio.com/');

        $messaging = $factory->createMessaging();

        $message = CloudMessage::withTarget('token', $token)
            ->withNotification(Notification::create('Usuário Atualizado', 'Seu usuário foi atualizado.'));

        $messaging->send($message);

        return response()->json(['message' => 'Notificação enviada com sucesso']);
    }
}
