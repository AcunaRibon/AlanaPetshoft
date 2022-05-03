/*const stars = document.querySelectorAll(".star");
const rating = document.querySelector(".rating");

for(let i = 0; i < stars.length; i++) {
  stars[i].starValue = (i + 1);
  ["mouseover", "mouseout", "click"].forEach(function (e){
    stars[i].addEventListener(e, starRate);
  });
}

function starRate(e){
  let type = e.type;
  let starValue = this.starValue;
  if(type === "click"){
    if(starValue > 1){
      rating.innerHTML = "Gracias por tu calificación";
    }
  }
  stars.forEach(function (ele, ind){
    if(type === "click"){
      if(ind < starValue) {
        ele.classList.add("fix");
      }
      else{
        ele.classList.remove("fix");
      }
    }
    if(type === "mouseover") {
      if(ind < starValue){
      ele.classList.add("over");
      }
      else {
        ele.classList.remove("over");
      }
    }
    if(type === "mouseout") {
        ele.classList.remove("over");
      }
  })
}*/

(function(d, t, e, m){
    
    // Async Rating-Widget initialization.
    window.RW_Async_Init = function(){
                
        RW.init({
            huid: "483401",
            uid: "2365c0baf36cbed97a37bf09591e0064",
            source: "website",
            options: {
                "advanced": {
                    "layout": {
                        "lineHeight": "12px"
                    },
                    "font": {
                        "hover": {
                            "color": "#B13F94"
                        },
                        "color": "#B13F94",
                        "type": "arial"
                    },
                    "text": {
                        "rateAverage": "Regular"
                    }
                },
                "label": {
                    "background": "#fcafaf"
                },
                "lng": "es",
                "style": "oxygen",
                "isDummy": false
            } 
        });
        RW.render();
    };
        // Append Rating-Widget JavaScript library.
    var rw, s = d.getElementsByTagName(e)[0], id = "rw-js",
        l = d.location, ck = "Y" + t.getFullYear() + 
        "M" + t.getMonth() + "D" + t.getDate(), p = l.protocol,
        f = ((l.search.indexOf("DBG=") > -1) ? "" : ".min"),
        a = ("https:" == p ? "secure." + m + "js/" : "js." + m);
    if (d.getElementById(id)) return;              
    rw = d.createElement(e);
    rw.id = id; rw.async = true; rw.type = "text/javascript";
    rw.src = p + "//" + a + "external" + f + ".js?ck=" + ck;
    s.parentNode.insertBefore(rw, s);
    }(document, new Date(), "script", "rating-widget.com/"));