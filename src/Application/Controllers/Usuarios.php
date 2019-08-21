<?php
declare(strict_types=1);

namespace App\Application\Controllers;

use Psr\Http\Message\ResponseInterface as Response;

class Usuarios extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $pdo = $this->con->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM Usuarios");
        $stmt->execute();
        $data = $stmt->fetchall();
        $payload = json_encode($data);
        $this->response->getBody()->write($payload);
        return $this->response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(201);
    }
}
