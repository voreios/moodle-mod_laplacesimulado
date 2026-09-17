# moodle-mod_laplacesimulado

Atividade Moodle (`mod_laplacesimulado`) que direciona o aluno, via SSO,
para fazer simulados na plataforma [Laplace](https://www.laplacedigital.com.br/),
mostrando um resumo do desempenho (simulados atribuídos, corrigidos e
média das notas) na própria página da atividade.

Requer Moodle 5.2+ e o plugin
[`local_laplace`](https://github.com/voreios/moodle-local_laplace)
instalado (fornece a sincronização com a Laplace e o cliente das APIs).

## Instalação

Referenciado via `plugins.txt` no repo de infraestrutura
[`buriti_ava`](https://github.com/voreios/buriti_ava), que clona este
repositório numa tag/branch estável em tempo de build.

## Configuração

Ao adicionar a atividade num curso, o professor escolhe o **Exame** da
Laplace (ex.: ENEM) que filtra os simulados e o resumo mostrado ao aluno.
Credenciais e demais configurações da integração ficam em
Site administration > Plugins > Local plugins > Integração Laplace
(`local_laplace`).

## Créditos

Desenvolvido pela [Voreios](https://github.com/voreios) — fabio@voreios.com.br.
