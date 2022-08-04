<?php

namespace Library\Auth;


class Authenticate
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }    
    }

	public function getId(): ?int
	{
		if (isset($_SESSION['user_id'])) {
			return $_SESSION['user_id'];
		}
		return null;
	}


    
    public function login(int $id): void
    {
        $_SESSION['user_id'] = $id;
    }
    
    public function logout(): void
    {
        unset($_SESSION['user_id']);
        session_destroy();
    }
    
    public function isAuthenticated(): bool
    {
        return isset($_SESSION['user_id']);
    }


	public function isAdmin(): bool
	{
		return isset($_SESSION['admin']);

	}






}