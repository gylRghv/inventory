$(document).ready(function(e) {
	var winHeight = $(window).height();   
	//$(".firstSlideBox") .css("height", (winHeight) + "px");		
	$(".agentListingBox") .css("min-height", (winHeight - 60) + "px");		
	$(".agentListingBox .listingBox") .css("min-height", (winHeight - 60) + "px");
	$(".agentListingBox .mapBox") .css("height", (winHeight - 60) + "px");
});


$('.toolsBox').hide(); 
lastClicked = 1;
 $('.st7').click(function(){
  thisRotationPoint=(this.getAttribute("point") || 1);
  var tl = new TimelineMax();  
  var pIcon=".p"+thisRotationPoint;  
  var dContent=".d"+thisRotationPoint;
  //var removeContent=".d"+lastClicked;
  tl.to($(pIcon), 0.3, {
      scale: 1,
      transformOrigin: "50% 100%",
      fill: $reg,
      ease: Back.easeIn
    }, "likely+=1.25")
    .to($effect, 0.3, {
      y: 0,
      ease: Circ.easeIn
    }, "likely+=1.25")
    .to($eLine, 0.3, {
      stroke: $red,
      ease: Sine.easeIn
    }, "likely+=1.25")
    .to($('.facts'), 0.3, {
      opacity: 0,
      scale: 0.7 
    }, "likely+=1.25")
    .to($m1, 0.3, {
      fill: $mReg,
      ease: Circ.easeIn
    }, "likely+=1.25");

    tl.to($circ, 1, {
      rotation: this.getAttribute("rotation")
    }, "likely+=1.25");


  tl.to($(pIcon), 0.3, {
      scale: 1.3,
      transformOrigin: "50% 100%",
      fill: $blue,
      ease: Bounce.easeOut
    }, "likely+=2")
    .to($effect, 0.3, {
      y: -20,
      ease: Circ.easeOut
    }, "likely+=2")
    .to($eLine, 0.3, {
      stroke: $orange,
      ease: Sine.easeOut
    }, "likely+=2")
    .fromTo($(dContent), 0.3, {
      opacity: 0,
      scale: 0.7 
    }, {
      opacity: 1,
      scale: 1,
      ease: Back.easeOut
    }, "likely+=2")
    .to([$m1, $m2], 0.3, {
      fill: $green,
      ease: Circ.easeOut
    }, "likely+=2");
   
    ///lastClicked = thisRotationPoint;
  tl.play();
  master.pause();
 });

var shape = document.getElementById("svg");

// media query event handler
if (matchMedia) {
        var mq = window.matchMedia("(min-width: 826px)");
        mq.addListener(WidthChange);
        WidthChange(mq);
}
// media query change
function WidthChange(mq) {
        if (mq.matches) {
    shape.setAttribute("viewBox", "0 0 765 587");
    shape.setAttribute("enable-background", "0 0 765 587");
        }
        else {
    shape.setAttribute("viewBox", "0 0 592 588");
    shape.setAttribute("enable-background", "0 0 592 588");
        }
};

var $effect = $("#effect"),
    $circ = $(".iconCircle"),
    isFF = !!window.sidebar,
    $m1 = $(".money .one"),
    $m2 = $(".money .two"),
    $m3 = $(".money .three"),
    $eLine = $(".eLine"),
    $green = "#8DAF82",
    $blue = "#BEEAE6",
    $reg = "#414751",
    $orange = "#F47A57",
    $red = "#931429",
    $yellow = "#F9B458",
    $mReg = "#23262C";

TweenMax.set($(".facts"), {
  visibility: "visible"
});

TweenMax.set($circ, {
  svgOrigin:"222.2, 154",
  x: 14,
  y: 58,
	rotation:-10
});









//svgOrigin:"321.05, 323.3",

for (var i = 1; i < 8; i++) {
  TweenMax.set($(".d" + i), {
    opacity: 0
  });
}

// rotateInfo
function rotateInfo() {
  var tl = new TimelineMax();
  tl.add("likely");
  tl.to($(".p1"), 0, {
      scale: 1.3,
      transformOrigin:"50% 100%",
      fill: $blue,
      ease: Bounce.easeOut
    }, "likely")
    .to($effect, 0, {
      y: -10,
      ease: Circ.easeOut
    }, "likely")
    .to($eLine,0, {
      stroke: $orange,
      ease: Sine.easeOut
    }, "likely")
    .fromTo($(".d1"), 0, {
      opacity: 0,
      scale: 0.7 
    }, {
      opacity: 1,
      scale: 1,
      ease: Back.easeOut
    }, "likely")
    .to($m1, 0, {
      fill: $green,
      ease: Circ.easeOut
    }, "likely");
  
  tl.to($(".p1"), 0.3, {
      scale: 1,
      transformOrigin: "50% 100%",
      fill: $reg,
      ease: Back.easeIn
    }, "likely+=1.25")
    .to($effect, 0.3, {
      y: 0,
      ease: Circ.easeIn
    }, "likely+=1.25")
    .to($eLine, 0.3, {
      stroke: $red,
      ease: Sine.easeIn
    }, "likely+=1.25")
    .to($(".d1"), 0.3, {
      opacity: 0,
      scale: 0.7 
    }, "likely+=1.25")
    .to($m1, 0.3, {
      fill: $mReg,
      ease: Circ.easeIn
    }, "likely+=1.25");
    tl.to($circ, 1, {
      rotation: -55
    }, "likely+=1.25");
  
    tl.to($(".p2"), 0.3, {
      scale: 1.3,
      transformOrigin: "50% 100%",
      fill: $blue,
      ease: Bounce.easeOut
    }, "likely+=2")
    .to($effect, 0.3, {
      y: -18,
      ease: Circ.easeOut
    }, "likely+=2")
    .to($eLine, 0.3, {
      stroke: $orange,
      ease: Sine.easeOut
    }, "likely+=2")
    .fromTo($(".d2"), 0.3, {
      opacity: 0,
      scale: 0.7 
    }, {
      opacity: 1,
      scale: 1,
      ease: Back.easeOut
    }, "likely+=2")
    .to([$m1, $m2], 0.3, {
      fill: $green,
      ease: Circ.easeOut
    }, "likely+=2");
  
	
	
	
  tl.to($(".p2"), 0.3, {
      scale: 1,
      transformOrigin: "50% 100%",
      fill: $reg,
      ease: Back.easeIn
    }, "likely+=3.5")
    .to($effect, 0.3, {
      y: 0,
      ease: Circ.easeIn
    }, "likely+=3.5")
    .to($eLine, 0.3, {
      stroke: $red,
      ease: Sine.easeIn
    }, "likely+=3.5")
    .to($(".d2"), 0.3, {
      opacity: 0,
      scale: 0.7 
    }, "likely+=3.5")
    .to([$m1, $m2], 0.3, {
      fill: $mReg,
      ease: Circ.easeIn
    }, "likely+=3.5");
      tl.to($circ, 1, {
        rotation: -98
      }, "likely+=3.5");
  
  tl.to($(".p3"), 0.3, {
      scale: 1.3,
      transformOrigin: "50% 100%",
      fill: $blue,
      ease: Bounce.easeOut
    }, "likely+=4")
    .to($effect, 0.3, {
      y: -20,
      ease: Circ.easeOut
    }, "likely+=4")
    .to($eLine, 0.3, {
      stroke: $orange,
      ease: Sine.easeOut
    }, "likely+=4")
    .fromTo($(".d3"), 0.3, {
      opacity: 0,
      scale: 0.7 
    }, {
      opacity: 1,
      scale: 1,
      ease: Back.easeOut
    }, "likely+=4")
    .to([$m1, $m2], 0.3, {
      fill: $green,
      ease: Circ.easeOut
    }, "likely+=4");
  
    tl.to($(".p3"), 0.3, {
      scale: 1,
      transformOrigin: "50% 100%",
      fill: $reg,
      ease: Back.easeIn
    }, "likely+=5.5")
    .to($effect, 0.3, {
      y: 0,
      ease: Circ.easeIn
    }, "likely+=5.5")
    .to($eLine, 0.3, {
      stroke: $red,
      ease: Sine.easeIn
    }, "likely+=5.5")
    .to($(".d3"), 0.3, {
      opacity: 0,
      scale: 0.7 
    }, "likely+=5.5")
    .to([$m1, $m2], 0.3, {
      fill: $mReg,
      ease: Circ.easeIn
    }, "likely+=5.5");
       tl.to($circ, 1, {
          rotation: -141
        }, "likely+=5.5");
  
    tl.to($(".p4"), 0.3, {
      scale: 1.3,
      transformOrigin: "50% 100%",
      fill: $blue,
      ease: Bounce.easeOut
    }, "likely+=6")
    .to($effect, 0.3, {
      y: -20,
      ease: Circ.easeOut
    }, "likely+=6")
    .to($eLine, 0.3, {
      stroke: $orange,
      ease: Sine.easeOut
    }, "likely+=6")
    .fromTo($(".d4"), 0.3, {
      opacity: 0,
      scale: 0.7 
    }, {
      opacity: 1,
      scale: 1,
      ease: Back.easeOut
    }, "likely+=6")
    .to([$m1, $m2], 0.3, {
      fill: $green,
      ease: Circ.easeOut
    }, "likely+=6");
  
    tl.to($(".p4"), 0.3, {
      scale: 1,
      transformOrigin: "50% 100%",
      fill: $reg,
      ease: Back.easeIn
    }, "likely+=7.5")
    .to($effect, 0.3, {
      y: 0,
      ease: Circ.easeIn
    }, "likely+=7.5")
    .to($eLine, 0.3, {
      stroke: $red,
      ease: Sine.easeIn
    }, "likely+=7.5")
    .to($(".d4"), 0.3, {
      opacity: 0,
      scale: 0.7 
    }, "likely+=7.5")
    .to([$m1, $m2], 0.3, {
      fill: $mReg,
      ease: Circ.easeIn
    }, "likely+=7.5");
      tl.to($circ, 1, {
        rotation: -185
      }, "likely+=7.5");
  
    tl.to($(".p5"), 0.3, {
      scale: 1.3,
      transformOrigin: "50% 100%",
      fill: $blue,
      ease: Bounce.easeOut
    }, "likely+=8")
    .to($effect, 0.3, {
      y: -6,
      ease: Circ.easeOut
    }, "likely+=8")
    .fromTo($(".d5"), 0.3, {
      opacity: 0,
      scale: 0.7 
    }, {
      opacity: 1,
      scale: 1,
      ease: Back.easeOut
    }, "likely+=8")
    .to([$m1, $m2, $m3], 0.3, {
      fill: $green,
      ease: Circ.easeOut
    }, "likely+=8");  
    tl.to($(".p5"), 0.3, {
      scale: 1,
      transformOrigin: "50% 100%",
      fill: $reg,
      ease: Back.easeIn
    }, "likely+=9.5")
    .to($effect, 0.3, {
      y: 0,
      ease: Circ.easeIn
    }, "likely+=9.5")
    .to($(".d5"), 0.3, {
      opacity: 0,
      scale: 0.7 
    }, "likely+=9.5")
    .to([$m1, $m2, $m3], 0.3, {
      fill: $mReg,
      ease: Circ.easeIn
    }, "likely+=9.5");
        tl.to($circ, 1, {
        rotation: -229
      }, "likely+=9.5");
  
  tl.to($(".p6"), 0.3, {
      scale: 1.3,
      transformOrigin: "50% 100%",
      fill: $blue,
      ease: Bounce.easeOut
    }, "likely+=10")
    .to($effect, 0.3, {
      y: -40,
      ease: Circ.easeOut
    }, "likely+=10")
    .to($eLine, 0.3, {
      stroke: $yellow,
      ease: Circ.easeOut
    }, "likely+=10")
    .fromTo($(".d6"), 0.3, {
      opacity: 0,
      scale: 0.7 
    }, {
      opacity: 1,
      scale: 1,
      ease: Back.easeOut
    }, "likely+=10")
    .to([$m1, $m2], 0.3, {
      fill: $green,
      ease: Circ.easeOut
    }, "likely+=10");
  
    tl.to($(".p6"), 0.3, {
      scale: 1,
      transformOrigin: "50% 100%",
      fill: $reg,
      ease: Back.easeIn
    }, "likely+=11.5")
    .to($effect, 0.3, {
      y: 0,
      ease: Circ.easeIn
    }, "likely+=11.5")
    .to($eLine, 0.3, {
      stroke: $red,
      ease: Sine.easeOut
    }, "likely+=11.5")
    .to($(".d6"), 0.3, {
      opacity: 0,
      scale: 0.7 
    }, "likely+=11.5")
    .to([$m1, $m2], 0.3, {
      fill: $mReg,
      ease: Circ.easeIn
    }, "likely+=11.5");
      tl.to($circ, 1, {
        rotation: -273
      }, "likely+=11.5");
    
    tl.to($(".p7"), 0.3, {
      scale: 1.3,
      transformOrigin: "50% 100%",
      fill: $blue,
      x: 10,
      y: 10,
      ease: Bounce.easeOut
    }, "likely+=12")
    .to($effect, 0.3, {
      y: -40,
      ease: Circ.easeOut
    }, "likely+=12")
    .to($eLine, 0.3, {
      stroke: $yellow,
      ease: Circ.easeOut
    }, "likely+=12")
    .fromTo($(".d7"), 0.3, {
      opacity: 0,
      scale: 0.7 
    }, {
      opacity: 1,
      scale: 1,
      ease: Back.easeOut
    }, "likely+=12")
    .to([$m1, $m2], 0.3, {
      fill: $green,
      ease: Circ.easeOut
    }, "likely+=12");
  

  
  tl.timeScale(0.7);

  return tl;

}

/**/var master = new TimelineMax();
 master.add(rotateInfo(), "rotateInfo");
//master.pause();
//master.seek("rotateInfo+=24");

$(document).on('click', 'a.replay', function(e) {
  master.restart();
  e.preventDefault();
});

$(document).on('click', 'a.pause', function(e) {
  master.pause();
  e.preventDefault();
});

$(document).on('click', 'a.play', function(e) {
  master.play();
  e.preventDefault();
});

var slider = $("#slider"),
    sliderValue = {value:0};

slider.slider({
  range: false,
  min: 0,
  max: 100,
  step:.1,
  start:function() {
    //alert('start');
    master.pause();
  },
  slide: function ( event, ui ) {
    //alert('slide');
    console.log(ui.value);
    master.progress( ui.value / 100 );

  },
  stop:function() {
    master.play();
  }
});

master.eventCallback("onUpdate", function() {
  sliderValue.value = master.progress() * 100;
  slider.slider(sliderValue);
});


















