<?php

class Usuario {
	private $username = "aluno";
	private $nome = "aluno sobrenome"; 
	private $email = "aluno@gmail.com";
	private $password = "senha";

	public function __construct($username, $password) {
		if (!($username === $this->username && $password === $this->password)) {
			throw new Exception("Usuario não existente", 1);
		}
	}

	public function getUserInfo() {
		return [
			'username' => $this->username,
			'nome' => $this->nome,
			'email' => $this->email,
			'password' => $this->password,
		];
	}
}