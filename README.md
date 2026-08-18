# Coliseum Roster System

Este projeto consiste no desenvolvimento de um sistema web para gerenciamento de lutadores, inspirado no Coliseu do jogo *Like a Dragon Gaiden*.  
O sistema foi construído utilizando PHP e arquitetura MVC, permitindo realizar operações completas de listagem, cadastro, edição, exclusão, busca e ordenação de lutadores.  
O objetivo principal é aplicar conceitos fundamentais de desenvolvimento web, organização modular e persistência de dados em um contexto acadêmico.

---

## Começando

As instruções abaixo permitirão que você obtenha uma cópia do projeto funcionando em sua máquina local para fins de estudo, desenvolvimento e teste.

Consulte a seção **Implantação** para saber como publicar o sistema em um ambiente ativo.

---

## Pré-requisitos

Para rodar o Coliseum Roster System, você precisará dos seguintes softwares:

- **XAMPP** ou similar contendo:
  - Apache (servidor web)
  - PHP 7+  
  - MySQL/MariaDB
- Navegador atualizado (Chrome, Edge, Firefox etc.)

### Exemplos

1. Baixar XAMPP em:  
   https://www.apachefriends.org  
2. Iniciar os módulos **Apache** e **MySQL**  
3. Acessar o phpMyAdmin para criação do banco de dados  

---

## Instalação

A seguir, um passo a passo completo para preparar o projeto em ambiente local:

### 1. Clone o repositório

```bash
git clone https://github.com/SEU_USUARIO/SEU_REPOSITORIO.git
````

### 2. Mova o projeto para o diretório do Apache

Exemplo em XAMPP (Windows):

```
C:/xampp/htdocs/coliseum-roster-system/
```

### 3. Crie o banco de dados

Acesse o phpMyAdmin:

```
http://localhost/phpmyadmin
```

Crie um banco (ex.: `coliseu_db`) e importe a tabela:

```sql
CREATE TABLE lutadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_ringue VARCHAR(100) NOT NULL,
    nome_real VARCHAR(100) NOT NULL,
    estilo VARCHAR(50) NOT NULL,
    afiliacao VARCHAR(50) NOT NULL,
    vitorias INT DEFAULT 0,
    derrotas INT DEFAULT 0,
    empates INT DEFAULT 0,
    health INT DEFAULT 500,
    attack INT DEFAULT 500,
    defense INT DEFAULT 500,
    agility INT DEFAULT 500
);
```

### 4. Configure o acesso ao banco

Abra em um editor de código:

```
Conexao.php
```

E ajuste:

```php
$hostname = 'localhost';
$dbusername = 'root';
$password = '';
$database = 'coliseu_db';
```

### 5. Execute o sistema

No navegador, acesse:

```
http://localhost/coliseum-roster-system/
```

### Testando rapidamente

* Cadastre um novo lutador
* Verifique sua aparição na tabela
* Edite atributos
* Teste busca por ID
* Ordene por ataque, defesa, agilidade ou winrate

---

## Executando os testes

O sistema utiliza testes **manuais** como forma de validar seu funcionamento, por ser um projeto acadêmico.

### Exemplos de testes funcionais:

* Criar um lutador e verificar se aparece na listagem
* Editar dados e confirmar atualização no banco
* Excluir um lutador e conferir remoção na tabela
* Testar validações de formulário no front-end
* Ordenar por atributos e verificar consistência

---

## Testes de ponta a ponta

Testes de ponta a ponta asseguram que o fluxo completo entre:

**Interface → Controller → DAO → Banco de dados → View**

está funcionando corretamente.

### Exemplos:

* Criar → Listar → Editar → Excluir
* Testar busca por ID inexistente
* Verificar ordenação por winrate
* Garantir que a UI responde conforme esperado

---

## Testes de estilo e validação de código

Servem para manter:

* Padrão de escrita
* Clareza e legibilidade
* Correta separação entre lógica e apresentação (conceitos MVC)
* Ausência de repetições desnecessárias

### Exemplos:

* Conferir se o Controller não tem lógica de apresentação
* Conferir se a View não contém lógica de negócio
* Revisar CSS e JS para evitar duplicações

---

## Implantação

Para colocar o sistema em produção, recomenda-se:

* Hospedagem com suporte a PHP e MySQL
* Ajuste das credenciais do banco em `LutadorDAO.php`
* Criação do banco remoto
* Subida dos arquivos via SFTP, FTP ou Git Deploy
* Permissões de leitura e escrita configuradas corretamente

---

## Construído com

Ferramentas utilizadas no desenvolvimento:

* **PHP** – Lógica de aplicação
* **MySQL/MariaDB** – Banco de dados
* **Apache** – Servidor web
* **HTML5 e CSS3** – Interface
* **JavaScript** – Validações e interação
* **Padrão MVC** – Organização do sistema


---

## Autores

* **Ian Goor** – Desenvolvimento – @[PREENCHER]
* **Leonardo Hideki Nakayama Silva** – Desenvolvimento – @[PREENCHER]

---

## Licença

Este projeto **não possui licença pública**.
Todos os direitos são reservados aos autores.
O uso do código, parcial ou total, só é permitido mediante autorização dos criadores.
