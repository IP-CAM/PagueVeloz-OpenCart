![PagueVeloz](https://www.pagueveloz.com.br/Content/Img/logo-pagueveloz-topo_03.png)

### Como Funciona
**Utilizar o PagueVeloz é muito simples e rápido.**

Depois que você conhecer todas as funcionalidades do PagueVeloz, você vai querer utilizar ele imediatamente. Pode começar a comemorar, pois é exatamente assim que acontece. Basta se cadastrar e começar a utilizar. Tudo sem complicação e sem burocracia!

**E as vantagens não param por aí.**

No caso de pagamentos (boletos e cartões de crédito), assim que o seu cliente efetua o pagamento e o dinheiro aparece na conta do PagueVeloz, você já pode solicitar o resgate do valor que desejar. Dependendo do horário de solicitação do saque, a transferência é feita no mesmo dia ou em, no máximo, 24 horas depois. E se for para pagar contas, o sistema libera o dinheiro na hora em que estiver efetuando o pagamento de sua conta.

**Não perca tempo e comece a utilizar.**

### Nos ajude também
[![Doação](https://www.paypalobjects.com/pt_BR/BR/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=HUBL785QDAXXG)

### Como Instalar em seu OpenCart
<ol>
<li>Acesse seu painel administrativo</li>
<li>Navegue até o menu Extensions > Extension Installer</li>
<li>Envie seu arquivo PagueVeloz.ocmod.zip e aguarde.</li>
<li>Após a instação, vá o menu Extensions > Payments</li>
<li>Procure por "PagueVeloz" e clique no botão verde (Install)</li>
<li>Depois de habilitado clique no botão azul (Edit)</li>
<li>Configure e salve! Pronto.</li>
</ol>

### Descrição de cada campo **
##### Geral
* **Situação:** Habilita/Desabilita o módulo (Formas de Pagamento e envio de SMS)
* **E-mail:** E-mail cadastrado no site https://www.pagueveloz.com.br/
* **Token:** Token de Integração, recebido ao criar sua conta.
* **Zona Geográfica:** Habilita as formas de pagamento para determinado País ou Estado. [Saíba Mais](http://docs.opencart.com/system/localisation/geo-zone/)
* **Ordem:** Ordem de colcação

##### Boleto
* **Situação:** Habilita/Desabilita a forma de pagamento boleto.
* **Vencimento:** Indica quantos dias o cliente terá para efetuar o pagamento.
* **Cedente:** Nome da Empresa.
* **CPF/CNPJ Cendente:** CPF do responsável ou CNPJ da Empresa.
* **Observação:** Instruções para o caixa.
* **Boleto Impresso:** Situação do pedido quando o boleto for cancelado.
* **Cancelado:** Situação do pedido quando o boleto for cancelado.
* **Completo:** Situação  do pedido quando o boleto for pago.

##### SMS
* **Envio de SMS:** Habilita/Desabilita o envio de SMS
* **Celular:** Celular do remetente
* **post.order.add:** Envia SMS para o cliente no ato da compra
* **post.order.edit:** Envia SMS para o cliente quando o pedido for editado
* **post.order.delete:** Envia SMS para o cliente quando o pedido for deletado
* **post.order.history.add:** Envia SMS quando o pedido registrar uma alteração no histórico
* **post.admin.review.edit:** Envia SMS quando um comentário for editado
* **post.review.add:** Envia SMS quando um comentário for adicionado
* **post.admin.affiliate.approve:** Envia SMS comentário quando cadastrado de afiliado for aprovado
* **post.admin.affiliate.transaction.add:** Envia SMS quando houver uma transação (Afiliad)
* **post.affiliate.add:** Envia SMS confirmado cadastrado (Afiliado)
* **post.affiliate.edit:** Envia SMS confirmando alteração (Afiliado)
* **post.customer.add:** Envia SMS confirmado cadastrado (Cliente)
* **post.customer.edit:** Envia SMS confirmando alteração (Cliente)

### Retorno Automático
<ol>
<li>Acesse as configurações do CronJob (Entre em contato com o suporte de sua hospedagem) ou acesse [https://www.setcronjob.com/](https://www.setcronjob.com/)</li>
<li>Cadastre a URL http://www.MY-STORE.com/index.php?route=payment/pagueveloz/callback</li>
<li>Pronto!</li>
</ol>

### Dúvidas? Bug?
#### [http://www.valdeirsantana.com.br](http://www.valdeirsantana.com.br "Valdeir Santana")

### Nos ajude também
[![Doação](https://www.paypalobjects.com/pt_BR/BR/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=HUBL785QDAXXG)

### Download
[http://www.opencart.com/index.php?route=extension/extension/info&extension_id=23083](http://www.opencart.com/index.php?route=extension/extension/info&extension_id=23083)