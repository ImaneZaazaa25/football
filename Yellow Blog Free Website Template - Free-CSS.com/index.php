<?php require("menu.php"); ?>

<section id="content_area">
			<div class="clearfix wrapper main_content_area">
				<?php require("cartes.php"); ?>
			
				<div class="clearfix main_content floatleft">
				
				<?php require("images.php"); ?>
					
					<div class="clearfix content">
						<div class="content_title"><h2>Latest Blog Post</h2></div>
						
						<?php require("articles.php"); ?>
					</div>				
					
					
					<div class="pagination">
						<nav>
							<ul>
								<li><a href=""> << </a></li>
								<li><a href="">1</a></li>
								<li><a href="">2</a></li>
								<li><a href="">3</a></li>
								<li><a href="">4</a></li>
								<li><a href=""> >> </a></li>
							</ul>
						</nav>
					</div>
				</div>
				<div class="clearfix sidebar_container floatright">
				
					<div class="clearfix newsletter">
					<form onsubmit="redirectToRegistration(event)">
    <h2>Inscrivez-vous pour recevoir les alertes de matchs</h2>
    <input type="text" placeholder="Votre nom" id="mce-TEXT" required/>
    <input type="email" placeholder="Votre email" id="mce-EMAIL" required/>
    <input type="submit" value="S'abonner" id="mc-embedded-subscribe"/>
</form>

<script>
function redirectToRegistration(event) {
    event.preventDefault(); // Empêche l'envoi classique du formulaire

    // Récupérer les valeurs des champs
    let nom = document.getElementById('mce-TEXT').value;
    let email = document.getElementById('mce-EMAIL').value;

    // Encoder les valeurs pour les passer en URL
    let url = `inscription.php?nom=${encodeURIComponent(nom)}&email=${encodeURIComponent(email)}`;

    // Rediriger vers la page d'inscription avec les données
    window.location.href = url;
}
</script>

					</div>
					<div class="clearfix sidebar">
						<div class="clearfix single_sidebar">
						<?php require("votes.php"); ?>
</div>
							<?php require("classement.php"); ?>
							</div>
						
                        <?php require("meilleurs_buteurs.php"); ?>

					</div>
				</div>
			</div>
		</section>
		
		<section id="footer_top_area">
    <div class="clearfix wrapper footer_top">
        <div class="clearfix footer_top_container">
            
            <!-- Dernières actualités sur Twitter -->
            <div class="clearfix single_footer_top floatleft">
                <h2>Dernières actualités sur Twitter</h2>
                <p>Restez informé des dernières nouvelles du football ! <a href="https://twitter.com/toncompte">Suivez-nous sur Twitter</a> pour des mises à jour instantanées sur les matchs, les résultats, et plus encore.</p>
            </div>
            
            <!-- Derniers Résultats et Articles -->
            <div class="clearfix single_footer_top floatleft">
                <h2>Derniers Résultats et Articles</h2>
                <p>Découvrez nos derniers articles sur les résultats des matchs et les analyses des performances des équipes. <a href="">Cliquez ici pour lire plus</a>.</p>
            </div>
            
            <!-- Liens Utiles -->
            <div class="clearfix single_footer_top floatleft">
                <h2>Liens Utiles</h2>
                <ul>
                    <li><a href="">Suivi des résultats en direct</a></li>
                    <li><a href="">Classements et Statistiques</a></li>
                    <li><a href="">Calendrier des prochains matchs</a></li>
                    <li><a href="">Dernières nouvelles du marché des transferts</a></li>
                    <li><a href="">Forum de discussion des fans</a></li>
                    <li><a href="">Vidéo des meilleurs moments</a></li>
                </ul>
            </div>

        </div>
    </div>
</section>

<section id="footer_bottom_area">
    <div class="clearfix wrapper footer_bottom">
        <div class="clearfix copyright floatleft">
            <p>Copyright &copy; Tous droits réservés par <span>YellowFoot.com</span></p>
        </div>
        <div class="clearfix social floatright">
            <ul>
                <li><a class="tooltip" title="Facebook" href="https://www.facebook.com/YellowFoot"><i class="fa fa-facebook-square"></i></a></li>
                <li><a class="tooltip" title="Twitter" href="https://twitter.com/YellowFoot"><i class="fa fa-twitter-square"></i></a></li>
                <li><a class="tooltip" title="Instagram" href="https://instagram.com/YellowFoot"><i class="fa fa-instagram"></i></a></li>
                <li><a class="tooltip" title="YouTube" href="https://www.youtube.com/YellowFoot"><i class="fa fa-youtube-square"></i></a></li>
                <li><a class="tooltip" title="RSS Feed" href=""><i class="fa fa-rss-square"></i></a></li>
            </ul>
        </div>
    </div>
</section>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.0.min.js"></script>    
<script type="text/javascript" src="js/jquery.tooltipster.min.js"></script>        
<script type="text/javascript">
    $(document).ready(function() {
        $('.tooltip').tooltipster();
    });
</script>

<script type="text/javascript" src="js/selectnav.min.js"></script>
<script type="text/javascript">
    selectnav('nav', {
      label: '-Navigation-',
      nested: true,
      indent: '-'
    });
</script>

<script src="js/pgwslider.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.pgwSlider').pgwSlider({
            intervalDuration: 5000
        });
    });
</script>

<script type="text/javascript" src="js/placeholder_support_IE.js"></script>

<!--
---- Clean html template by http://WpFreeware.com
---- This is the main file (index.html).
---- You are allowed to change anything you like. Find out more Awesome Templates @ wpfreeware.com
---- Read License-readme.txt file to learn more.
-->
