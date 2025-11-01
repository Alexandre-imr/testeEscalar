# 🚀 Teste Prático - Text-to-Speech com Laravel

Este é um projeto simples desenvolvido para um teste prático de estágio. A aplicação permite que um usuário digite um texto, que é então processado por uma API externa (Google Text-to-Speech) e reproduzido em áudio.

## 🚀 Instruções de Instalação e Execução

Siga os passos abaixo para executar o projeto em seu ambiente local.

### Requisitos

-   PHP >= 8.1
-   Composer

### 🛠️ Versões Utilizadas

-   **Framework:** Laravel `v10.3.3`
-   **Linguagem:** PHP `8.1.10`

---

1.  **Clone o repositório:**
    (Lembre-se de trocar pela URL do seu repositório)

    ```bash
    git clone https://github.com/SEU-USUARIO/testeEscalar.git
    cd testeEscalar
    ```

2.  **Instale as dependências do Composer:**

    ```bash
    composer install
    ```

3.  **Configure o arquivo de ambiente:**
    Copie o arquivo de exemplo `.env.example` para um novo arquivo chamado `.env`.

    ```bash
    cp .env.example .env
    ```

4.  **Gere a chave da aplicação Laravel:**
    Isso é crucial para a segurança do projeto.

    ```bash
    php artisan key:generate
    ```

5.  **Inicie o servidor de desenvolvimento:**

    ```bash
    php artisan serve
    ```

6.  **Acesse a aplicação:**
    Abra seu navegador e acesse a URL fornecida pelo servidor:
    [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 💡 Desafios Encontrados e Soluções

Durante o desenvolvimento, enfrentei um desafio interessante com a integração da API de voz.

### 1. O Problema: Player de Áudio Zerado (0:00)

Minha primeira tentativa foi passar a URL da API do Google Text-to-Speech diretamente para a tag `<audio>` no HTML. No entanto, isso fazia com que o player aparecesse com o tempo zerado (0:00) e não tocava som.

### 2. O Diagnóstico

Após investigar, descobri que isso é causado por uma proteção de segurança da Google chamada "hotlinking protection". O servidor do Google se recusa a enviar o arquivo de áudio para um domínio que não seja o dele (como o meu ambiente local, `127.0.0.1`).

### 3. A Solução Implementada

Para resolver isso, mudei a arquitetura:

1.  Em vez do navegador, agora é o **servidor Laravel (PHP)** que faz a requisição para a API do Google usando `Http::get()`.
2.  O servidor recebe os dados do áudio e os salva como um arquivo físico na pasta `public/audio/latest.mp3`.
3.  A view (Blade) recebe a URL desse **arquivo local** (`asset('audio/latest.mp3')`).

Isso resolveu o problema, pois o navegador carrega o áudio de um domínio que ele confia (o próprio servidor da aplicação) e o Google nunca bloqueia a requisição do meu backend.
