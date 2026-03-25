# SemanEnC PHP Registration

> Web-based event registration and certificate generation system, built in PHP for the 5th SemanEnC (November 2007).

A **PHP 4/5** web application with **MySQL** backend, used to manage online registration, mini-course enrollment, and certificate generation for the **V Semana de Engenharia Civil (SemanEnC 5)** at Universidade Estadual de Goias (UEG), Anapolis campus.

This system replaced the Delphi desktop application (by Marcell Flavio & Charles D'Richer, source in [movimento-estudantil-ueg](https://github.com/VitorMRodovalho/movimento-estudantil-ueg)) used at SemanEnC 4 (2006), moving the registration process from on-site Windows PCs to a web interface accessible from anywhere. It ran on the UEG database server (`dbase.ueg.br`) alongside the department portal.

## Features

- **Student registration** with validation (name, DOB, contact, university, course, mini-course selection)
- **Mini-course management** with enrollment tracking and capacity counting
- **Certificate generation** in multiple formats: LaTeX (.tex) for printed certificates, plain text for labels, HTML for material delivery lists and attendance sheets
- **Session-based authentication** with role-based access (`usuario` role required for admin pages)
- **Search** with simple and advanced query modes

## Project Structure

```
index.php                      Entry point / redirect
login.php                      Session-based authentication
validacoes/
  validacao.php                Session verification and role checking
conexao/
  conexao.php                  MySQL connection (credentials REDACTED)

cadastro_alunos.php            Student registration form (with JS validation)
cadastro_alunos_acao.php       Registration form handler (INSERT/UPDATE)
cadastro_alunos_alterar.php    Edit existing registration
cadastro_alunos_excluir.php    Delete registration
cadastro_alunos_pesquisa.php        Simple search form
cadastro_alunos_pesquisa_acao.php   Simple search handler
cadastro_alunos_pesquisa_avancada.php      Advanced search form
cadastro_alunos_pesquisa_avancada_acao.php Advanced search handler
cadastro_alunos_carne_criar.php     Generate payment booklet
cadastro_alunos_carne_ver.php       View payment booklet

minicursos.php                 Mini-course enrollment statistics
preco.php                      Pricing/fee configuration

gerar_certificado.php          Certificate generation dispatcher
certificado/
  chamados_certificado.tex     LaTeX certificate template
  chamados_certificado.txt     Plain text certificate/label template
  lista_kit1-12.htm            Material delivery list per mini-course (12 courses)
  lista_Pres_Mini1-12.htm      Attendance sheet per mini-course (12 courses)

mestre_cadastro.php            Master registration page (frame layout)
mestre_acao_cadastro.php       Master action handler
superior.php                   Header/navigation bar
inicio.php                     Dashboard/landing page after login
index2.php                     Alternative entry point
data.php                       Date utilities
erro.php                       Error display page

estilocss/
  engcivil.css                 Main stylesheet
  [additional CSS files]
imagens/
  [event logos and UI images]
```

## How It Works

### Authentication Flow
1. `login.php` creates a session with a unique token
2. `validacoes/validacao.php` checks session validity on every protected page
3. Pages declare their required access level: `$restrita="usuario"`
4. `logout.php` destroys the session

### Registration Flow
1. `cadastro_alunos.php` renders a form with client-side JavaScript validation
2. On submit, `cadastro_alunos_acao.php` handles the INSERT via `mysql_query()`
3. Students select a mini-course during registration
4. `minicursos.php` shows real-time enrollment counts per course

### Certificate Generation
`gerar_certificado.php` dispatches to different output formats based on the `?acao=` parameter:
- `gerar_certificado` — Plain text labels for printing
- `gerar_lista_tex` — LaTeX source for formal certificates
- `gerar_lista` — HTML material delivery checklists (12 mini-courses)
- `gerar_lista_presenca` — HTML attendance sheets (12 mini-courses)

## Tech Stack

- **Language:** PHP 4/5
- **Database:** MySQL (on UEG's `dbase.ueg.br` server)
- **Output formats:** HTML, LaTeX (.tex), plain text
- **Authentication:** PHP sessions with token-based verification
- **Encoding:** ISO-8859-1
- **Browser target:** IE6/7, Firefox 2 (2007 era)

## Credential Sanitization

`conexao/conexao.php` had MySQL credentials for the UEG database server. All values replaced with `REDACTED`.

## Related Repositories

- [movimento-estudantil-ueg](https://github.com/VitorMRodovalho/movimento-estudantil-ueg) — Full SemanEnC 5 context: event photos, marketing materials, conference documentation
- [movimento-estudantil-ueg/.../Semanenc/](https://github.com/VitorMRodovalho/movimento-estudantil-ueg) — The Delphi predecessor from SemanEnC 4 (2006), by Marcell Flavio & Charles D'Richer
- [engenharia-civil-ueg](https://github.com/VitorMRodovalho/engenharia-civil-ueg) — The department portal hosting `engenhariacivil.ueg.br/semana/`

## License

MIT. See the parent repository for full conference context.

---

# SemanEnC PHP Registration (PT-BR)

Sistema web em **PHP 4/5** para inscricao online e geracao de certificados da **V Semana de Engenharia Civil (SemanEnC 5)**, UEG Anapolis (Novembro 2007).

Substituiu o aplicativo desktop Delphi (por Marcell Flavio & Charles D'Richer, em [movimento-estudantil-ueg](https://github.com/VitorMRodovalho/movimento-estudantil-ueg)) da SemanEnC 4, movendo o processo de inscricao para a web. Funcionalidades: cadastro de alunos com validacao, gestao de minicursos, geracao de certificados (LaTeX), listas de presenca e entrega de materiais (HTML), autenticacao por sessao.

Credenciais MySQL em `conexao/conexao.php` foram substituidas por `REDACTED`.
