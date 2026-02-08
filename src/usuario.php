<?php

    class Usuario{
        private string $nome;
        private string $email;
        private string $telefone;
        private string $senha;

        public function __construct (string $nome, string $senha, string $email, string $telefone) {
            $this->nome = $nome;
            $this->senha = $senha;
            $this->email = $email;
            $this->telefone = $telefone;
        } 


        public function setNome (string $nome) { 
            $this->nome = $nome;
        }
        public function setSenha (string $senha) { 
            $this->senha = $senha;
        }
        public function setEmail (string $email) { 
            $this->email = $email;
        }
        public function setTelefone (string $telefone) { 
            $this->telefone = $telefone;
        }

        public function getTelefone () : string  { 
            return $this->telefone;
        }

        public function getEmail () : string  { 
            return $this->email;
        }

        public function getSenha () : string { 
            return $this->senha;
        }

        public function getNome () : string { 
            return $this->nome;
        }
    }
?>