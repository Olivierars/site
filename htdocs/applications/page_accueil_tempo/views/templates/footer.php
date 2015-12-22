<br><br>



<!-- jQuery -->
<!-- <script src="/assets/js/jquery.js"></script>
 --><!-- A MODIFIER LORS DU PASSAGE EN PROD pour ne plus l'avoir en local -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<!-- Lien faire les fichiers js  -->
<script src="/assets/js/test.js"></script>

<!-- AJAX  --> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>


<!-- Bootstrap -->
<script src="/assets/js/bootstrap.js"></script>

<script type="text/javascript"> 
	$(document).ready(function()
	{ 
    /**
     * Clic sur le diaporama
     * @return {[type]} [description]
     
    $("#exemple-diaporama").click( function(){ 
         
        $("#exemple-diaporama").carousel("pause"); // met en pause le défilement des photos
        $("#exemple-diaporama").carousel("cycle"); // reprend défilement des photos
          
    }); */

    /**
     * Clic sur le boutons play du diaporama
     * @return {[type]} [description]
     */
    $('#BtnPlay').click(function ()
    {
        $('#exemple-diaporama').carousel('cycle');
    });


    /**
     * Clic sur le boutons play du diaporama
     * @return {[type]} [description]
     */
    $('#BtnPause').click(function ()
    {
        $('#exemple-diaporama').carousel('pause');
    });


}); 
</script>

</body>
</html>