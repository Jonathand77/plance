<?php

namespace Plance\Tests\Repositories;

use Plance\Repositories\UserRepository;
use PDO;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    private UserRepository $repository;

    protected function setUp(): void
    {
        $pdo = new PDO('sqlite::memory:');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec(
            'CREATE TABLE users (
                id INTEGER PRIMARY KEY,
                nombre TEXT NOT NULL,
                correo TEXT NOT NULL,
                usuario TEXT NOT NULL,
                "contraseña" TEXT NOT NULL,
                profile_image TEXT NOT NULL,
                location TEXT NOT NULL,
                bio TEXT NOT NULL
            )'
        );

        $this->repository = new UserRepository($pdo);
    }

    public function testCreateAndFindByEmail(): void
    {
        $this->repository->create([
            'id' => 1,
            'nombre' => 'Ana Perez',
            'correo' => 'ana@example.com',
            'usuario' => 'anap',
            'contrasena_hash' => password_hash('Secreta1!', PASSWORD_DEFAULT),
        ]);

        $user = $this->repository->findByEmail('ana@example.com');

        $this->assertNotNull($user);
        $this->assertSame('anap', $user['usuario']);
    }

    public function testFindByEmailReturnsNullWhenMissing(): void
    {
        $this->assertNull($this->repository->findByEmail('no-existe@example.com'));
    }

    public function testExistsByUsername(): void
    {
        $this->repository->create([
            'id' => 2,
            'nombre' => 'Beto Ruiz',
            'correo' => 'beto@example.com',
            'usuario' => 'betor',
            'contrasena_hash' => password_hash('Secreta1!', PASSWORD_DEFAULT),
        ]);

        $this->assertTrue($this->repository->existsByUsername('betor'));
        $this->assertFalse($this->repository->existsByUsername('nadie'));
    }
}
