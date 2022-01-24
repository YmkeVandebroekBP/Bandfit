<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=IE9,chrome=1">
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<meta name="theme-color" content="#23722F"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.7/vue.min.js"></script>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> class="bg-darkmuted">

<?php $user = wp_get_current_user(); 
$user_id = $user->ID;
?>


<div class="main-wrapper bg-darkmuted">
	
	<header id="main-header" class="bg-vibrant site-header" role="banner">
		<img src="/wp-content/themes/bandfit/img/bandfit-logo-wit.png)">
		<div id="webapp_cover">
		  <div id="menu_button">
		    <input type="checkbox" id="menu_checkbox">
		    <label for="menu_checkbox" id="menu_label">
		      <div id="menu_text_bar"></div>
		    </label>
		  </div>
		</div>
		<div id="header-nav">  
			<ul id="header-nav-ul" class="header-nav-dicht">
				<li class="header-nav-li header-nav-dicht-li"><a href="http://bandfit.local/dashboard/">Dashboard</a></li>
				<?php echo '<li class="header-nav-li header-nav-dicht-li"><a href="http://bandfit.local/user-'  . $user->ID . '/">Openbaar profiel</a></li>'; ?>
				<?php echo '<li class="header-nav-li header-nav-dicht-li"><a href="http://bandfit.local/band-user-'  . $user->ID . '/">Openbare bandpagina</a></li>'; ?>
				<li class="header-nav-li header-nav-dicht-li"><a href="http://bandfit.local/zoek-bands/">Zoeken naar bands</a></li>
				<li class="header-nav-li header-nav-dicht-li"><a href="http://bandfit.local/zoek-muzikanten/">Zoeken naar muzikanten</a></li>
				<li class="header-nav-li header-nav-dicht-li"><a href="http://bandfit.local/wp-login.php?action=logout">Afsluiten</a></li>
			</ul>
		</div>
	</header>

	<div id="primary" class="content-area">

	<script>
		let headerNavUl = document.getElementById("header-nav-ul");
		let hamburger = document.getElementById("menu_checkbox");
		let headerNavLis = document.getElementsByClassName("header-nav-li");
		hamburger.addEventListener("click", openSluitMenu);

		function openSluitMenu(){
			if(headerNavUl.classList.contains("header-nav-open") === true){
				headerNavUl.classList.remove("header-nav-open");
				headerNavUl.classList.add("header-nav-dicht");
				let teller = 0;
				while (headerNavLis.length > teller){
					headerNavLis[teller].classList.remove("header-nav-open-li");
					headerNavLis[teller].classList.add("header-nav-dicht-li");
					teller++;
				}

			} else{
				let teller = 0;
				while (headerNavLis.length > teller){
					headerNavLis[teller].classList.remove("header-nav-dicht-li");
					headerNavLis[teller].classList.add("header-nav-open-li");
					teller++;
				}
				headerNavUl.classList.remove("header-nav-dicht");
				headerNavUl.classList.add("header-nav-open");
			}
		}
	</script>




