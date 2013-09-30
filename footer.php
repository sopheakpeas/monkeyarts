<?php
/**
 * The template for displaying footer.
 *
 * Contains secondary widget areas, footer content and the closing of the
 * #main and #page div elements.
 */

global $smof_data ?>

    
</div> <!-- #wrapper -->
<footer id="footer" role="contentinfo">
    	
    <div class="container clearfix">
    
        <p class="copyright">
        <?php if($smof_data['footer_text']) : 
       		echo $smof_data['footer_text']; 
        endif; ?>
        </p>
       
    </div><!-- .container -->
</footer><!-- #footer -->

<div id="lightwindow">
    <div id="lightwindow-content"></div>
</div>

<?php wp_footer(); ?>
</body>
</html>