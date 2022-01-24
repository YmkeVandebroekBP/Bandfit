<a id="eigen-muziek-selector" class="bg-darkvibrant h2 geen-margin-bottom actieve-muziek-selector">Eigen muziek</a>
<a id="favoriete-muziek-selector" class="bg-darkvibrant geen-margin-bottom h2-right nonactieve-muziek-selector">Favoriete muziek</a>
		  	<div id="platenspeler">
			</div>
		  	<div id="controls-slider">
				<button id="button-vorige">Vorige</button>
				<button id="button-volgende">Volgende</button>
			</div>
			<p id="vinyl-titel"></p>
			<div id="controls-platenspeler">
			    <button id="button-play">Play</button>
				<button id="button-pauze">Pauze</button>
			</div>

		    <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
		    <div id="player"></div>

		    <script>
			let eigenMuziekList = "<?php the_field('profiel_eigenmuziek', $user); ?>";
			let eigenMuziekListId = eigenMuziekList.split("/").slice(3)[0];
			eigenMuziekListIdPart = eigenMuziekListId.replace('playlist?list=','');
			let favorieteMuziekList = "<?php the_field('profiel_favorietemuziek', $user); ?>";
			let favorieteMuziekListId = favorieteMuziekList.split("/").slice(3)[0];
			favorieteMuziekListIdPart = favorieteMuziekListId.replace('playlist?list=','');

			let eigenMuziekSelector = document.getElementById("eigen-muziek-selector");
			let favorieteMuziekSelector = document.getElementById("favoriete-muziek-selector");
			eigenMuziekSelector.addEventListener("click", selectEigenMuziek);
			favorieteMuziekSelector.addEventListener("click", selectFavorieteMuziek);
			let selectedList = eigenMuziekListIdPart;
			
			function selectEigenMuziek(){
				if(eigenMuziekSelector.classList.contains("nonactieve-muziek-selector")){
					selectedList = eigenMuziekListIdPart;
					favorieteMuziekSelector.classList.add("bg-darkvibrant");
					eigenMuziekSelector.classList.remove("bg-darkvibrant");
					eigenMuziekSelector.classList.remove("nonactieve-muziek-selector");
					eigenMuziekSelector.classList.add("actieve-muziek-selector");
					favorieteMuziekSelector.classList.remove("actieve-muziek-selector");
					favorieteMuziekSelector.classList.add("nonactieve-muziek-selector");
				}
				refreshPlayer();
			}

			function selectFavorieteMuziek(){
				if(favorieteMuziekSelector.classList.contains("nonactieve-muziek-selector")){
					selectedList = favorieteMuziekListIdPart;
					eigenMuziekSelector.classList.remove("bg-darkvibrant");
					favorieteMuziekSelector.classList.add("bg-darkvibrant");
					favorieteMuziekSelector.classList.remove("nonactieve-muziek-selector");
					favorieteMuziekSelector.classList.add("actieve-muziek-selector");
					eigenMuziekSelector.classList.remove("actieve-muziek-selector");
					eigenMuziekSelector.classList.add("nonactieve-muziek-selector");
				}
				refreshPlayer();
			}

		      // 2. This code loads the IFrame Player API code asynchronously.
		      var tag = document.createElement('script');
		      tag.src = "https://www.youtube.com/iframe_api";
		      var firstScriptTag = document.getElementsByTagName('script')[0];
		      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);


		      // 3. This function creates an <iframe> (and YouTube player)
		      //    after the API code downloads.
		      var player;

		      function onYouTubeIframeAPIReady() {
		        player = new YT.Player('player', {
		          height: '390',
		          width: '640',
		          playerVars: {
		            listType:'playlist',
		          	list: selectedList,
		          	loop: 1,
		          },
		          events: {
		            'onReady': onPlayerReady,
		            'onStateChange': onPlayerStateChange
		          },
		        });
		        console.log(selectedList);
		      }

		      function refreshPlayer(){
		      	jQuery('#player').remove();
		      	jQuery('.slider-platenspeler').remove();
		      	let newPlayer = document.createElement("div");
		      	let body = document.getElementsByTagName("body")[0];
		      	body.appendChild(newPlayer);
		      	newPlayer.setAttribute("id", "player");
		      	onYouTubeIframeAPIReady();
		      }

		      // 4. The API will call this function when the video player is ready.
		      function onPlayerReady(event) {
		      	let platenspeler = document.getElementById("platenspeler");
		      	let sliderElement = document.createElement('div');
		      	sliderElement.className = "slider-platenspeler";
		      	platenspeler.appendChild(sliderElement);
		      	let plaatElement = document.createElement('div');
		      	plaatElement.className = "plaat";
		      	sliderElement.appendChild(plaatElement);
		      	let vinylElement = document.createElement('div');
		      	vinylElement.className = "vinyl geselecteerd-vinyl";

		      	plaatElement.appendChild(vinylElement);
		      	let vinylAfbeeldingElement = document.createElement('img');
		      	vinylAfbeeldingElement.className = "vinyl-afbeelding geselecteerde-vinyl-afbeelding";
		      	vinylElement.appendChild(vinylAfbeeldingElement);
		      	
		      	let video_titel = player.getVideoData()['title'];
			    vinylTitel.innerHTML = video_titel;
		      	let videoTeller = 1;
		      	while (videoTeller < event.target.getPlaylist().length){
		      		let songInPlaylist_$videoTeller = event.target.getPlaylist()[videoTeller];
		      		console.log(songInPlaylist_$videoTeller);
		      		let slider = document.getElementsByClassName('slider-platenspeler')[0];
		      		let newPlaat = document.createElement('div');
		      		slider.appendChild(newPlaat);
		      		newPlaat.className = 'plaat';
		      		let newVinylElement = document.createElement('div');
		      		newVinylElement.classList.add('vinyl');
		      		newPlaat.appendChild(newVinylElement);
		      		let newVinylAfbeeldingElement = document.createElement('img');
		      		newVinylAfbeeldingElement.classList.add('vinyl-afbeelding');
		      		newVinylElement.appendChild(newVinylAfbeeldingElement);
		      		newVinylAfbeeldingElement.getAttribute('src');
		      		let video_id = player.getVideoData()['video_id'];
		      		let vinylAfbeeldingLink = "http://img.youtube.com/vi/" + songInPlaylist_$videoTeller + "/sddefault.jpg"; 
		      		newVinylAfbeeldingElement.setAttribute('src', vinylAfbeeldingLink);
		      		console.log('plaat aangemaakt');
		      		videoTeller++;
		      	}
			  	jQuery('.slider-platenspeler').slick({
			   		slidesToShow: 3,
			      	slidesToScroll: 1,
			  		dots: false,
			  		arrows: false,
			      	autoplay: false,
			      	infinite: false,
			      	responsive: [
				    {
				      breakpoint: 1200,
				      settings: {
				      	slidesToShow: 2,
				        slidesToScroll: 1
				      }
				    },
				    {
				      breakpoint: 768,
				      settings: {
					      slidesToShow: 1,
					      slidesToScroll: 1
				      }
				    }
				    ]
				  });

		      	let eersteSongInPlaylist = event.target.getPlaylist()[0];
		      	vinylAfbeeldingElement.getAttribute('src');
		      	let afbeeldingStart = "http://img.youtube.com/vi/" + eersteSongInPlaylist + "/sddefault.jpg"
		      	vinylAfbeeldingElement.setAttribute('src', afbeeldingStart);
		      }

		      function onPlayerStateChange(event) {
			    let video_titel = player.getVideoData()['title'];
			    vinylTitel.innerHTML = video_titel;
		    }

		    /* Nakijken welke plaat aan het spelen is */
		     let vinyl = document.getElementsByClassName('vinyl')[0];
		     let geselecteerdVinyl = document.getElementsByClassName('geselecteerd-vinyl')[0];
		     let vinylAfbeelding = document.getElementsByClassName('vinyl-afbeelding')[0];
		     let randomVinylAfbeelding = document.getElementsByClassName('vinyl-afbeelding');
		     let volgendeRandomVinylAfbeelding = document.getElementsByClassName('vinyl-afbeelding')[+ 1];
		     let geselecteerdeVinylAfbeelding = document.getElementsByClassName('geselecteerde-vinyl-afbeelding')[0];

		     let vinylTitel = document.getElementById("vinyl-titel");


		      function previousVideo() {
			    /* Nakijken welke plaat aan het spelen is */
			    let vinyl = document.getElementsByClassName('vinyl')[0];
			    let geselecteerdVinyl = document.getElementsByClassName('geselecteerd-vinyl')[0];
			    let vinylAfbeelding = document.getElementsByClassName('vinyl-afbeelding')[0];
			    let randomVinylAfbeelding = document.getElementsByClassName('vinyl-afbeelding');
			    let volgendeRandomVinylAfbeelding = document.getElementsByClassName('vinyl-afbeelding')[- 1];
			    let geselecteerdeVinylAfbeelding = document.getElementsByClassName('geselecteerde-vinyl-afbeelding')[0];

		      	numberOfVideos = document.getElementsByClassName('plaat').length;
		      	console.log(numberOfVideos);
		        let teller = 0;
		      	while (teller < numberOfVideos){
		      		if (randomVinylAfbeelding[teller].classList.contains("geselecteerde-vinyl-afbeelding")) {
		      			randomVinylAfbeelding[teller].classList.remove("geselecteerde-vinyl-afbeelding");
		      			randomVinylAfbeelding[teller].classList.remove("draaien-actief");
		      			randomVinylAfbeelding[teller].classList.add("draaien-stop");
		      			randomVinylAfbeelding[teller - 1].classList.add("geselecteerde-vinyl-afbeelding");
		      			randomVinylAfbeelding[teller--].classList.remove("draaien-stop");
		      			randomVinylAfbeelding[teller--].classList.add("draaien-actief");
		      			console.log(teller);
		      		}
		      		teller++;
		      	}
		      	player.previousVideo();
		      }

		      function playVideo() {
			    /* Nakijken welke plaat aan het spelen is */
			    let vinyl = document.getElementsByClassName('vinyl')[0];
			    let vinylAfbeelding = document.getElementsByClassName('vinyl-afbeelding')[0];
			    let randomVinylAfbeelding = document.getElementsByClassName('vinyl-afbeelding');
			    let volgendeRandomVinylAfbeelding = document.getElementsByClassName('vinyl-afbeelding')[+ 1];
			    let geselecteerdeVinylAfbeelding = document.getElementsByClassName('geselecteerde-vinyl-afbeelding')[0];

		        player.playVideo();
		        geselecteerdeVinylAfbeelding.classList.remove("draaien-stop");
		       	geselecteerdeVinylAfbeelding.classList.add("draaien-actief");
		      }

		      function pauseVideo() {
			    /* Nakijken welke plaat aan het spelen is */
			    let vinyl = document.getElementsByClassName('vinyl')[0];
			    let vinylAfbeelding = document.getElementsByClassName('vinyl-afbeelding')[0];
			    let randomVinylAfbeelding = document.getElementsByClassName('vinyl-afbeelding');
			    let volgendeRandomVinylAfbeelding = document.getElementsByClassName('vinyl-afbeelding')[+ 1];
			    let geselecteerdeVinylAfbeelding = document.getElementsByClassName('geselecteerde-vinyl-afbeelding')[0];

		        player.pauseVideo();
		       	geselecteerdeVinylAfbeelding.classList.remove("draaien-actief");
		       	geselecteerdeVinylAfbeelding.classList.add("draaien-stop");	      
		      }

		      function pauseVideo() {
			    /* Nakijken welke plaat aan het spelen is */
			    let vinyl = document.getElementsByClassName('vinyl')[0];
			    let vinylAfbeelding = document.getElementsByClassName('vinyl-afbeelding')[0];
			    let randomVinylAfbeelding = document.getElementsByClassName('vinyl-afbeelding');
			    let volgendeRandomVinylAfbeelding = document.getElementsByClassName('vinyl-afbeelding')[+ 1];
			    let geselecteerdeVinylAfbeelding = document.getElementsByClassName('geselecteerde-vinyl-afbeelding')[0];

		        player.pauseVideo();
		       	geselecteerdeVinylAfbeelding.classList.remove("draaien-actief");
		       	geselecteerdeVinylAfbeelding.classList.add("draaien-stop");	      
		      }

		      function nextVideo(){
			    /* Nakijken welke plaat aan het spelen is */
			    let vinyl = document.getElementsByClassName('vinyl')[0];
			    let vinylAfbeelding = document.getElementsByClassName('vinyl-afbeelding')[0];
			    let randomVinylAfbeelding = document.getElementsByClassName('vinyl-afbeelding');
			    let volgendeRandomVinylAfbeelding = document.getElementsByClassName('vinyl-afbeelding')[+ 1];
			    let geselecteerdeVinylAfbeelding = document.getElementsByClassName('geselecteerde-vinyl-afbeelding')[0];

		      	numberOfVideos = document.getElementsByClassName('plaat').length;
		      	console.log(numberOfVideos);
		        let teller = 0;
		      	while (teller < numberOfVideos){
		      		if (randomVinylAfbeelding[teller].classList.contains("geselecteerde-vinyl-afbeelding")) {
		      			randomVinylAfbeelding[teller].classList.remove("geselecteerde-vinyl-afbeelding");
		      			randomVinylAfbeelding[teller].classList.remove("draaien-actief");
		      			randomVinylAfbeelding[teller].classList.add("draaien-stop");
		      			randomVinylAfbeelding[teller + 1].classList.add("geselecteerde-vinyl-afbeelding");
		      			randomVinylAfbeelding[teller++].classList.remove("draaien-stop");
		      			randomVinylAfbeelding[teller++].classList.add("draaien-actief");
		      			console.log(teller);
		      		}
		      		teller++;
		      	}
		      	player.nextVideo();
		      }

		      /* BUTTON FUNCTIONALITY */
		      /* PLAY */
		      let buttonVorige = document.getElementById("button-vorige");
		      buttonVorige.addEventListener("click", previousVideo);
			const prevSlide = (slider) => {
			  jQuery(slider).slick('slickPrev');
			};
			buttonVorige.addEventListener('click', () => {
			  prevSlide('.slider-platenspeler');
			});

		      let buttonPlay = document.getElementById("button-play");
		      buttonPlay.addEventListener("click", playVideo);

		      /* PAUZE */
		      let buttonPauze = document.getElementById("button-pauze");
		      buttonPauze.addEventListener("click", pauseVideo);


		      /* VOLGENDE */
		      let buttonVolgende = document.getElementById("button-volgende");
		      buttonVolgende.addEventListener("click", nextVideo);
			const nextSlide = (slider) => {
			  jQuery(slider).slick('slickNext');
			};
			buttonVolgende.addEventListener('click', () => {
			  nextSlide('.slider-platenspeler');
			});

			jQuery('#slider-profiel-ervaringen').slick({
		   		slidesToShow: 2,
		      	slidesToScroll: 1,
		  		dots: false,
		  		arrows: true,
		  		infinite: false,
			      	responsive: [
				    {
				      breakpoint: 1200,
				      settings: {
				      	slidesToShow: 1,
				        slidesToScroll: 1
				      }
				    }
				    ]
				  });	

		    </script>




