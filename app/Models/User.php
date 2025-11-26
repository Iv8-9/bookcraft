<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Notifications\ResetPassword; 
use Illuminate\Notifications\Messages\MailMessage; 

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * Envía la notificación de restablecimiento de contraseña.
     * Este método anula el comportamiento predeterminado de Laravel
     * para enviar solo el token sin la URL HTML.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new class($token) extends ResetPassword
        {
            /**
             * Crea la representación del mensaje de correo.
             *
             * @param  mixed  $notifiable
             * @return \Illuminate\Notifications\Messages\MailMessage
             */
            public function toMail($notifiable)
            {
                // Devolvemos una instancia deF MailMessage con el contenido simple
                return (new MailMessage)
                    ->subject('Código de Restablecimiento de Contraseña')
                    ->line('Has solicitado el restablecimiento de tu contraseña. Utiliza el siguiente código en tu aplicación móvil:')
                    ->line(' ')
                    // Muestra solo el token
                    ->line('TOKEN DE VERIFICACIÓN: ' . $this->token) 
                    ->line(' ')
                    ->line('Si no solicitaste un restablecimiento de contraseña, ignora este mensaje.');
            }
        });
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}