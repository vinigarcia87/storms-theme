<?php
/**
 * Storms Websolutions (http://storms.com.br/)
 *
 * @author    Vinicius Garcia | vinicius.garcia@storms.com.br
 * @copyright (c) Copyright 2012-2020, Storms Websolutions
 * @license   GPLv2 - GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package   Storms
 * @version   4.0.0
 *
 * Footer Content Template
 * The content of the footer
 */

defined( 'ABSPATH' ) || exit;

// Get how many footer sidebars are defined for this website
$numFooterSidebars = \StormsFramework\Helper::get_option( 'storms_number_of_footer_sidebars', 4 );
// Get how many sidebars are active
$numActiveFooterSidebars = 0;
for( $i = 1; $i <= $numFooterSidebars; $i++ ) {
    if ( is_active_sidebar( 'footer-sidebar-' . intval( $i ) ) )
        $numActiveFooterSidebars++;
}
if ( ( $numFooterSidebars > 0 ) && ( $numActiveFooterSidebars > 0 ) ) : ?>
    <div class="footer-sidebar st-grid-row row" role="complementary">
        <?php for( $i = 1; $i <= $numFooterSidebars; $i++ ): ?>
            <?php if ( is_active_sidebar( 'footer-sidebar-' . $i ) ) : ?>

                <?php
                // Dividimos 12 (num de colunas do bootstrap) pelo num de sidebars que usaremos (usando inteiros)
                // Assim, cada div tera o mesmo tamanho...
                $col_size = intval( 12 / $numActiveFooterSidebars );
                // Porem, nem sempre temos um numero de sidebars divisivel por 12, entao
                // Se o numero de colunas calculadas nao alcançou 12...
                if($col_size * $numActiveFooterSidebars < 12) {
                    // ... Verificamos quantas faltam para distribuir o restante entre a primeira e a ultima sidebars
                    $diff = 12 - $col_size * $numActiveFooterSidebars;

                    // Options: first_div: Diferença fica na primeira div; last_div: Diferença fica na ultima div; first_last_div: Diferença eh dividida entre a primeira e a ultima div;
                    $diff_place = \StormsFramework\Helper::get_option( 'storms_footer_diff_place', 'first_last_div' );

                    // Incluimos a diferença na ultima div
                    if( $diff_place == 'last_div' ) {

                        // Adicionamos a diferença a ultima div
                        if($i == $numActiveFooterSidebars) {
                            $col_size += $diff;
                        }

                    } else
                        // Incluimos a diferença na primeira div
                        if( $diff_place == 'first_div' ) {

                            // Adicionamos a diferença a primeira div
                            if($i == 1) {
                                $col_size += $diff;
                            }

                        } else
                            // Dividimos a diferença entre a primeira e a ultima div
                            if( $diff_place == 'first_last_div' ) {

                                // Verificamos se faltou um numero par ou impar
                                if($diff % 2 == 0) {
                                    // Se faltou um numero par, dividimos e adicionamos a diferença a primeira e a ultima div
                                    if($i == 1) {
                                        $col_size += $diff / 2;
                                    }
                                    if($i == $numActiveFooterSidebars) {
                                        $col_size += $diff / 2;
                                    }
                                } else {
                                    // Se faltou um numero impar, adicionamos a diferença a ultima div
                                    if($i == $numActiveFooterSidebars) {
                                        $col_size += $diff;
                                    }
                                }

                            }
                }

                $col_size_css = 'footer-col-'. intval( $i ) . ' ' . \StormsFramework\Helper::get_option( 'storms_footer_size_col_' . intval( $i ), 'col-md-' . $col_size );
                ?>

                <div class="<?php echo $col_size_css; ?>">
                    <?php if ( is_active_sidebar( 'footer-sidebar-' . intval( $i ) ) ) : ?>
                        <section class="footer-sidebar-<?php echo intval( $i ); ?>">
                            <?php dynamic_sidebar( 'footer-sidebar-' . intval( $i ) ); ?>
                        </section>
                    <?php endif; ?>
                </div>

            <?php endif; ?>
        <?php endfor; ?>
    </div>
<?php endif; ?>
