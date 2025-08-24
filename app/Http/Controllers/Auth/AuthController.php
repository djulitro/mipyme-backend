<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function me()
    {
        return response()->json(Auth::user());
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

        if (is_null($user->email_verified_at)) {
            return response()->json([
                'message' => 'El correo electrónico no ha sido verificado',
                'email_verified' => false,
            ], 403);
        }

        if ($user->change_password) {
            return response()->json([
                'message' => 'El usuario debe cambiar su contraseña',
                'change_password' => true,
            ], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        $user->load('role');

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => $user
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:App\Models\User,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:App\Models\Role,id'
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id
        ]);
        // Necesitamos crear un string encriptado, que contenga un json con el id del usuario y el email.
        $string = json_encode([
            'id' => $user->id,
            'email' => $user->email,
            'timestamp' => time()
        ]);

        $url = env('APP_URL') . '/verify-email?token='.base64_encode($string);

        Mail::to($user->email)->send(new VerifyEmail($url));

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
        ], 201);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $user->tokens()->delete();
        
        return response()->json([
            'message' => 'Sesión cerrada exitosamente',
        ]);
    }

    public function profile(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|string|max:20',
            'birthdate' => 'required|date',
            'gender' => 'required|integer|in:1,2,3',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'avatar' => 'nullable|file|image|max:2048',
        ]);

        $user = Auth::user();

        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone' => $request->input('phone'),
                'birthdate' => $request->input('birthdate'),
                'gender' => $request->input('gender'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'country' => $request->input('country'),
                // TODO: Esto debe cambiar, ya que la imagen de debe guardar en el servidor de archivos.
                // 'avatar_url' => $request->file('avatar') ? $request->file('avatar')->store('avatars', 'public') : null,
            ]
        );

        return response()->json([
            'message' => 'Perfil actualizado exitosamente',
            'profile' => $user->profile,
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!password_verify($request->input('current_password'), $user->password)) {
            return response()->json([
                'message' => 'La contraseña actual es incorrecta'
            ], 400);
        }

        $user->password = bcrypt($request->input('new_password'));
        $user->save();

        return response()->json([
            'message' => 'Contraseña cambiada exitosamente',
        ]);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:App\Models\User,email',
        ]);

        // Send password reset email logic here
        $user = User::where('email', $request->input('email'))->first();

        // Generamos un string al azar para guardar la nueva password para enviar el correo y que se cambie la contraseña
        $random = random_bytes(16);

        $user->password = bcrypt($random);
        $user->change_password = true;
        $user->save();

        // Enviar correo con la nueva contraseña.

        return response()->json([
            'message' => 'Instrucciones para restablecer la contraseña enviadas a su correo electrónico',
        ]);
    }

    public function verifyEmail(Request $request)
    {
        $decripted = base64_decode($request->query('token'));
        $data = json_decode($decripted, true);

        $user = User::find($data['id']);

        if (!is_null($user->email_verified_at)) {
            return response()->json([
                'message' => 'El correo electrónico ya ha sido verificado',
            ], 400);
        }

        $user->email_verified_at = now();
        $user->save();

        return view('emails.emailVerificated');
    }

    public function resendVerificationEmail(Request $request)
    {
        // Handle resending verification email logic
    }
}
