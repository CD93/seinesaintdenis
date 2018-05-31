$(document).ready(function(){
      Animeglobal();
      $('#table_carte button').on('click', function(e) {
        e.preventDefault();
        clearTimeout(animglob);
        clearTimeout(aa);
        clearTimeout(a);
        clearTimeout(b);
        clearTimeout(c);
        clearTimeout(d);
        clearTimeout(dd);
        clearTimeout(f);
        clearTimeout(g);
        clearTimeout(h);
        clearTimeout(i);

        var theme =  $(this).data("theme");
        $( "#panneau" ).load( "/?page=panneau", { "theme[]": [theme] } );
        $("#blanco").show().animate({opacity: "0.8"}, 400 );
        $( "#panneau" ).animate({ left: "+=600" }, 400 );
      });
      $('#blanco').on('click', function(e) {
        $("#blanco").hide();
        $( "#panneau" ).animate({
          left: "-=600"
        }, 400)
      });
      $('#envoyer_mail').on('click', function(e) {
        e.preventDefault();
        $('#form_mail').slideToggle('300');
      });
      function tableAnime(id,lettre,) {
        $('#imt'+id).fadeTo(500,0.1, function() {
          $(this).attr("src","plugins/voeux2018/images/img"+id+lettre+".jpg").fadeTo(500,1);
        });
      }
      function Animeglobal(time){
        aa= setTimeout(function(){tableAnime(95,"b");},10);
        a = setTimeout(function(){tableAnime(96,"b");},2000);
        b = setTimeout(function(){tableAnime(97,"b");},4000);
        c = setTimeout(function(){tableAnime(98,"b");},6000);
        d = setTimeout(function(){tableAnime(99,"b");},8000);
        dd = setTimeout(function(){tableAnime(95,"a");},10000);
        f = setTimeout(function(){tableAnime(96,"a");},12000);
        g = setTimeout(function(){tableAnime(97,"a");},14000);
        h = setTimeout(function(){tableAnime(98,"a");},16000);
        i = setTimeout(function(){tableAnime(99,"a");},18000);
        animglob =  setTimeout(Animeglobal,20000);
      }
      // charger les popup facebook, twitter et video
      //si ancre formulaire on dépli formaulaire
      // on récupère l'ancre
      if (window.location.hash=="#btn_action") {
        $('#form_mail').slideToggle('300');
        //ancre.addClass( "active" ).parent().next('div').slideToggle(300);
        //ancre.css("background-image","url(squelettes/images/fhaut.png)");
        //ancre.attr('aria-expanded','true');
        //$(".pliage button.btn-collapse-up").show();
      }
		});
