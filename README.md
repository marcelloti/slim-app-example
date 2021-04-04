# webapp_php7_fpm_nginx

<p><b>Requisitos:</b></p>
<p>- Ambiente linux</p>
<p>- docker</p>
<p>- docker-compose</p>
<br/>
<p><b>Executando o projeto:</b></p>
<code>
<p>git clone https://github.com/marcelloti/slim-app-example</p>
<p>cd slim-app-example/docker</p>
<p>docker-compose build</p>
<p>docker-compose up -d</p>
</code>
<br/>
<p>Em seguida acesse o terminal do container "exampleapp" e execute os seguintes comandos:
<code>
<p>composer install</p>
<p>php console migration:run -e default</p>
<p>php console migration:seed:run -e default</p>
</code>
<br/>
<p>Este projeto contém subscribers que são os consumers para filas.</p>
<p>Para consumir os endpoints primeiro é necessário subir os subscribers.</p>
<p>Execute o seguinte comando dentro do terminal do container exampleapp para subir o subscriber de notificações:</p>
<code>
<p>php console subscriber Transactions::Notifications</p>
</code>
<br/>
<p>Este projeto também conta com o Swagger UI que contém a documentação da API do projeto.</p>
<p>Em caso de atualização dos endpoints, basta rodar o comando:</p>
<code>
<p>php console updateapidoc</p>
</code>
<p>Não é necessário reiniciar o container do Swagger UI para verificar as atualizações</p>
<br/>
<p><b>Executando testes:</b></p>
<p>
    Antes de rodar os testes certifique-se de executar as migrations e seeds para o ambiente
    de testes. O ambiente de testes usará o SQLite. Execute os seguintes comandos (dentro do terminal do container exampleapp):<br/>
    <br/>
    <code>
    php console migration:run -e testing<br/>
    php console migration:seed:run -e testing
    </code>
</p>
<br/>
<p>Para a execução dos testes:</p>
<p>1- Acesse o terminal do container exampleapp</p>
<br>
<p>2- Inicialize os subscribers (consumers) de testes com: </p>
<p><code>php console subscriber Core::Test</code></p>
<br/>
<p>3- Em outro terminal dentro do container exampleapp execute o comando "<code>phpunit</code>" no diretório /var/www/code</p>
<br/>
<br/>
<p><b>Melhorias sugeridas para a arquitetura atual:</b></p>
<p>- Tornar carregamento de rotas em novos módulos automático</p>
<p>- Automatizar a inicialização dos serviços</p>
<p>- Remoção da injeção direta do ORM Eloquent nos Models</p>
<p>- Mais testes (principalmente nas camadas "Core" da aplicação)</p>
<p>- Como os testes são executados com o SQLite algumas verificações e etapas diferentes são executadas para o banco SQLite (como por exemplo a não manipulação de TRIGGERS). Isto pode
diminuir a confiabilidade dos testes. Todavia a abordagem de testes com Mocks também têm suas desvantagens. Talvez alguma abordagem híbrida possa ser abordada em um ambiente intermediário
entre os testes e o ambiente default.</p>