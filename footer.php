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
    
        <p class="copyright"><?php echo stripslashes($smof_data['footer_text']); ?></p>
       
    </div><!-- .container -->
</footer><!-- #footer -->
<?php wp_footer(); ?>
</body>
</html>