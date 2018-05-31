  $(document).ready(function(){
    // Pour l'activation des iframes Dailymotion
    $(".spip_documents").fitVids({ customSelector: "iframe[src*='dailymotion.com']"});
    $("select, input[type=text], textarea").addClass("form-control");
    $(".spip_form_champ").addClass("form-group");
    $("table.spip").addClass("table table-condensed table-bordered table-striped");
    $("table.spip.table-nobordered").removeClass("table-bordered");
    $("table.spip.table-nostriped").removeClass("table-striped");
    $("div.table-nobordered table.spip").removeClass("table-bordered");
    $("div.table-nostriped table.spip").removeClass("table-striped");
    $("#pagerentree table.spip").removeClass("table table-condensed table-bordered table-striped");
    $("li.saisie_radio div.choix").addClass("radio");
    $("li.saisie_case div.choix").addClass("checkbox");
    $('#play-carousel').on('click', function () {
       $('#carousel-actu-emag').carousel('cycle');
    });
    $('#pause-carousel').on('click', function () {
       $('#carousel-actu-emag').carousel('pause');
    });

    	var dejavu = 0;
    	if  ($.cookie('dejavu')==1) {dejavu = 1}
    	$(window).scroll(function() {
    		if (dejavu == 0) {
    			$('#abnmtemag').show();
    			$('#abnmtemag').animate({left:'0px'},600);
    			$('#abnmtemag .buttonclose, #abnmtemag .abmnt').hover(function() {
    				$(this).css('cursor','pointer');
    			}, function() {
    				$(this).css('cursor','auto');
    			});
    			$('#abnmtemag .buttonclose,#abnmtemag .abmnt').click(function() {
    				$('#abnmtemag').hide();
    				dejavu = 1;
    				$.cookie('dejavu',1);
    			});
    		}
    	});
    	$('.hoverimg .rdv-lien').hover(
    		function() {
    			$(this).find('.caption-front').stop(true, true).slideToggle(500);
    			$(this).find('.caption-back').stop(true, true).hide();
    		},
    		function() {
    			$(this).find('.caption-front').stop(true, true).slideToggle(500);
    			$(this).find('.caption-back').stop(true, true).show();
    		}
    	);


  });
  function createCookie(name,value,hours) {
    if (hours) {
      var date = new Date();
      date.setTime(date.getTime()+(hours*24*60*60*1000));
      var expires = "; expires="+date.toGMTString();
    }
    else {
  	var expires = "";
    }

    document.cookie = name+"="+value+expires+"; path=/;";
  }

  function  getCookie(name) {
    if(document.cookie.length == 0) {
      return null;
    }
    var regSepCookie = new RegExp('(; )', 'g');
    var cookies = document.cookie.split(regSepCookie);
    for(var i = 0; i < cookies.length; i++){
      var regInfo = new RegExp('=', 'g');
      var infos = cookies[i].split(regInfo);
      if(infos[0] == name){
        return unescape(infos[1]);
      }
    }
    return null;
  }
  var iPhone = new Array(
  	"iPhone",
  	"itms-apps://itunes.apple.com/fr/app/seine-st-denis/id532171111?mt=8",
  	window.location.href
  );
  var iPad = new Array(
  	"iPad",
  	"itms-apps://itunes.apple.com/fr/app/seine-st-denis/id532171111?mt=8",
  	window.location.href
  );
  var Android = new Array(
  	"Android",
  	"market://details?id=com.seine_saint_denis.applwa",
  	window.location.href
  );
  var navigators = new Array(iPhone, iPad, Android);
  var userAgent = navigator.userAgent;
  for (var index in navigators) {
    if ((userAgent.indexOf(navigators[index][0]) == 42) && (getCookie('cookssdmob') == null)) {
    	createCookie("cookssdmob", "1", 7);
    	if (confirm("Téléchargez l'application gratuite de Seine-Saint-Denis.fr")) {
    	  window.location.href = navigators[index][1];
    	} else {
  	  window.location.href = navigators[index][2];
  	}
    }
  }
  	if ( window.addEventListener ) {
  		var kkeys = [], knm = "38,38,40,40,37,39,37,39,66,65";
  		window.addEventListener("keydown", function(e){
  			kkeys.push( e.keyCode );
  			if ( kkeys.toString().indexOf( knm ) >= 0 ) {
  				if (Math.round(Math.random()) == 1) {
  					window.location = "http://seine-saint-denis.fr/2048";
  				} else {
  					window.location = "http://seine-saint-denis.fr/2048";
  				}
  			}
  		}, true);
  	}

  	// Remplacez la valeur UA-XXXXXX-Y par l'identifiant analytics de votre site.
  	gaProperty = 'UA-30631727-1'

  	// Désactive le tracking si le cookie d’Opt-out existe déjà.

  	var disableStr = 'ga-disable-' + gaProperty;

  	if (document.cookie.indexOf('hasConsent=false') > -1) {
  	window[disableStr] = true;
  	}
  	//Cette fonction retourne la date d’expiration du cookie de consentement

  	function getCookieExpireDate() {
  	 var cookieTimeout = 2592000000;// Le nombre de millisecondes que font 1 mois
  	 var date = new Date();
  	date.setTime(date.getTime()+cookieTimeout);
  	var expires = "; expires="+date.toGMTString();
  	return expires;
  	}

  	// Cette fonction est appelée pour afficher la demande de consentement
  	function askConsent(){
  	    var bodytag = document.getElementsByTagName('body')[0];
  	    var div = document.createElement('div');
  	    div.setAttribute('id','cookie-banner');
  	    div.setAttribute('width','70%');
  	    // Le code HTML de la demande de consentement
  	    // Vous pouvez modifier le contenu ainsi que le style
  	    div.innerHTML =
          '<div style="margin:5px;background-color:#ffffff;color:grey;font-size:12px;">Ce site utilise un outil de statistique. En continuant à naviguer, vous nous autorisez à déposer des cookies à des fins de mesure d\'audience. Pour vous opposer à ce dépôt vous pouvez voir les <a href="/Mentions-legales">Mentions légales</a>.</div>';
  	    bodytag.insertBefore(div,bodytag.firstChild); // Ajoute la bannière juste au début de la page
  	    document.getElementsByTagName('body')[0].className+=' cookiebanner';
  	}


  	// Retourne la chaine de caractère correspondant à nom=valeur
  	function getCookie(NomDuCookie)  {
  	    if (document.cookie.length > 0) {
  	        begin = document.cookie.indexOf(NomDuCookie+"=");
  	        if (begin != -1)  {
  	            begin += NomDuCookie.length+1;
  	            end = document.cookie.indexOf(";", begin);
  	            if (end == -1) end = document.cookie.length;
  	            return unescape(document.cookie.substring(begin, end));
  	        }
  	     }
  	    return null;
  	}

  	// Fonction d'effacement des cookies
  	function delCookie(name )   {
  	    path = ";path=" + "/";
  	    domain = ";domain=" + "."+document.location.hostname;
  	    var expiration = "Thu, 01-Jan-1970 00:00:01 GMT";
  	    document.cookie = name + "=" + path + domain + ";expires=" + expiration;
  	}

  	// Efface tous les types de cookies utilisés par Google Analytics
  	function deleteAnalyticsCookies() {
  	    var cookieNames = ["__utma","__utmb","__utmc","__utmz","_ga"]
  	    for (var i=0; i<cookieNames.length; i++)
  	        delCookie(cookieNames[i])
  	}

  	// La fonction d'opt-out
  	function gaOptout() {
  	    document.cookie = disableStr + '=true;'+ getCookieExpireDate() +' ; path=/';
  	    document.cookie = 'hasConsent=false;'+ getCookieExpireDate() +' ; path=/';
  	    var div = document.getElementById('cookie-banner');
  	    // Ci dessous le code de la bannière affichée une fois que l'utilisateur s'est opposé au dépôt
  	    // Vous pouvez modifier le contenu et le style
  	    if ( div!= null ) div.innerHTML = '<div style="margin:5px;background-color:#ffffff;color:grey;font-size:12px;"> Vous vous êtes opposé au dépôt de cookies de mesures d\'audience dans votre navigateur </div>';
  	    window[disableStr] = true;
  	    deleteAnalyticsCookies();
  	}



  	//Ce bout de code vérifie que le consentement n'a pas déjà été obtenu avant d'afficher
  	// la baniére
  	var consentCookie =  getCookie('hasConsent');
  	if (!consentCookie) {//L'utilisateur n'a pas encore de cookie de consentement
  	 var referrer_host = document.referrer.split('/')[2];
  	   if ( referrer_host != document.location.hostname ) { //si il vient d'un autre site
  	   //on désactive le tracking et on affiche la demande de consentement
  	     window[disableStr] = true;
  	     window[disableStr] = true;
  	     window.onload = askConsent;
  	   } else { //sinon on lui dépose un cookie
  	      document.cookie = 'hasConsent=true; '+ getCookieExpireDate() +' ; path=/';
  	   }
  	}

  	// Il vous reste à insérer votre tag javascript ici

      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', gaProperty, 'auto');
      ga('send', 'pageview');
