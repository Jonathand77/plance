<?php

namespace Plance\Tests\Services\Auth;

use Plance\Services\Auth\AuthService;
use Plance\Services\Auth\Exceptions\DuplicateUserException;
use Plance\Services\Auth\Exceptions\InvalidCredentialsException;
use Plance\Services\Auth\Exceptions\UserNotFoundException;
use Plance\Services\Auth\Exceptions\ValidationException;
use Plance\Tests\Doubles\InMemoryUserRepository;
use PHPUnit\Framework\TestCase;

class AuthServiceTest extends TestCase
{
    private InMemoryUserRepository $users;
    private AuthService $auth;

    protected function setUp(): void
    {
        $this->users = new InMemoryUserRepository();
        $this->auth = new AuthService($this->users);
    }

    public function testLoginThrowsValidationExceptionOnEmptyFields(): void
    {
        $this->expectException(ValidationException::class);
        $this->auth->login('', '');
    }

    public function testLoginThrowsUserNotFoundException(): void
    {
        $this->expectException(UserNotFoundException::class);
        $this->auth->login('no-existe@example.com', 'algo');
    }

    public function testLoginThrowsInvalidCredentialsException(): void
    {
        $this->users->create([
            'id' => 1,
            'nombre' => 'Ana Perez',
            'correo' => 'ana@example.com',
            'usuario' => 'anap',
            'contrasena_hash' => password_hash('Secreta1!', PASSWORD_DEFAULT),
        ]);

        $this->expectException(InvalidCredentialsException::class);
        $this->auth->login('ana@example.com', 'clave-incorrecta');
    }

    public function testLoginSucceedsWithValidCredentials(): void
    {
        $this->users->create([
            'id' => 1,
            'nombre' => 'Ana Perez',
            'correo' => 'ana@example.com',
            'usuario' => 'anap',
            'contrasena_hash' => password_hash('Secreta1!', PASSWORD_DEFAULT),
        ]);

        $user = $this->auth->login('ana@example.com', 'Secreta1!');

        $this->assertSame('anap', $user['usuario']);
    }

    public function testRegisterThrowsValidationExceptionForWeakPassword(): void
    {
        $this->expectException(ValidationException::class);

        $this->auth->register([
            'id' => '123',
            'nombre' => 'Ana Perez',
            'correo' => 'ana@example.com',
            'usuario' => 'anap',
            'contrasena' => 'corta',
        ]);
    }

    public function testRegisterThrowsDuplicateUserExceptionForExistingEmail(): void
    {
        $this->users->create([
            'id' => 1,
            'nombre' => 'Ana Perez',
            'correo' => 'ana@example.com',
            'usuario' => 'anap',
            'contrasena_hash' => password_hash('Secreta1!', PASSWORD_DEFAULT),
        ]);

        $this->expectException(DuplicateUserException::class);

        $this->auth->register([
            'id' => '999',
            'nombre' => 'Otra Persona',
            'correo' => 'ana@example.com',
            'usuario' => 'otrousuario',
            'contrasena' => 'Secreta1!',
        ]);
    }

    public function testRegisterSucceedsWithValidData(): void
    {
        $this->auth->register([
            'id' => '123',
            'nombre' => 'Ana Perez',
            'correo' => 'ana@example.com',
            'usuario' => 'anap',
            'contrasena' => 'Secreta1!',
        ]);

        $this->assertTrue($this->users->existsByEmail('ana@example.com'));
    }
}
