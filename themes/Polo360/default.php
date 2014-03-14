<!DOCTYPE html>

<html>	
	<head>
		<!-- CSS IMPORT -->
		<link rel="stylesheet" type="text/css" href="<?=$this->getThemePath()?>/CSS/base-min.css" />
		<link rel="stylesheet" type="text/css" href="<?=$this->getThemePath()?>/CSS/grid-min.css" />
		<link rel="stylesheet" type="text/css" href="<?=$this->getThemePath()?>/CSS/polo.css" />
		
		<!-- Header - Footer Concrete 5 -->
		<?php 
			Loader::element('header_required'); 
			Loader::element('footer_required'); 
		?>
	</head>
	
	<title>
		Polo roissanssoissante
	</title>
	
	<body>
		<div class="container" id="ptmargin">
			<div class="pure-g">
				<div class="pure-u-1-3">
					<!-- Concrete 5 Logo Area -->
					<?php
						$a = new GlobalArea('Logo');
						$a->display($c);
					?>
				</div>
				<div class="pure-u-2-3">
					<!-- Concrete 5 Menu Area -->
					<?php
						$a = new GlobalArea('Menu');
						$a->display($c);
					?>
          		</div> <!-- End of the Pure-u-2-3 DIV -->
			</div> <!-- End of the Purge-g DIV -->
	    </div> <!-- End of the Container / ptmargin DIV -->
		
		<div id="backblack">
			<div class="container">
				<div class ="diaporama">
					<!-- Concrete 5 Slider Area -->
					<?php
						$a = new GlobalArea('Banniere');
						$a->display($c);
					?>
				</div> <!-- End of the diaporama DIV -->
			</div> <!-- End of the Container DIV -->
		</div> <!-- End of the backblack DIV -->
		
		<div id="txtban">
			<!-- Sentence Below the Concrete 5 Slider -->
			Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.
			<hr class="container"></hr>
		</div>
	
		<div class="container">
			<!-- Concrete 5 3col Area -->
			<?php
				$a = new Area('3col');
				$a->display($c);
			?>
			<br/> <br/> <hr class="container"></hr>
			<div class="pure-g">
				<div class="pure-u-1-3">
					<div id="borderbottom">
						<H3>Social Connection</H3>
						<div id="borderfeed"></div>
						<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</p>
						<!-- Concrete 5 Social Connection Area -->
						<?php
							$a = new GlobalArea('SocialCo');
							$a->display($c);
						?>
						<div class="marginbloc"></div>
						<H3>Newsletter</H3>
						<div id="borderfeed"></div>
						<p>Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</p>
						<!-- Concrete 5 Newsletter Area -->
						<?php
							$a = new GlobalArea('Newsletter');
							$a->display($c);
						?>
					</div>
				</div>
			
				<div class="pure-u-1-3">
					<H3>Contact</H3>
					<!-- Concrete 5 Contact Area -->
				    <?php
						$a = new GlobalArea('Contact');
						$a->display($c);
					?>
				</div>
			
				<div class="pure-u-1-3">
					<H3>News Updates</H3>
					<!-- Concrete 5 News Area -->
				    <?php
						$a = new GlobalArea('News');
						$a->display($c);
					?>
				</div> <!-- End of the pure-u-1-3 DIV -->
			</div> <!-- End of the Pure-G DIV -->
	    </div> <!-- End of the Container DIV -->
	</body>
</html>