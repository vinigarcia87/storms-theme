
# Excluir do cache as paginas do WooCommerce:

/cart
/my-account
/checkout
/carrinho
/minha-conta
/finalizar-compra

https://docs.woocommerce.com/document/configuring-caching-plugins/
Note, WC 1.4.2+ sets the DONOTCACHEPAGE constant which means you don't need to add those pages to WP Super Cache

## Varnish

if (req.url ~ "^/(cart|my-account|checkout|addons)") {
 return (pass);
 }
if ( req.url ~ "\?add-to-cart=" ) {
 return (pass);
 }


# WP Super Cache

https://wordpress.org/plugins/wp-super-cache/#faq-header

- [CHECK] Reconstrução do cache. Serve um arquivo super cache a usuários anônimos enquanto está sendo gerado um novo arquivo. (Recomendado)
- [CHECK] 304 Cache do navegador. Melhora o desempenho do site, verificando se a página foi alterada desde a última vez que o navegador a solicitou. (Recomendado)
- [CHECK] Verificações extra da página inicial. (muito ocasionalmente pára o cache da página inicial) (Recomendado)



